<?php
session_start();
require "db.php";

if(isset($_POST['postID'])){
    $stmt_dislikes = $con->prepare("INSERT INTO dislikes VALUES(?, ?, ?)");
    $stmt_dislikes->execute(array($_POST['userID'],$_POST['postID'],date('Y-m-d H:i:s', time())));
    
    $stmt_likes = $con->prepare("DELETE FROM likes WHERE likes.user_id = ? AND likes.post_id = ?");
    $stmt_likes->execute(array($_POST['userID'],$_POST['postID']));
  }

 
?>
