<?php
class library
{		
	var $today;
	var $all;
	var $user="";
	
	var $cache_dir = 'cache/';//This is the directory where the cache files will be stored;
	var $cache_time = 1000;//How much time will keep the cache files in seconds.
		
	var $caching = false;
	var $file = '';
	
	public function connect($host="localhost",$user_db="root",$pass_db="root",$db="domain_db")
	{
		
		$conn=mysql_connect($host,$user_db,$pass_db) or die("Không thể kết nối tới server");
		mysql_select_db($db,$conn);
		mysql_query("SET NAMES 'UTF8'");
	}
	public function safe($str="") {
		return mysql_real_escape_string(strip_tags(trim($str)));
	}
	
	public function safeStr($str="") {
		return mysql_real_escape_string($str);
	}
	
	public function unsafeStr($str="") {
		return stripslashes($str);
	}
	
	public function redirect($path=dir,$msg="") {
		if(!empty($msg)) {
			$_SESSION['error'] = $msg;	
		}
		?>
		<script>window.location.href = '<?=$path?>';</script>
		<?
		//header("Location: ".$path);	
	}

	public function logs_visitor($logs_parent_id = 0, $logs_type='')
	{
		if($logs_type!='thread' && $logs_type!='news' && $logs_type!='record' )
		{
			return false;
		}
		$session_id = $_COOKIE['PHPSESSID'];

		$query_logs_visitor = $this->select("logs_visitor","id",array("where"=>'session_id="'.$this->safeStr($session_id).'" AND type="'.$logs_type.'" AND parent_id="'.(int)$logs_parent_id.'"'));
		
		if(!$row_logs_visitor = mysql_fetch_assoc($query_logs_visitor))
		{
		
			$arr_insert = array();
			$arr_insert['type'] = $logs_type;
			$arr_insert['parent_id'] = (int)$logs_parent_id;
			$arr_insert['user_id'] = (int)$_SESSION['s_user_id'];
			$arr_insert['session_id'] = $this->safeStr($session_id);
			$arr_insert['date_create'] = date("Y-m-d H:i:s");
			$this->insert("logs_visitor",$arr_insert);
			if(mysql_insert_id()<0)
			{
				return false;
			}
			$arr_update = array();
			$query_type = $this->select($logs_type,"visitor,id,sub_title,title,user_id",array("where"=>"id='".(int)$logs_parent_id ."'"));
			if($row_type = mysql_fetch_assoc($query_type))
			{	
				$logs_user_id = $row_type['user_id'];
				$visitor = $row_type['visitor'];
				$arr_update['value']['visitor'] = ++$visitor;
				$arr_update['where']='id='.$row_type['id'];
				$this->update($logs_type,$arr_update);
				
			}
		}
		return true;
		
	}
	
	public function logout($path=dir) {
		session_destroy();
		?>
		<script>window.location.href = '<?=$path?>';</script>
		<?
	}
	
	public function checklogin() {
		if(!empty($_SESSION['user_id'])) {
			return true;	
		} else {
			return false;	
		}
	}
	
	public function checkLength($str,$num) {
		if(strlen(trim($str)) < $num) {
			return false;		
		} else {
			return true;	
		}
	}
	
