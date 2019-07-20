<?php
session_start();
require "../db.php";
if(isset($_GET['postID'])){
$stmt_shares = $con->prepare("SELECT * FROM sharedPosts WHERE postID= ?");
$stmt_shares->execute(array($_GET['postID']));
$row_shares = $stmt_shares->fetch();
?>
<i id="share_post_<?php echo $_GET['postID']; ?>" class="fa fa-share-alt post-i"></i>
<?php if($stmt_shares->rowCount() > 0) echo "<span>".$stmt_shares->rowCount()."</span>" ?>
<script type="text/javascript">
    $("#share_post_<?php echo $_GET['postID'] ?>").click(function(){
         var postID = <?php echo $_GET['postID'] ?> ;       
         var userID = <?php echo $_SESSION['userID'] ?>;       
         $.ajax({ 
            type:'POST',
            url:'posts/operations/sharePost.php',
            data:{postID:postID,
                  userID:userID},
            success:function(){ 
                $("#cont_share_post_<?php echo $_GET['postID'] ?>").load("posts/operations/DisplaySharePost.php?postID=<?php echo $_GET['postID'] ?>");
            } 
        });
    });
</script>
<?php
}
?>