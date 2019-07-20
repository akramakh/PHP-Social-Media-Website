<?php
include "classes.php";
$id = isset($_GET['friendID']) ? $_GET['friendID'] : $_SESSION['userID'];
$post = new post();
$post->displayPostPrivate();
      
?>