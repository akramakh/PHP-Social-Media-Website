<?php
session_start();
include "classes.php";
if(isset($_POST['ChatText']) && isset($_GET['FID'])){
    $chat = new chatMesenger();
    $chat->setUserId($_SESSION['userID']);
    $chat->setText($_POST['ChatText']);
    $chat->setFriendId($_GET['FID']);
    $chat->setTime(date('Y-m-d H:i:s', time()));
    $chat->insertChatMessage();
}
    
?>