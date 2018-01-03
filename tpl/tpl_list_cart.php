<table border="1" class="list_cart">
		<thead>
			<tr>
				<th colspan="2"><?=product?></th>
				<th><?=price?></th>
				<th><?=total?></th>
				<th><?=total_price?></th>
			</tr>
		</thead>
    	<tbody>
    		<?
    		$total_price = 0;
            $arr_curr = array("usd"=>'$',"euro"=>"&euro;");
    		$query_thread = $db->select("thread","*",array("where"=>"id IN (".implode(",",$arr_cart).") AND del=0"));

            $arr_payment = array();
	    	while ($query_thread && $row_thread = mysql_fetch_assoc($query_thread)) 
	    	{
	    		$thread_id = $row_thread['id'];
				$category_shop_id = $row_thread['category_shop_id'];
				$price = contact;
				if($row_thread['price'] > 0)
				{
					$price = $arr_curr[$row_thread['currency']].number_format($row_thread['price']);	

                    $arr_payment[$row_thread['currency']] +=$row_thread['price']*$_SESSION['s_cart'][$thread_id]['total'];
				}
    		?>
    		<tr id="thread_id-<?=$thread_id?>" thread_id="<?=$thread_id?>">
    			<td width="15%">
    			<?
    			if(empty($row_thread['images']))
				{
				?>
					<img alt="<?=$row_thread['title']?>" src="<?=dir?>images/bg400x300.jpg" />
				<?
				} else 
				{
				?>
					<img alt="<?=$row_thread['title']?>" src="<?=dir_user_http?>images/thread/250_<?=$row_thread['images']?>" />
				<?
				}
    			?>	
    			</td>
    			<td width="30%" style="vertical-align: top">
    				<a href="xoa-don-hang-<?=$thread_id?>.html">
    					<?=del_of_cart?>
    				</a><hr/>
    				<a href="<?=$arr_info_category[$category_shop_id]['sub_title']."/".$row_thread['sub_title'];?>">
    					<?=$row_thread['title']?>
    				</a>	
    			</td>
    			<td class="price" width="15%"  style="vertical-align: middle;"><?=$price?></td>
    			<td width="25%" class="cc"  style="vertical-align: middle;">
    				<span class="prev_total">-</span>
    				<span class="total"><?=$_SESSION['s_cart'][$thread_id]['total']?></span>
    				<span class="next_total">+</span>
    			</td>
    			<td class="total_price" width="15%"   style="vertical-align: middle;">
    				<?
    				if($row_thread['price'] > 0)
					{
						$total_price +=$row_thread['price']*$_SESSION['s_cart'][$thread_id]['total'];
						?><?=$arr_curr[$row_thread['currency']].number_format($row_thread['price']*$_SESSION['s_cart'][$thread_id]['total'])?><?
					} else 
					{
						?>
						<?=please_contact?>
						<?
					}
    				?>
    			</td>
    		</tr>
    		<?
		    }
		    ?>
    	</tbody>
    	<tfoot>
    		<tr>
    			<td colspan="5" class="full_price">
    				

                    <?
                    $count = 0;
                    foreach($arr_payment as $currency=>$total_price)
                    {
                        ?><p><?=$arr_curr[$currency].number_format(  $total_price )?></p><?
                    }
                    ?>
                    (<?=count($_SESSION['s_cart'])?> <?=product?>)
    			</td>
    		</tr>
    		<tr>
    			<td colspan="5" class="process_cart">
    				<a href="index.html" title="<?=tiep_tuc_mua_sam?>"><?=tiep_tuc_mua_sam?></a>
    				<a href="xem-don-hang.html" title="<?=cap_nhat_don_hang?>"><?=cap_nhat_don_hang?></a>
    				<a href="thanh-toan-don-hang.html" title="<?=thanh_toan_don_hang?>"><?=thanh_toan_don_hang?></a>
    			</td>
    		</tr>
    	</tfoot>
    </table>