	function check_level($exp=0)
	{
		$level = 1000;
		$percent = 70;
		for($i=1;$i<10;$i++)
		{
			$percent = $percent-($i+$i);
			$next_level = ($level*$percent/100)+$level;
			$level = $level + $next_level;
			$level = round($level,-2);
			if($level > $exp)
			{
				return $i;
			}
			
		}
	}
	public function login($username,$password,$type=0) {
		
		$username = $this->safe($username);
		$password = $this->safe($password);
		if($type==0)
		{
			if(preg_match('/[^A-Za-z0-9_-]/', $username)) {return false;}
		} else 
		{
			if(!$this->checkEmail($username)) {return false;}
		}
		
		
		if(strlen($username) < 3) {return false;}
		if(strlen($password) < 6) {return false;}
		
		$password = $this->encrypt($password);
		if($type==0)
		{
			$query = $this->select("user","*",array("where"=>"username='".$username."' AND password='".$password."' AND del = 0"));
		} else 
		{
			$query = $this->select("user","*",array("where"=>"email='".$username."' AND password='".$password."' AND del = 0 AND"));
		}
		

		if($row = @mysql_fetch_assoc($query)) 
		{
			$level = $this->check_level($row['exp']);
			if($level != $row['level'] && $row['level']!=9)
			{
				$arr_update['value']['level'] = $level;
				$arr_update['where'] = "id='".$row['id']."'";
				$this->update("user",$arr_update);
			}
			
			$_SESSION['s_username'] = $row['username'];
			if(empty($row['f_name']) && empty($row['s_name']))
			{
				$row['fullname'] = $row['username'];
			} else 
			{
				$_SESSION['s_fullname'] = $row['f_name']." ".$row['s_name'];
			}
			
			$_SESSION['s_email'] = $row['email'];
			$_SESSION['s_images'] = $row['images'];
			$_SESSION['s_user_id'] = $row['id'];
			$_SESSION['s_level'] = $level;
			$_SESSION['s_type'] = $row['type'];
			$_SESSION['s_coin'] = $row['coin'];
			
			return true;	
		} else {
			return false;
		}
	}

	public function encrypt($str,$num=10) {
		return md5($str."sagovn.com");
	}
	
	
	public function checkMail($email)
	{
		$info = explode("@",strtolower($email),2);
		$ext = $info[1];
		$array = array("yahoo.com.vn"=>"http://mail.yahoo.com",
				"yahoo.com"=>"http://mail.yahoo.com",
				"gmail.com"=>"http://gmail.com");
		foreach($array as $i=>$_obj)
			{
				if($i==$ext)
				{
					return $_obj;
				}
			}
		return false;	
	}
	
	function check_sql_injection($data='')
	{
		$data = strtolower($data);
		if(empty($data))
		{
			return true;
		}
		$arr_deny = array("select","update","delete","contact","char(","drop","length","truncate","declare","sleep(","waitfor","delay");
		foreach($arr_deny as $deny)
		{
			if(strpos($data,$deny)!==false && $data!='date_update')
			{
				
				return false;
			}
		}
		return true;
	}
	public function select($table,$field="*",$info=array()) {
		if(!$this->check_sql_injection($field) || !$this->check_sql_injection($info['where']))
		{
			return false;
		}
		if(empty($table))
		{
			return false;
		}
		$str = "SELECT $field FROM $table";	
		if(!empty($info['where'])) {
			
			$str .= " WHERE ".$info['where'];	
		}
		
		if(!empty($info['group_by'])) {
			$str .= " GROUP BY ".$info['group_by'];	
		}
		
		if(!empty($info['order_by'])) {
			$str .= " ORDER BY ".$info['order_by'];	
		}
		
		
		if(!empty($info['limit'])) {
			$str .= " LIMIT ".$info['limit'];	
		}
		
		return @mysql_query($str);
	}
	
	
	public function destroy($dir)
	{
		session_destroy();
		header("location:$dir");
	}
	
	
	public function convertDay($date,$split="-") {
		$date = explode($split,$date);
		return $date[2].$split.$date[1].$split.$date[0];	
	}

		public function validInfo($arr_info)
		{
			if(count($arr_info)==0)
			{
				return false;
			} 
			$arr_rs = array();
			foreach($arr_info as $i=>$info)
			{
				$type = $info['type'];
				$value = $info['value'];
				if($type=="checkEmail")
				{
					$rs = $this->checkEmail($value);
					if(!$rs)
					{
						$arr_rs['error'][$type][] = "Địa chỉ Email không hợp lệ"; 
					}
				} else if($type=="checkLength")
				{
					$num = $info['num'];
					$rs = $this->checkLength($value,$num);
					if(!$rs)
					{
						$arr_rs['error'][$type][] = "Chiều dài của chuỗi phải lớn hơn ".$num; 
					}
				} 
			}
			return $arr_rs;
		}
		
		
		public function CheckUserEmail($email) {
			$query = $this->select("user","email",array("where"=>"email='".$email."'"));
			if(@mysql_num_rows($query)==0) {
				return true;	
			} else {
				return false;	
			}
		}
		
