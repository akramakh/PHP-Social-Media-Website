<?php
include "inc/db.php";
$userid = $_SESSION['logged_in'] ? $_SESSION['userID'] : null;
//$question = $_GET['q'];
    

$stmt = $con->prepare("SELECT * FROM posts ORDER BY post_time DESC");
$stmt->execute();
$row = $stmt->fetch();
$count = $stmt->rowCount();
if($count > 0){
    do{
        if($row['user_id'] == $userid  || isFriend($row['user_id'])){
            $target = $row['user_id'] == $userid ? 'profile.php' : 'friend-area-section.php?friendID='.$row["user_id"] ;
?>
    <li>
        <div class="post">
            <div class="post-header">
                <div class="post-img-cont"><img src="img/user-photo1.jpg"/></div>
                <div class="post-name-cont">
                    <a href="<?php echo $target; ?>" target="_blank"><?php echo getUserInfo('username', $row['user_id']); ?></a>
                </div>
                <tt class="post-time"><?php echo $row['post_time']; ?></tt>
                <i  class="fa fa-ellipsis-v post-i post-option"></i>
                <div class="post-options " >
                    <ul>
                        <li><a href="#">Remove Post</a></li>
                    </ul>
                </div>
            </div>
            <div class="post-text"><abbr><?php echo $row['post_text']; ?></abbr></div>
            <div class="post-content"><img src="img/2.jpg"/></div>
            <div class="post-footer">
                <a href="#"><i class="fa fa-heart post-i"></i></a>
                <a href="#"><i class="fa fa-comment post-i"></i></a>
                <a href="#"><i class="fa fa-share post-i"></i></a>
            </div>
        </div>
    </li>
    <!--<li>
        <div class="post">
            <div class="post-header">
                <div class="post-img-cont"><img src="img/user-photo1.jpg"/></div>
                <div class="post-name-cont">Akram</div>
                <tt class="post-time">12:55:13</tt>
                <i class="fa fa-ellipsis-v post-i"></i>
            </div>
            <div class="post-text"><abbr>hello world .<br/>
                This is asimple Paragraphe Followed by an image I think it is a good design for bigeners</abbr></div>
            <div class="post-content"><img src="img/4.jpg"/></div>
            <div class="post-footer">
                <a href="#"><i class="fa fa-heart post-i"></i></a>
                <a href="#"><i class="fa fa-comment post-i"></i></a>
                <a href="#"><i class="fa fa-share post-i"></i></a>
            </div>
        </div>
    </li>-->
<?php } ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".post-option").click(function(){
            $(".post-options").toggleClass("visible");
        });
    });
</script>
<?php
    }while($row = $stmt->fetch());
} ?>

