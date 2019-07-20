<?php
session_start();
require "classes.php";

if(isset($_POST['postText'])){
    $post = new post();
    $post->setPostUserId($_SESSION['userID']);
    $post->setPostText($_POST['postText']);
    $post->setPostTime(date('Y-m-d H:i:s', time()));
    $post->insertPost($_SESSION['post_image_location']);
}

 unset($_SESSION['post_image_location']);
session_destroy();
?>