		public function CheckUserExits($username="",$email="") {
			$query = $this->select("user","email",array("where"=>"email='".$email."' OR username='".$username."'"));
			if(@mysql_num_rows($query)==0) {
				return true;	
			} else {
				return false;	
			}
		}
		
		public function CheckUsername($username) {
			$query = $this->select("user","username",array("where"=>"username='".$username."'"));
			if(@mysql_num_rows($query)==0) {
				return true;	
			} else {
				return false;	
			}
		}
		
		public function SendMail($from="ads.ivn.vn@gmail.com",$to,$subject,$content,$name="ivn.vn",$type=0) {

			if($type==1) {
				include("gmail server/class.phpmailer.php");
				include("gmail server/class.smtp.php");
			} else {
				include("host server/class.phpmailer.php");
				include("host server/class.smtp.php");

			}
			$mail = new PHPMailer();
			$mail->IsSMTP(); // set mailer to use SMTP
			$mail->Host = host_mail; // specify main and backup server
			$mail->Port = port_mail; // set the port to use
			$mail->SMTPAuth = true; // turn on SMTP authentication
			$mail->SMTPSecure = 'ssl';  
			$mail->Username = user_mail; // your SMTP username or your gmail username
			$mail->Password = pass_mail; // your SMTP password or your gmail password
			$mail->CharSet     = "utf-8";
			$mail->From = $from;
			$mail->FromName = $name; // Name to indicate where the email came from when the recepient received
			$mail->AddAddress($to,$name);
			$mail->AddReplyTo($from,$name);
			$mail->WordWrap = 50; // set word wrap
			$mail->IsHTML(true); // send as HTML
			$mail->Subject = $subject;
			$mail->Body = $content;
			//echo user_mail."|".pass_mail;
			$mail->SMTPDebug = 1;
			//$mail->SMTPDebug = 2;
			if(!$mail->Send())
			{
				return false;
			}
			else
			{
				return true;
			}		
		}

		function create_bg($width=0,$height=0,$ext="jpg")
		{
			$bg_name = "bg".$width."x".$height.".".$ext;
			$dir_img =  dir_web.'images/';
			
			if(is_file($dir_img.$bg_name))
			{
				return $dir_img.$bg_name;
			}
			if($width < 1 || $height < 1 || empty($ext))
			{
				return false;
			}
	
			$bg = imagecreatetruecolor($width, $height);
			if($ext=="png")
			{
				imagesavealpha($bg, true);
			    	imagefill($bg, 0, 0, imagecolorallocatealpha($bg, 0, 0, 0, 127));
			    	header("Content-type: image/png");
			    	imagepng($bg,$dir_img.$bg_name,1);
			} else if($ext=="jpg")
			{
			    	imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
			    	header("Content-type: image/jpeg");
			    	imagejpeg($bg,$dir_img.$bg_name,1);
			}
			imagedestroy($bg);
			return $dir_img.$bg_name;
	
		}
		//width : chieu dai thuc te, height, chieu cao thuc te, 
		function calc_img($arr_info = array())
		{
			$width = (int)$arr_info['width'];
			$height = (int)$arr_info['height'];

			$new_width = (int)$arr_info['new_width'];
			$new_height = (int)$arr_info['new_height'];
			if($width < 1 || $height < 1 || ($new_width < 1 && $new_height < 1) )
			{
				return false;
			}
			$arr_img['file_name'] = $arr_info['name'];
			$arr_img['dir_img'] = $arr_info['dir'];
			//resize theo height
			if($new_width < 1)
			{
				$new_width = round(($new_height/$height)*$width);
			} else if($new_height < 1)
			{
				$new_height = round(($new_width/$width)*$height);
			} else 
			{
				if($new_width/$width > $new_height/$height)
				{
					$new_height = round(($new_width/$width)*$height);
				} else
				{
					$new_width = round(($new_height/$height)*$width);
				}
		
				if($new_width > $arr_info['new_width'])
				{
					$new_height = round(($arr_info['new_width']/$new_width)*$new_height);
					$new_width = $arr_info['new_width'];
			
				} else if($new_height > $arr_info['new_height'])
				{
					$new_width = round(($arr_info['new_height']/$new_height)*$new_width);
					$new_height = $arr_info['new_height'];
			
				} 

				$align_width=($arr_info['new_width']-$new_width)/2;
				$align_height=($arr_info['new_height']-$new_height)/2;

				$arr_img['width'] = $arr_info['new_width'];
				$arr_img['height'] = $arr_info['new_height'];
				$arr_img['new_width'] = $new_width;
				$arr_img['new_height'] = $new_height;
				$arr_img['align_width'] = $align_width;
				$arr_img['align_height'] = $align_height;
				return $arr_img;
			}	
	
			$arr_img['width'] = $width;
			$arr_img['height'] = $height;
			$arr_img['new_width'] = $new_width;
			$arr_img['new_height'] = $new_height;
			return $arr_img;
		}	

