<?php
session_start();
require "../db.php";
if(isset($_GET['postID'])){
$stmt_dislikes = $con->prepare("SELECT * FROM dislikes WHERE post_id= ?");
$stmt_dislikes->execute(array($_GET['postID']));
$row_dislikes = $stmt_dislikes->fetch();
?>

<i id="dislike_post_<?php echo $_GET['postID']; ?>" 
   class="fa post-i inverse <?php if($row_dislikes['user_id'] == $_SESSION['userID']) echo 'fa-heart post-disliked'; else echo 'fa-heart-o'; ?>">
</i>
<span><?php echo $stmt_dislikes->rowCount(); ?></span>
<script type="text/javascript">
    $("#dislike_post_<?php echo $_GET['postID'] ?>").click(function(){
         var postID = <?php echo $_GET['postID'] ?> ;       
         var userID = <?php echo $_SESSION['userID'] ?>;       
         $.ajax({ 
            type:'POST', 
            url:'posts/operations/DislikePost.php',
            data:{postID:postID,
                  userID:userID}, 
            success:function(){ 
                $("#cont_dislike_post_<?php echo $_GET['postID'] ?>").load("posts/operations/DisplayDislikePost.php?postID=<?php echo $_GET['postID'] ?>");
                $("#cont_like_post_<?php echo $_GET['postID'] ?>").load("posts/operations/DisplayLikePost.php?postID=<?php echo $_GET['postID'] ?>");
            } 
        });
    });
</script>
<?php
}
?>