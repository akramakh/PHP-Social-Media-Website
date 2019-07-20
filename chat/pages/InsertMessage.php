<?php
session_start();
include "classes.php";
if(isset($_POST['ChatText'])){
    $chat = new chat();
    $chat->setChatUserId($_SESSION['userID']);
    $chat->setChatText($_POST['ChatText']);
    $chat->setChatFriendId($_SESSION['ChatFriendId']);
    $chat->setChatTime(date('Y-m-d H:i:s', time()));
    $chat->insertChatMessage();
}
    
?>