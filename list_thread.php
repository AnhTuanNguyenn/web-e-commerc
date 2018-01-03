<?
include("administrator/library/config.php");
if($_SESSION['s_user_id'] < 1)
{
    $db->redirect("logout.html");
    exit;
}
if($_GET['action']=='del')
{
    $arr_update = array();
    $arr_update['value']['del'] = 1;
    $arr_update['where'] = 'id="'.(int)$_GET['thread_id'].'" AND user_id="'.$_SESSION['s_user_id'].'" LIMIT 1';
    $db->update("thread",$arr_update);
    $db->redirect("quan-ly-san-pham.html");
    exit;
}
$query_user = $db->select("user","*",array("where"=>"id='".$_SESSION['s_user_id']."'","limit"=>"1"));
if(!$row_user = mysql_fetch_assoc($query_user))
{
    $db->redirect("logout.html");
    exit;
}
if(isset($_POST['btn_profile']))
{
    // cap nhat thong tin ca nhan
    $arr_allow = array("password","f_name","s_name","email");

    if( ( !empty($_POST['password']) || !empty($_POST['password']) ) && $_POST['password']!=$_POST['cf_password'])
    {
        $err[] = cf_password_wrong;
    } else if( empty($_POST['password']) || empty($_POST['password']) )
    {
        unset($_POST['password']);
    }
    if(count($err) < 1)
    {
        $arr_update = array();
        foreach($arr_allow as $allow)
        {
            if(isset($_POST[$allow]))
            {
                if($allow == "password" && !empty($_POST[$allow]))
                {
                    $password = $db->encrypt(trim($_POST[$allow]));
                    $_POST[$allow] = $password;
                }
                $arr_update['value'][$allow] = $db->safe($_POST[$allow]);
            }
        }
        // kiêm tra xem đa cso email hoặc user này chưa
        $query_check_user = $db->select("user","*",array("where"=>"email='".$_POST['email']."' AND id!='".$_SESSION['s_user_id']."'","limit"=>"1"));
        if($row_check_user = mysql_fetch_assoc($query_check_user) )
        {
            $err[] = account_exits;
        } else
        {
            $arr_update['where'] = "id='".$_SESSION['s_user_id']."' LIMIT 1";
            $rs_update = $db->update("user",$arr_update);
            if(!empty($rs_update))
            {
                $err[] = cap_nhat_thanh_cong;
            } else
            {
                $err[] = cap_nhat_that_bai;
            }

        }   
       
    }
    $_SESSION['s_err'] = $err;
    $db->redirect("profile.html");
    exit;
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
                            <div class="header_bottom_right_images">
                                <?
                                include("tpl/tpl_list_thread.php");
                                ?>
                            </div>
                            <div class="header-para">
                                <?
                                include("tpl/tpl_categories.php");
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