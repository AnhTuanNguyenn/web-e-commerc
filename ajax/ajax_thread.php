<?
include("../administrator/library/config.php");
if($_SESSION['s_user_id'] < 1)
{
    exit;
}
if($_POST['action']=='set_feature')
{
    $arr_update = array();
    $arr_update['value']['flag_hot'] = $_POST['flag'];
    $arr_update['where'] = 'id="'.(int)$_POST['thread_id'].'" AND user_id="'.$_SESSION['s_user_id'].'" LIMIT 1';
    $db->update("thread",$arr_update);
    exit;
}
?>