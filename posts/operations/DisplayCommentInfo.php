<?php
session_start();
require "../db.php";
if(isset($_GET['postID'])){
$stmt_comments = $con->prepare("SELECT * FROM comments WHERE post_id= ?");
$stmt_comments->execute(array($_GET['postID']));
$row_comments = $stmt_comments->fetch();
?>
<i id="comment_post_<?php echo $_GET['postID']; ?>" 
   class="fa fa-comment-o post-i ">
</i>
<span><?php echo $stmt_comments->rowCount(); ?></span>
<script type="text/javascript">
    $("#comment_post_<?php echo $_GET['postID'] ?>").click(function(){
        $("#comments_container_<?php echo $_GET['postID']; ?>").slideToggle(500);
        $("#comments_box_<?php echo $_GET['postID']; ?>").load("posts/operations/DisplayCommentPostBox.php?postID=<?php echo $_GET['postID'] ?>");
    });
</script>

<?php } ?>