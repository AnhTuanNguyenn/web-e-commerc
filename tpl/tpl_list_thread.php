<div class="section group">
    <div class="col span_2_of_c">
        <div class="contact-form">
            <h3><?=danh_sach_san_pham?></h3>
            <table class="list_thread" border="0">
                <thead>
                    <tr>
                        <th class="cc">#</th>
                        <th class="cl"><?=ten_san_pham?></th>
                        <th class="cc">Featured Product</th>
                        <th class="cc"><?=ngay_dang?></th>
                        <th class="cc">H<?=action?></th>   
                    </tr>   
                </thead>
                <tbody>
                    <?
                    $page = (int)$_GET['page'];
                    if($page < 2)
                    {
                        $page = 1;
                    }
                    $limit = 10;
                    $count = ($page-1)*$limit;
                    $query_thread = $db->select("thread","*",array("where"=>"user_id='".$_SESSION['s_user_id']."' AND del=0","order_by"=>"id DESC","limit"=>$count.",".$limit ));
                    while ($query_thread && $row_thread=mysql_fetch_assoc($query_thread) ) {
                        ?>
                        <tr>
                            <td class="cc"><?=++$count?></td>
                            <td class="cl"><?=$row_thread['title']?></td>
                            <td class="cc"><input type="checkbox" <?=($row_thread['flag_hot']==1)?"checked='checked'":""?> thread_id="<?=$row_thread['id']?>" class="chx_featured_product" name="chx_featured_product"></td>
                            <td class="cc"><?=date("d-m-y H:i:s",strtotime($row_thread['date_create']))?></td>
                            <td class="cc"><a href='cap-nhat-san-pham-<?=$row_thread['id']?>.html'><?=cap_nhat?></a> | <a onclick="if(!confirm('<?=ban_muon_xoa_san_pham_nay?>')) {return false;}" href='xoa-san-pham-<?=$row_thread['id']?>.html'><?=xoa?></a></td>
                        </tr>
                        <?
                    }
                    ?>
                    
                </tbody>
                
                <tfoot>
                    <tr>
                        <td colspan="5" class="cr">
                            <?
                            for($i=$page-1;$i<$page+5;$i++)
                            {
                                if($i < 1 || ( $i>$page && mysql_num_rows($query_thread) < $limit ) )
                                {
                                    continue;
                                }

                                ?>
                                <a <?=($i==$page)?"class='active'":"";?> href='p<?=$i?>/quan-ly-san-pham.html'><?=$i?></a>
                                <?
                            }
                            ?>
                            <input type="button" onclick="window.location.href='them-san-pham.html'" class="btn_1" name="btn_create_thread" value="<?=them_san_pham?>" />
                        </td>
                    </tr> 
                </tfoot>
                
            </table>
        </div>
    </div>
    <div class="clear"></div>
</div>
