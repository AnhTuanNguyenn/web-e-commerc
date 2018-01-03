<?
include("administrator/library/config.php");
if($_GET['thread_id'])
{
    $thread_id = (int)$_GET['thread_id'];
    $query_data = $db->select("thread","*",array("where"=>"id='".$thread_id."'AND del=0  AND user_id='".$_SESSION['s_user_id']."'","limit"=>1));
    if(!$arr_data = mysql_fetch_assoc($query_data))
    {
        $err[] = khong_tim_thay_san_pham;
    }
}
$dir_thread = dir_user.'images/thread/';
if(isset($_POST['btn_create_thread']))
{
    $arr_allow = array("title","price","short_content","content","currency");
    $_POST['price'] = str_replace(",","",$_POST['price']);
    $_POST['price'] = str_replace(".","",$_POST['price']);
    $_POST['price'] = (int)$_POST['price'];

    if(count($arr_data) > 0)
    {
        foreach($arr_allow as $allow)
        {
            if(isset($_POST[$allow]))
            {
                $arr_update['value'][$allow] = $db->safeStr($_POST[$allow]);
            }
        }   
        if(isset($_FILES['images']) && count($_FILES['images']) > 0 && !empty($_FILES['images']['name']))
        {
            $images = $db->upload_thread($_FILES['images']);
            if(!empty($images))
            {
                $arr_update['value']['images'] = $images;
            }
            if(!empty($arr_data['images']))
            {
                @unlink($dir_thread."250_".$arr_data['images']);
                @unlink($dir_thread."250x140_".$arr_data['images']);
                @unlink($dir_thread."125x70".$arr_data['images']);
                @unlink($dir_thread.$arr_data['images']);
            }
        }
        

        $arr_update['value']['sub_title'] = $db->unsign($_POST['title']);
        $query_check = $db->select("thread","id",array("where"=>"id!='".$thread_id."' AND sub_title='".$db->unsign($_POST['title'])."' AND user_id='".$_SESSION['s_user_id']."'","limit"=>1));
        if($row_check = mysql_fetch_assoc($query_check))
        {
            $arr_update['value']['sub_title'] = $db->unsign(time()."-".$_POST['title']);
        }
        $arr_update['value']['date_update'] = date("Y-m-d H:i:s");
        $arr_update['where'] = "id='".$thread_id."'  AND user_id='".$_SESSION['s_user_id']."' LIMIT 1";

        $rs_update = $db->update("thread",$arr_update);
        if($rs_update)
        {
            $thread_id = (int)$_GET['thread_id'];
            $query = $db->select("thread","*",array("where"=>"id='".$thread_id."'AND del=0  AND user_id='".$_SESSION['s_user_id']."'","limit"=>1));
            if(!$arr_data = mysql_fetch_assoc($query))
            {
                $err[] = khong_tim_thay_san_pham;
            }
            $err[] = cap_nhat_thanh_cong;
        } else
        {
            $err[] = cap_nhat_that_bai;
        }
    } else
    {
        foreach($arr_allow as $allow)
        {
            if(isset($_POST[$allow]))
            {
                $arr_insert[$allow] = $db->safeStr($_POST[$allow]);
            }
        }
        if(isset($_FILES['images']) && count($_FILES['images']) > 0 && !empty($_FILES['images']['name']))
        {
            $images = $db->upload_thread($_FILES['images']);
            if(!empty($images))
            {
                $arr_insert['images'] = $images;
            }
        }

        $arr_insert['user_id'] = $_SESSION['s_user_id'];
        $arr_insert['sub_title'] = $db->unsign($_POST['title']);
        $query_check = $db->select("thread","id",array("where"=>"id!='".$thread_id."' AND sub_title='".$db->unsign($_POST['title'])."' AND user_id='".$_SESSION['s_user_id']."'","limit"=>1));
        if($row_check = mysql_fetch_assoc($query_check))
        {
            $arr_insert['sub_title'] = $db->unsign(time()."-".$_POST['title']);
        }
        $arr_insert['date_create'] = date("Y-m-d H:i:s");
        $rs_insert = $db->insert("thread",$arr_insert);
        $thread_id = mysql_insert_id();
        if($rs_insert)
        {
            $err[] = them_moi_thanh_cong;
        } else
        {
            $err[] = them_moi_that_bai;
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
<?
include("tpl/tpl_head.php");
?>
<body>
    <div class="header-bg">
        <div class="wrap">
            <div class="h-bg">
                <div class="total">
                    <?
                    $arr_user_menu['product'] = "active";
                    include("tpl/tpl_header.php");
                    ?>
                    
                    <?
                    include("tpl/tpl_menu.php");
                    ?>
                    <div class="banner-top">
                        <div class="header-bottom">
                            <div class="header_bottom_right_images w_100">
                                <?
                                include("tpl/tpl_create_thread.php");
                                ?>
                            </div>
                            
                            <div class="clear"></div>
                            <?
                            include("tpl/tpl_footer.php");
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>