		function resize_img($arr_info = array())
		{
			$dir = $arr_info['dir'];
			$name = $arr_info['name'];

			$arr_ext = explode(".",$name,2);
			$ext = $arr_ext[count($arr_ext)-1];
	

			$size=getimagesize($dir.$name);
	
			if($arr_info['new_width'] < 1 || $arr_info['new_height'] < 1)
			{
				if($arr_info['new_width'] > 0)
				{
					$new_name = $arr_info['new_width']."_".$name;
				} else
				{
					$new_name  = "h".$arr_info['new_height']."_".$name;
				}
			} else
			{
				$new_name  = $arr_info['new_width']."x".$arr_info['new_height']."_".$name;
			}
	
	
			$img_width=$size[0];
			$img_height=$size[1];

			$arr_info['width'] = $img_width;
			$arr_info['height'] = $img_height; 

			$arr_data = $this->calc_img($arr_info);

			if(empty($arr_info))
			{
				return false;
			}

			$width = (int)$arr_data['width'];
			$height = (int)$arr_data['height'];
			$new_width = (int)$arr_data['new_width'];
			$new_height = (int)$arr_data['new_height'];
			$align_width = (int)$arr_data['align_width'];
			$align_height = (int)$arr_data['align_height'];
	
			if($width < 1 || $height < 1 || ($new_width < 1 && $new_height < 1) )
			{
				return false;
			}
		
			//resize theo height
			if($arr_info['new_width'] < 1 || $arr_info['new_height'] < 1)
			{
				// khong can background
				if($ext=='png')
				{
					$bg = imagecreatetruecolor($new_width, $new_height);
					$img = imagecreatefrompng($dir.$name);
					imagealphablending($bg, false); 
					$color = imagecolorallocatealpha($bg, 0, 0, 0, 127); 
					imagefill($bg, 0, 0, $color); 
					imagesavealpha($bg, true);
					imagecopyresampled($bg, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);	
			
					imagepng($bg, $dir.$new_name,6);
				} else
				{
					$bg = imagecreatetruecolor($new_width, $new_height);
					$img = imagecreatefromjpeg($dir.$name);
					imagecopyresampled($bg, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);	
					imagejpeg($bg, $dir.$new_name,60);
				}	
			} else
			{
				if($ext=='png')
				{
					$bg = @imagecreatefrompng($this->create_bg($width,$height,"png")); //file chứa nó
					imageSaveAlpha($bg, true);

					$img = @imagecreatefrompng($dir.$name);//file lồng vào trong
					imagecopyresampled($bg, $img, $align_width, $align_height, 0, 0, $new_width, $new_height,$img_width, $img_height);	
					imagepng($bg, $dir.$new_name,6);
				} else
				{
					$bg = @imagecreatefromjpeg($this->create_bg($width,$height,"jpg")); //file chứa nó
					imageSaveAlpha($bg, true);
					$img = @imagecreatefromjpeg($dir.$name);//file lồng vào trong
					imagecopyresampled($bg, $img, $align_width, $align_height, 0, 0, $new_width, $new_height,$img_width, $img_height);	

					imagejpeg($bg, $dir.$new_name,60);
				}
		
			} 
			return true;
		}
		
