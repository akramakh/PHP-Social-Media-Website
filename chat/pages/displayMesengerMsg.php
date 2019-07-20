<?php
include "classes.php";
session_start();
    $FID = isset($_GET['FID']) ? $_GET['FID'] : 0;
    $chat = new chatMesenger();
    $chat->setUserId($_SESSION['userID']);
    $chat->setFriendId($_GET['FID']);
    $chat->displayMessageType2();
    //$t = date("Y-m-d H:i:s",time());   
?>