<?
	include("../library/config.php");
	if($_POST['action']=='order')
	{
		$thread_id = $_POST['thread_id'];
		if($thread_id < 1)
		{
			$arr_code['code'] = 0;
			$arr_code['msg'] = khong_tim_thay_san_pham;
			echo json_encode($arr_code);
			exit;
		}
		if(!isset($_SESSION['s_cart'][$thread_id]))
		{
			$_SESSION['s_cart'][$thread_id] = array();
			$_SESSION['s_cart'][$thread_id]['total'] = 0;
			$arr_code['msg'] = da_them_vao_gio_hang;
		} else 
		{	
			
			$arr_code['msg'] = san_pham_nay_da_them_truoc_do_roi;
		}
		if(empty($_POST['type']) || $_POST['type']=="next")
		{
			$_SESSION['s_cart'][$thread_id]['total'] += 1;
		} else if($_POST['type']=="prev")
		{
			$_SESSION['s_cart'][$thread_id]['total'] -= 1;
		}
		
		$arr_code['code'] = 1000;
		$arr_code['total'] = count($_SESSION['s_cart']);
		echo json_encode($arr_code);
		exit;
	}
?>
