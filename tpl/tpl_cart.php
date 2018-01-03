<div class="about_wrapper">
    <h1><?=gio_hang?></h1>
</div>
<div class="view_cart">
    <?
    if(count($_SESSION['s_cart']) < 1)
    {
    	$err[] = "Hiện tại chưa có sản phẩm nào trong giỏ hàng";
    }
    $arr_cart = array();
    if(count($_SESSION['s_cart']) > 0)
    {
     	foreach($_SESSION['s_cart'] as $thread_id =>$arr_data)
	    {
	    	$arr_cart[$thread_id] = $thread_id;
	    }	
    } else 
    {
        $db->redirect("index.html");
        exit;
    }
   
    if(count($arr_cart) > 0)
    {
    		if($_GET['action']=="payment")
    		{
    			include("tpl/tpl_payment.php");
    		} else 
    		{
    			include("tpl/tpl_list_cart.php");
    		}
    		?>
    		
    <?	
    }
    ?>
   
</div>