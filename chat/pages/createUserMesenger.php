<?php
session_start();
include "classes.php";
include "conn.php";
//$FID = $_SESSION['ChatFriendId'];
if(isset($_GET['FID'])){
    $chat = new chatMesenger();
    $chat->setUserId($_SESSION['userID']);
    $chat->setFriendId($_GET['FID']);
    $chat->createChatMesenger($_GET['FID']);
    $chat->createChatMesengerBox($_GET['FID']);
    $chat->initFriendsList();
    $chat->addFriendToList($_GET['FID']);
    /*$stmt = $con->prepare("INSERT INTO test VALUES(?,?,?) ");
    $stmt->execute(array($_GET['FID'],'test',1));*/
}
    
?>
