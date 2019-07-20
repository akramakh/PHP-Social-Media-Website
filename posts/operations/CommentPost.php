<?php
session_start();
require "db.php";

if(isset($_POST['postID'])){
    $stmt_comments = $con->prepare("INSERT INTO comments VALUES(?, ?, ?, ?, ?)");
    $stmt_comments->execute(array(null,$_POST['userID'],$_POST['postID'],$_POST['text'],date('Y-m-d H:i:s', time())));    
    
  }

 
?>
