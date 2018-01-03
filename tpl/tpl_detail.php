<?
$query_thread = $db->select("thread as t,user as u","t.*,u.username",array("where"=>"t.id='".(int)$_GET['thread_id']."' AND t.user_id=u.id AND t.del=0","limit"=>1));
if(!$row_thread = mysql_fetch_assoc($query_thread))
{
    $db->redirect("index.html");
    exit;
}
$dir_images = "data/images/thread/250x140_".$row_thread['images'];
if(!is_file($dir_images))
{
    $dir_images = "";
} else 
{
     $dir_images = dir."data/images/thread/250x140_".$row_thread['images'];
}
?>
<div class="about_wrapper">
    <h1><?=$row_thread['title']?></h1>
</div>

<div class="about-group">
    <div class="about-top">
        <?
        if(!empty($dir_images))
        {
            ?>
            <div class="grid images_3_of_1">
                <img src="<?=$dir_images?>" alt="" />
            </div>
            <?
        }
        ?>
        
        <div class="grid span_2_of_3">
            <h3><?=$row_thread['short_content']?></h3>
            <p><?=$row_thread['content']?></p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="links">
        <ul>
            <li><a href="#"><img src="images/blog-icon1.png" title="date"><span><?=date("d-m-Y H:i")?></span></a></li>
            <li><a href="#"><img src="images/blog-icon2.png" title="Admin"><span><?=$row_thread['username']?></span></a></li>
            <li><a href="#"><img src="images/blog-icon3.png" title="Comments"><span>No comments</span></a></li>
            <li><a href="#"><img src="images/blog-icon4.png" title="Lables"><span>View posts</span></a></li>
            <li><a href="#"><img src="images/blog-icon5.png" title="permalink"><span>Permalink</span></a></li>
        </ul>
    </div>
    <div class="team">
        <h2><?=relate_posts?></h2>
        <div class="section group">
            <?
            $query_relate_thread = $db->select("thread","*",array("where"=>"id!='".$row_thread['id']."' AND del=0","order_by"=>"id DESC","limit"=>3));
            while ( $query_relate_thread && $row_relate_thread = mysql_fetch_assoc($query_relate_thread) ) {
                $dir_images = "data/images/thread/250x140_".$row_relate_thread['images'];
                if(!is_file($dir_images))
                {
                    $dir_images = dir."images/bg250x140.jpg";
                } else 
                {
                     $dir_images = dir."data/images/thread/250x140_".$row_relate_thread['images'];
                }
                ?>
                <div class="grid_1_of_3 images_1_of_3">
                    <img onClick="window.location.href='san-pham-<?=$row_relate_thread['id']?>.html'" src="<?=$dir_images?>" alt="<?=$row_relate_thread['title']?>" />
                    <h4><a href="san-pham-<?=$row_relate_thread['id']?>.html"><?=$row_relate_thread['title']?></a></h4>
                </div>
                <?
            }
            ?>
            <div class="clear"></div>
        </div>
        <div class="leave-comment"><a href="#" name="comment">Leave a Comment</a></div>
        <div class="comments-area">
            <form>
                <p>
                    <label>Name</label>
                    <span>*</span>
                    <input type="text" value="">
                </p>
                <p>
                    <label>Email</label>
                    <span>*</span>
                    <input type="text" value="">
                </p>
                <p>
                    <label>Website</label>
                    <input type="text" value="">
                </p>
                <p>
                    <label>Subject</label>
                    <span>*</span>
                    <textarea></textarea>
                </p>
                <p>
                    <input type="submit" value="Post">
                </p>
            </form>
        </div>
    </div>
</div>