<?php
include "classes.php";
session_start();
    $FID = $_SESSION['ChatFriendId'];
    $chat = new chat();
    $chat->displayMessage($_SESSION['userID'],$FID);
$t = date("Y-m-d H:i:s",time());
/*if($chat->getChatTime() == $t){
    echo("<script>
                    var msgAlert = new Audio();
                    msgAlert.src = 'sounds/msgAlert.mp3';
                    msgAlert.play();
                    
    </script>");
}*/
    
?>