		public function insert($table,$info) {
			$field = array();
			$value = array();
			foreach($info as $i =>$_obj) {
				$field[] = "`$i`";
				if($i=='title' || $i=='sub_title')
				{
					if(!$this->check_sql_injection($_obj) || strlen($_obj) < 5)
					{
						return false;
					}
				} else if ($i=='user_id' && (int)$_obj< 1)
				{
					return false;
				}
				$value[] = "'$_obj'";
			}
			
			$str = "INSERT INTO $table(".implode(",",$field).") VALUES(".implode(",",$value).")";
			//echo $str;
			mysql_query($str);
			if(mysql_affected_rows()==1) {
				
				return true;
			} else {
				return false;	
			}
			
		}
		
		public function update($table,$info) {
			
			$check = '';
			$str = "UPDATE $table SET ";
			
			foreach($info['value'] as $i=>$_obj) {
				$str .= "`".$i."`= '".$_obj."' ,";
				if($i=='title' || $i=='sub_title')
				{
					if(!$this->check_sql_injection($_obj) || strlen($_obj) < 5)
					{
						if($table!='user' && empty($_obj))
						{
							return false;
						}
						
					}
				} else if ($i=='user_id' && (int)$_obj< 1)
				{
					return false;
				}
			}
			$str = trim($str,",");
			if(!empty($info['where'])) {
				$str .= "WHERE ".$info['where'];
				if(!$this->check_sql_injection($info['where']))
				{
						
					return false;
				}
			}
			
			mysql_query($str);
			if(mysql_affected_rows()>0) {
				return true;
			} else {
				return false;	
			}
		}
		
		
		
		public function delete($table,$where=null)  
        {  
			if(empty($where))
			{
				return false;
			}
			if(!$this->check_sql_injection($where))
			{
				return false;
			}
                $delete = 'delete from '.$table; 
				
				if($where != null)
				{
				$delete = $delete." where $where";
			
				}
				
				$del = @mysql_query($delete);  
                if($del)  
                {  
                    return true;  
                }  
                else  
                {  
                    return false;  
                }  
        }  

		
		
		//lấy số lượng truy cập hôm nay
		public function getLastday()
		{
			return $this->today;
		}
		public function getToday()
		{
			return $this->today;
		}
		//lấy tổng số truy cập
		public function getAll()
		{
			return $this->all;
		}
		//lấy số người đang online
		public function getUser()
		{
			return $this->user;
		}
		//get file type
		
		
		public function set_affiliate_link($affiliate_link)
		{
			// set 3 tieng cookie
			setcookie("affiliate_link",$affiliate_link,time()+10800);
		}
		
		public function getExt($filename)
		{
			return $ext = strtolower(substr(strrchr($filename, '.'), 1));
		}
		
		public function getName($filename)
		{
			
			$leng=strlen($filename);
			return $name = substr($filename,0,$leng-strlen($this->getExt($filename))-1);
		}
		
		public function convertArray($array,$type)
		{
			$array=explode("$type",$array);
			return $array;
		}
		public function convertString($array,$type)
		{
			$array=implode("$type",$array);
			return $array;
		}
		public function convertLower($str)
		{
			return strtolower($str);
		}
		
		public function convertUpper($str)
		{
			return strtoupper($str);
		}
		
		public function convertMoney($price)
		{
			$strlen=intval(strlen($price)/3);
			$leng=strlen($price)%3;
			$newprice="";
			for($i=0;$i<$strlen;$i++)
			{
				$newprice=$newprice.substr($price,$leng+3*$i,3).".";
			}
			if($leng==0)
			{
				$money=substr($newprice,0,strlen($newprice)-1);
			}
			else
			{
				$money=substr($price,0,$leng).".".substr($newprice,0,strlen($newprice)-1);
			}
			return $money;
		}
		
		
		
