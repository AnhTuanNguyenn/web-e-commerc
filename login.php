<?
include("administrator/library/config.php");
if(isset($_POST['btn_login']))
{
    $rs = $db->login($_POST['username'],$_POST['password']);
    if($rs) {
        
        if(!empty($_GET['referer']))
        {
            $referer = urldecode($_GET['referer']);
            $db->redirect($referer);
        } else 
        {
            $db->redirect("index.php");
        }
    } else {
        $err[] = login_failed;
    }
    $_SESSION['s_err'] = $err;
    $db->redirect("login.html");
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
                    include("tpl/tpl_header.php");
                    ?>
                    
                    <?
                    include("tpl/tpl_menu.php");
                    ?>
                    <div class="banner-top">
                        <div class="header-bottom">
                            <div class="header_bottom_right_images">
                                <?
                                include("tpl/tpl_login.php");
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