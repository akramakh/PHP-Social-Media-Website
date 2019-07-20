<?php
session_start();
require "../db.php";
if(isset($_GET['postID'])){
$stmt_likes = $con->prepare("SELECT * FROM likes WHERE post_id= ?");
$stmt_likes->execute(array($_GET['postID']));
$row_likes = $stmt_likes->fetch();
?>

<span><?php echo $stmt_likes->rowCount(); ?></span>
<i id="like_post_<?php echo $_GET['postID']; ?>" 
   class="fa post-i <?php if($row_likes['user_id'] == $_SESSION['userID']) echo 'fa-heart post-liked'; else echo 'fa-heart-o'; ?>">
</i>
<script type="text/javascript">
    $("#like_post_<?php echo $_GET['postID'] ?>").click(function(){
         var postID = <?php echo $_GET['postID'] ?> ;       
         var userID = <?php echo $_SESSION['userID'] ?>;       
         $.ajax({ 
            type:'POST', 
            url:'posts/operations/LikePost.php',
            data:{postID:postID,
                  userID:userID}, 
            success:function(){ 
                $("#cont_like_post_<?php echo $_GET['postID'] ?>").load("posts/operations/DisplayLikePost.php?postID=<?php echo $_GET['postID'] ?>");
                $("#cont_dislike_post_<?php echo $_GET['postID'] ?>").load("posts/operations/DisplayDislikePost.php?postID=<?php echo $_GET['postID'] ?>");
            } 
        });
    });
</script>
<?php
}
?>