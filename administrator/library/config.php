<?
session_start();
if(empty($_SESSION['s_language_id']))
{
	$_SESSION['s_language_id'] = 1;
}
$arr_news = $arr_thread = array();
$category_id = 0;

include dirname(__FILE__)."/config_admin.php";	
include dirname(__FILE__)."/library.php";

$_SESSION['s_script'] = $script;
if((int)$_GET['page'] < 1)
{
	$page = 1;
}
define("dir_web",dirname(dirname(dirname(__FILE__)))."/");
if($_SERVER['REMOTE_ADDR']=="127.0.0.1" || $_SERVER['REMOTE_ADDR']=='::1')
{
	$dir = "http://".$_SERVER['HTTP_HOST']."/ivn.vn/customer/weboto/";
} else 
{
	$dir = "http://".$_SERVER['HTTP_HOST']."/customer/weboto/";
}

define("dir",$dir);
define("dir_library",$dir."library/");
define("host_mail","smtp.gmail.com");
define("port_mail","465");
define("user_mail","@gmail.com");
define("pass_mail","");


$arr_currency = array("usd","euro");
if($_SERVER['REMOTE_ADDR']=="127.0.0.1" || $_SERVER['REMOTE_ADDR']=='::1')
{	
	$host="localhost";
	$user="root";
	$pass="241045051";
	$database="web_db";
} else
{
	$host 		= "localhost";
	$user 		= "";
	$pass 		= '';
	$database	= "";
	
}
$full_dir = trim($dir,"/").$_SERVER['REQUEST_URI'];
$db = new library();
$db->connect($host,$user,$pass,$database);

define("dir_auto_user",dirname(dirname(dirname(__FILE__)))."/data/admin/");
if(isset($_POST['btnFilter']))
{
	str_replace(" ","",$_POST['txtFilter']);
	$_SESSION['s_txtFilter'] = addslashes(trim($_POST['txtFilter']));
	if(strlen($_POST['txtFilter']) < 3)
	{
			$_SESSION['s_txtFilter'] = "";
	}
}
if(time()-$_SESSION['s_create'] > 500)
{
	unset($_SESSION['s_list_user']);
}

$base_href = $dir;	
if($_SERVER['HTTPS']=='on')
{
	$base_href = "https://".$_SERVER['HTTP_HOST']."/";
} 

if(isset($_SESSION['s_user_id']))
{
	if(empty($_SESSION['s_fullname']))
	{
		$_SESSION['s_fullname'] = $_SESSION['s_username'];
	}
	define("dir_user",dirname(dirname(dirname(__FILE__)))."/data/");
} 

define("dir_admin",dirname(dirname(dirname(__FILE__)))."/data/");
define("dir_admin_http",dir."data/");
define("dir_user_http",dir."data/");
$title = "";
include("lang.php");
