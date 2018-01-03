<?
include("administrator/library/config.php");
if(isset($_POST['btn_register']))
{
    // cap nhat thong tin ca nhan
    $arr_allow = array("username","password","f_name","s_name","email");

    if($_POST['password']!=$_POST['cf_password'])
    {
        $err[] = cf_password_wrong;
    }

    if(count($err) < 1)
    {
        foreach($arr_allow as $allow)
        {
            if(isset($_POST[$allow]))
            {
                if($allow == "password" && !empty($_POST[$allow]))
                {
                    $password = $db->encrypt(trim($_POST[$allow]));
                    $_POST[$allow] = $password;
                }
                $arr_insert[$allow] = $db->safe($_POST[$allow]);
            }
        }
        // kiêm tra xem đa cso email hoặc user này chưa
        $query_user = $db->select("user","*",array("where"=>"username='".$arr_insert['username']."' OR email='".$arr_insert['email']."'"));
        if($row_user = mysql_fetch_assoc($query_user) && $arr_insert['email']!='namlengoc.itpro@gmail.com')
        {
            $err[] = account_exits;
        } else
        {
            $arr_insert['level'] = 1;
            $rs_insert = $db->insert("user",$arr_insert);
            if($rs_insert)
            {
                $user_id =  mysql_insert_id(); 
                $err[] = dang_ky_thanh_cong;
            } else
            {
                $err[] = dang_ky_that_bai;
            }
        }   
        $_SESSION['s_err'] = $err;
        $db->redirect("register.html");
        exit;
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
                    include("tpl/tpl_header.php");
                    ?>
                    
                    <?
                    include("tpl/tpl_menu.php");
                    ?>
                    <div class="banner-top">
                        <div class="header-bottom">
                            <div class="header_bottom_right_images">
                                <?
                                include("tpl/tpl_register.php");
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