		//function tạo 1 hình bằng code với kích thước cho trước
		public function createImg($dir,$name,$w,$h)
		{
			if(!file_exists($dir.$name.".png"))
			{
				$img = imagecreatetruecolor($w,$h);

				// Set alphablending to on
				imagealphablending($img, true);
				
				// Draw a square
				imagefilledrectangle($img, $w, $h, 0, 0, imagecolorallocate($img, 255, 255, 255));
				imagepng($img, $dir.$name . image_type_to_extension(IMAGETYPE_PNG)); 
				// Output
				//header('Content-type: image/png');
				
				//imagepng($img);
				
				imagedestroy($img);
			}
			else 
			{
				$size=getimagesize($dir.$name.".png");
				if(($size[0]!=$w)||($size[1]!=$h))
				{
					$img = imagecreatetruecolor($w,$h);
					imagealphablending($img, true);
					imagefilledrectangle($img, $w, $h, 0, 0, imagecolorallocate($img, 255, 255, 255));
					imagepng($img, $dir.$name . image_type_to_extension(IMAGETYPE_PNG)); 
					imagedestroy($img);
				}
			}
	
		}
		
		public function mixImg($bg,$img,$dir,$logo=null)
		{
			$name=$img;
			$size_bg=getimagesize($dir.$bg);
			$w_bg=$size_bg[0];
			$h_bg=$size_bg[1];
			
			$size_img=getimagesize($dir.$img);
			$w_img=$size_img[0];
			$h_img=$size_img[1];
			if($logo==null)
			{
				$w=($w_bg-$w_img)/2;
				$h=($h_bg-$h_img)/2;
			}
			else
			{
				$w=(rand(0,$w_bg));
				$h=(rand(0,$h_bg));
			}
			if(($w_bg!=$w_img)||($h_bg!=$h_img)) //kiểm tra kích thước. Nếu kích thước của bacground và ảnh ghép giống nhau thì không cần tạo ảnh
			{
				$name_img=$img;
				$img = @imagecreatefromjpeg($dir.$img);//file lồng vào trong
				$bg = @imagecreatefrompng($dir.$bg); //file chứa nó
				imageSaveAlpha($bg, true);
				imagecopy($bg,$img,$w,$h,0,0,$w_img,$h_img);
				//header("Content-type: image/jpeg");
				//imagepng($im_c);
				imagejpeg($bg, $dir.$name_img);
			}	
		}
		
		
		
		public function checkSizeImg($dir,$image,$w=0,$h=0) {
			$arr = explode(".",$image);
			$ext = $arr[count($arr)-1];
			if($ext=="swf" || $ext == "gif" || $ext == "png") {
				$size = $this->resizeImg($dir.$image,$w,$h);
			} else {
				$sise = $this->sizeImg($dir."thumbs/".$image);
			}
			return $sise;
		}
		
		
		public function upload_user($file)
		{
			$dir_user = dir_user.'images/user/';
			$dir_bg = dir_web.'images/';
			$file_name = $images = $file['name'];
			
			
			$arr_ext = explode(".",$images);
			
			$ext = $arr_ext[count($arr_ext)-1];
			unset($arr_ext[count($arr_ext)-1]);
			$name = uniqid();
			$file_name = $images = $name.".".$ext;
			if(file_exists($dir_user."250_".$name.".".$ext))
			{
				for($i=0;$i<10;$i++)
				{
					$name = uniqid();
					if(!file_exists($dir_user."250_".$name.".".$ext))
					{
						$file_name = $images = $name.".".$ext;
						break;
					}
					
				}
				
			}
			
			if($ext!='jpg' && $ext!='png')
			{
				return false;
			}
			
			move_uploaded_file($file['tmp_name'],$dir_user.$images);

			$count = 0;
			$arr_size[$count]['width'] = 250;
			$arr_size[$count]['height'] = 0;
			++$count;
			$arr_size[$count]['width'] = 250;
			$arr_size[$count]['height'] = 250;
			++$count;
			$arr_size[$count]['width'] = 50;
			$arr_size[$count]['height'] = 50;
			++$count;
			
			$arr_size[$count]['width'] = 30;
			$arr_size[$count]['height'] = 30;
			
			foreach($arr_size as $arr_info)
			{
				$arr_info['name'] = $images;
				$arr_info['dir'] = $dir_user;
				$arr_info['new_width'] = (int)$arr_info['width'];
				$arr_info['new_height'] = (int)$arr_info['height'];
				$rs  = $this->resize_img($arr_info);
			}
							
			return $images;
		}
		
		
		function quantity_img($width = 0)
		{
				if($width > 400 || $width < 1)
				{
					$arr['png'] = 7;
					$arr['jpg'] = 70;
				} else {
					$arr['png'] = 5;
					$arr['jpg'] = 55;
				}
				return $arr;
		}
		
		
		
		
		public function upload_thread($file)
		{
			$dir_thread = dir_admin.'images/thread/';
			$dir_bg = dir_web.'images/';
			$file_name = $images = $file['name'];
			
			
			$arr_ext = explode(".",$images);
			
			$ext = $arr_ext[count($arr_ext)-1];
			unset($arr_ext[count($arr_ext)-1]);
			$name = uniqid();
			$file_name = $images = $name.".".$ext;
			if(file_exists($dir_thread."250_".$name.".".$ext))
			{
				for($i=0;$i<10;$i++)
				{
					$name = uniqid();
					if(!file_exists($dir_thread."250_".$name.".".$ext))
					{
						$file_name = $images = $name.".".$ext;
						break;
					}
					
				}
				
			}
			
			if($ext!='jpg' && $ext!='png')
			{
				return false;
			}

			move_uploaded_file($file['tmp_name'],$dir_thread.$images);

			$count = 0;
			$arr_size[$count]['width'] = 250;
			$arr_size[$count]['height'] = 0;
			++$count;
			$arr_size[$count]['width'] = 250;
			$arr_size[$count]['height'] = 140;
			++$count;
			$arr_size[$count]['width'] = 125;
			$arr_size[$count]['height'] = 70;
			++$count;
			foreach($arr_size as $arr_info)
			{
				$arr_info['name'] = $images;
				$arr_info['dir'] = $dir_thread;
				$arr_info['new_width'] = (int)$arr_info['width'];
				$arr_info['new_height'] = (int)$arr_info['height'];
				$rs  = $this->resize_img($arr_info);
			}

			
			
			return $images;
		}
		
