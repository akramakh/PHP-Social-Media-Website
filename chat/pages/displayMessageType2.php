<?php
include "classes.php";
session_start();
    $FID = $_SESSION['ChatFriendId'];
    $chat = new chat();
    $chat->displayMessageType2($_SESSION['userID'],$FID);
$t = date("Y-m-d H:i:s",time());

    
?>