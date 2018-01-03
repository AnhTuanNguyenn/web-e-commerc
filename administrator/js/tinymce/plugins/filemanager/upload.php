<?php
session_start();
if($_SESSION["verify"] != "FileManager4TinyMCE") die('forbiden');

include('config.php');
include('utils.php');


$ds          = DIRECTORY_SEPARATOR; 
 
$storeFolder = $_POST['path'];
$storeFolderThumb = $_POST['path_thumb'];  
 
if (!empty($_FILES) && $upload_files) {
     
    $tempFile = $_FILES['file']['tmp_name'];   
	
	$arr_ext = explode(".",$_FILES['file']['name']);
	$file_size = $_FILES['file']['size'];
	$ext = $arr_ext[count($arr_ext) - 1];
	$ext = strtolower($ext);
	$arr_allow = array("jpg","png","gif");
	if($file_size > 1000000)
	{
		?>
		<script>alert('hệ thống chỉ hỗ trợ upload hình có kích thước < 1000KB ')</script>
		<?
		exit;
	}
	if(!in_array($ext,$arr_allow))
	{
		?>
		<script>alert('hệ thống chỉ hỗ trợ upload hình jpg,png và gif')</script>
		<?
		exit;
	}
	

   // $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
  //  $targetPathThumb = dirname( __FILE__ ) . $ds. $storeFolderThumb . $ds; 
    $targetPath = $storeFolder; 
    $targetPathThumb = $storeFolderThumb; 

    $targetFile =  $targetPath. $_FILES['file']['name']; 
    $targetFileThumb =  $targetPathThumb. $_FILES['file']['name']; 
    echo "<pre>".print_r($ds,true).'</pre>';
	echo "<pre>".print_r($storeFolder,true).'</pre>';
	echo "<pre>".print_r($storeFolderThumb,true).'</pre>';
	echo "<pre>".print_r($_FILES['file']['name'],true).'</pre>';
    move_uploaded_file($tempFile,$targetFile);
    
    if(in_array(strtolower(substr(strrchr($_FILES['file']['name'],'.'),1)),$ext_img)) $is_img=true;
    else $is_img=false;

    if($is_img){
	create_img_gd($targetFile, $targetFileThumb, 122, 91);

	$imginfo =getimagesize($targetFile);
	$srcWidth = $imginfo[0];
	$srcHeight = $imginfo[1];
	
	if($image_resizing){
		
	    if($image_width==0){
		if($image_height==0){
		    $image_width=$srcWidth;
		    $image_height =$srcHeight;
		}else{
		    $image_width=$image_height*$srcWidth/$srcHeight;
	    }
	    }elseif($image_height==0){
		$image_height =$image_width*$srcHeight/$srcWidth;
	    }
	    $srcWidth=$image_width;
	    $srcHeight=$image_height;
	    create_img_gd($targetFile, $targetFile, $image_width, $image_height);
	}
	
	//max resizing limit control
	$resize=false;
	if($image_max_width!=0 && $srcWidth >$image_max_width){
	    $resize=true;
	    $srcHeight=$image_max_width*$srcHeight/$srcWidth;
	    $srcWidth=$image_max_width;
	}
	
	if($image_max_height!=0 && $srcHeight >$image_max_height){
	    $resize=true;
	    $srcWidth =$image_max_height*$srcWidth/$srcHeight;
	    $srcHeight =$image_max_height;
	}
	if($resize)
	    create_img_gd($targetFile, $targetFile, $srcWidth, $srcHeight);	
	    
    }
}
if(isset($_POST['submit'])){
    $query = http_build_query(array(
        'type'      => $_POST['type'],
        'lang'      => $_POST['lang'],
        'subfolder' => $_POST['subfolder'],
        'popup'     => $_POST['popup'],
        'field_id'  => $_POST['field_id'],
        'editor'    => $_POST['editor'],
        'fldr'      => $_POST['fldr'],
    ));
    header("location: dialog.php?" . $query);
}

?>
