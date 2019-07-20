<?php
session_start();
require "db.php";

if(isset($_POST['postID'])){
    $stmt_likes = $con->prepare("INSERT INTO likes VALUES(?, ?, ?)");
    $stmt_likes->execute(array($_POST['userID'],$_POST['postID'],date('Y-m-d H:i:s', time())));    
    
    $stmt_dislikes = $con->prepare("DELETE  FROM dislikes WHERE dislikes.user_id = ? AND dislikes.post_id = ?");
    $stmt_dislikes->execute(array($_POST['userID'],$_POST['postID']));
  }

 
?>