		public function upload_chanel($file)
		{
			$dir_chanel = dir_user.'images/chanel/';
			$dir_bg = dir_web.'images/';
			$file_name = $images = $file['name'];
			
			
			$arr_ext = explode(".",$images);
			
			$ext = $arr_ext[count($arr_ext)-1];
			unset($arr_ext[count($arr_ext)-1]);
			$name = uniqid();
			$file_name = $images = $name.".".$ext;
			if(file_exists($dir_chanel."700_".$name.".".$ext))
			{
				for($i=0;$i<10;$i++)
				{
					$name = uniqid();
					if(!file_exists($dir_chanel."700_".$name.".".$ext))
					{
						$file_name = $images = $name.".".$ext;
						break;
					}
					
				}
				
			}
			
			if($ext!='jpg' && $ext!='png')
			{
				return false;
			}
			
			move_uploaded_file($file['tmp_name'],$dir_chanel.$images);
	@unlink($dir_chanel."700_".$arr_data['images']);

					@unlink($dir_chanel."700x300_".$arr_data['images']);	
					@unlink($dir_chanel."400x300_".$arr_data['images']);

					@unlink($dir_chanel."250_".$arr_data['images']);
					@unlink($dir_chanel."250x200_".$arr_data['images']);
					@unlink($dir_chanel."250x250_".$arr_data['images']);
					@unlink($dir_chanel."125x125_".$arr_data['images']);
					@unlink($dir_chanel."50x50_".$arr_data['images']);
					
					
					@unlink($dir_chanel.$arr_data['images']);

			$count = 0;
			$arr_size[$count]['width'] = 700;
			$arr_size[$count]['height'] = 0;
			++$count;
			$arr_size[$count]['width'] = 700;
			$arr_size[$count]['height'] = 300;
			++$count;
			$arr_size[$count]['width'] = 400;
			$arr_size[$count]['height'] = 300;
			++$count;
			$arr_size[$count]['width'] = 250;
			$arr_size[$count]['height'] = 0;
			++$count;
			$arr_size[$count]['width'] = 250;
			$arr_size[$count]['height'] = 200;
			++$count;
			$arr_size[$count]['width'] = 250;
			$arr_size[$count]['height'] = 250;
			++$count;
			$arr_size[$count]['width'] = 125;
			$arr_size[$count]['height'] = 125;
			++$count;
			$arr_size[$count]['width'] = 176;
			$arr_size[$count]['height'] = 62;
			++$count;
			$arr_size[$count]['width'] = 70;
			$arr_size[$count]['height'] = 25;
			++$count;
	
			
			foreach($arr_size as $arr_info)
			{
				$arr_info['name'] = $images;
				$arr_info['dir'] = $dir_chanel;
				$arr_info['new_width'] = (int)$arr_info['width'];
				$arr_info['new_height'] = (int)$arr_info['height'];
				$rs  = $this->resize_img($arr_info);
			}
			return $images;
		}

