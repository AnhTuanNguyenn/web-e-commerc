<? include("../library/config.php");?>
<?
	if($_POST['action']=="delete_images")
	{
		$type=$_POST['type'];
		if($type!='thread' && $type!='record' && $type!='news' && $type!='user' && $type!='slide' && $type!='feedback' && $type!='partner')
		{
			echo 0;
			exit;
		}
		$images_id = (int)$_POST['images_id'];
		$dir_type = dir_user.'images/'.$type.'/';
		if($type=='user')
		{
			$query = $db->select($type,"*",array("where"=>"id='".$_SESSION['s_user_id']."' LIMIT 1"));
		} else 
		{
			$query = $db->select($type,"*",array("where"=>"id='".$images_id."' AND user_id='".$_SESSION['s_user_id']."'"));
		}
		
		if($arr_data = mysql_fetch_assoc($query))
		{
			$arr_update['value']['images'] = '';
			if($type=='user')
			{
				$arr_update['where'] = "id='".$images_id."' AND id='".$_SESSION['s_user_id']."'";
			} else 
			{
				$arr_update['where'] = "id='".$images_id."' AND user_id='".$_SESSION['s_user_id']."'";
			}
			
			$rs_update = $db->update($type,$arr_update);
			if(mysql_affected_rows()==1)
			{
				@unlink($dir_type."700_".$arr_data['images']);	
				@unlink($dir_type."500_".$arr_data['images']);
				@unlink($dir_type."350_".$arr_data['images']);
				@unlink($dir_type."250_".$arr_data['images']);
				@unlink($dir_type."176_".$arr_data['images']);
				@unlink($dir_type."100_".$arr_data['images']);
				@unlink($dir_type."40_".$arr_data['images']);
				@unlink($dir_type."700x250_".$arr_data['images']);
				@unlink($dir_type."350x125_".$arr_data['images']);
				@unlink($dir_type."176x62_".$arr_data['images']);
				@unlink($dir_type."70x25_".$arr_data['images']);
				@unlink($dir_type."250x250_".$arr_data['images']);
				@unlink($dir_type."125x125_".$arr_data['images']);
				@unlink($dir_type."180x180_".$arr_data['images']);
				@unlink($dir_type."100x100_".$arr_data['images']);
				@unlink($dir_type."80x80_".$arr_data['images']);
				@unlink($dir_type."40x40_".$arr_data['images']);
				@unlink($dir_type."50x50_".$arr_data['images']);
				@unlink($dir_type."30x30_".$arr_data['images']);
				@unlink($dir_type.$arr_data['images']);
				echo 1;
			} else
			{
				echo 0;
			}
		} else
		{
			echo 0;
		}
		exit;
	} if($_POST['action']=="delete_template")
	{
		$type=$_POST['type'];
		if($type!='template')
		{
			echo 0;
			exit;
		}
		$images_id = (int)$_POST['images_id'];
		$dir_type = dirname(dirname(dirname(__FILE__))).'/images/'.$type.'/';
		
		$query = $db->select($type,"*",array("where"=>"id='".$images_id."'"));
		if($arr_data = mysql_fetch_assoc($query))
		{
			$arr_update['value']['images'] = '';
			$arr_update['where'] = "id='".$images_id."'";
			$rs_update = $db->update($type,$arr_update);
			if(mysql_affected_rows()==1)
			{
				@unlink($dir_type."800_".$arr_data['images']);
				@unlink($dir_type."400_".$arr_data['images']);
				@unlink($dir_type."200_".$arr_data['images']);
				@unlink($dir_type."100_".$arr_data['images']);
				@unlink($dir_type."600x800_".$arr_data['images']);
				@unlink($dir_type."300x400_".$arr_data['images']);
				@unlink($dir_type."150x200_".$arr_data['images']);
				@unlink($dir_type."75x100_".$arr_data['images']);
				@unlink($dir_type.$arr_data['images']);
				echo 1;
			} else
			{
				echo 0;
			}
		} else
		{
			echo 0;
		}
		exit;
	} else if($_POST['action']=="delete_banner")
	{
		$type=$_POST['type'];
		if($type!='banner' )
		{
			echo 0;
			exit;
		}
		$images_id = (int)$_POST['images_id'];
		$dir_type = dir_user.'images/'.$type.'/';
		
		$query = $db->select('user',"*",array("where"=>"id='".$images_id."' AND id='".$_SESSION['s_user_id']."'"));
		if($arr_data = mysql_fetch_assoc($query))
		{
			$arr_update['value']['banner'] = '';
			$arr_update['where'] = "id='".$images_id."' AND id='".$_SESSION['s_user_id']."'";
			$rs_update = $db->update($type,$arr_update);
			if(mysql_affected_rows()==1)
			{
				@unlink($dir_type."954_".$arr_data['banner']);	
				@unlink($dir_type."764_".$arr_data['banner']);
				@unlink($dir_type.$arr_data['banner']);
				echo 1;
			} else
			{
				echo 0;
			}
		} else
		{
			echo 0;
		}
		exit;
	}else if($_POST['action']=="delete_favicon")
	{
		$type=$_POST['type'];
		$images_id = (int)$_POST['images_id'];
		$dir_type = dir_user.'images/'.$type.'/';
		
		$query = $db->select('user',"*",array("where"=>"id='".$_SESSION['s_user_id']."'"));
		if($arr_data = mysql_fetch_assoc($query))
		{
			$arr_update['value']['favicon'] = '';
			$arr_update['where'] = "id='".$images_id."' AND id='".$_SESSION['s_user_id']."'";
			$rs_update = $db->update($type,$arr_update);
			if(mysql_affected_rows()==1)
			{
				@unlink($dir_type."128_".$arr_data['favicon']);	
				@unlink($dir_type."64_".$arr_data['favicon']);
				@unlink($dir_type."32_".$arr_data['favicon']);
				@unlink($dir_type."16_".$arr_data['favicon']);
				@unlink($dir_type.$arr_data['favicon']);
				echo 1;
			} else
			{
				echo 0;
			}
		} else
		{
			echo 0;
		}
		exit;
	}
?>