		public function randStr($type,$num)
		{
			$str="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$number="123456789";
			if($type==1)
			{
				$str=$this->convertLower($str);
			}
			else if($type==2)
			{
				$str=$str;
			}
			else if($type==3)
			{
				$str=$number;
			}
			else if($type==4)
			{
				$str=$this->convertLower($str).$str;
			}
			else if($type==5)
			{
				$str=$this->convertLower($str).$number;
			}
			else if($type==6)
			{	
				$str=$str.$number;
			}	
			else if($type==7)
			{
				$str=$this->convertLower($str).$str.$number;
			}
			$string="";
			for($i=0;$i<$num;$i++)
			{
				$string=$string.$str[rand(0,strlen($str))];
			}
			return $string;
		}		
		//resize ảnh
		
		public function sizeImg($dir) {
			return getimagesize($dir);
		}
		public function resizeImg($dir,$w=null,$h=null)
		{
			$size=getimagesize($dir);
			$chieurong=$size[0];
			$chieucao=$size[1];
			if($w!=null)
			{
				$this->w = $w;
				$chieurong=$chieurong/$this->w;//so lan kich thuoc thu nho
				$chieucao=$chieucao/$chieurong;//
				$this->h = round($chieucao);
			}
			if($h!=null)
			{
				$this->h = $h;
				$chieucao=$chieucao/$this->h;//so lan kich thuoc thu nho
				$chieurong=$chieurong/$chieucao;//
				$this->w = round($chieurong);
			}
			
			return array($this->w,$this->h);
			
		}
		
		
		
		
		public function unsign($str)
		 {
			$unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
			'd'=>'đ',
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
			'i'=>'í|ì|ỉ|ĩ|ị',
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
			'D'=>'Đ',
			'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
			'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
			'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
			'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
			'-'=>'\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\"|\:|\?|\>|\<|\`|\=',
			);
			foreach($unicode as $nonUnicode=>$uni)
			{
				$str = preg_replace("/($uni)/i", $nonUnicode, $str);
			}
			$str = preg_replace("/[^a-z0-9]/i", "-", $str);
			$str = preg_replace("/\-+/","-",$str);
			$str = trim($str,"-");
			return $str;
		}
		
	
		
		
		//function check
		public function checkNum($num)
		{
			$find=strpos($num,"e");
			if($find==true)
			{
				return false;
			}
			else if($find==false)
			{
				$num=is_numeric($num);
				if($num==true)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			
		}
		//function check Username	
		public function validUsername($username)
		{
			$regexp = "#^[a-z0-9]+$#i";
			if (preg_match($regexp, $username)) 
			{
				return true;
			} else 
			{
				return false;
			}
		}	
		//function check mail	
		public function checkEmail($email)
		{
			$regexp = "/^[A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
			if (preg_match($regexp, $email)) 
			{
				return true;
			} else 
			{
				return false;
			}
		}	
		
		public function checkBrowser()
		{
			$browsers = array("firefox","IE");
	
			$this->Agent = strtolower($_SERVER['HTTP_USER_AGENT']);
			foreach($browsers as $browser)
			{
				if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->Agent, $match))
				{
					$this->Name = ucwords($match[1]) ;
					$this->Version = $match[2] ;
					break ;
				}
			}
			echo	$this->Name."-----".$this->Version; 
			
			
		}	


	
}

?>
