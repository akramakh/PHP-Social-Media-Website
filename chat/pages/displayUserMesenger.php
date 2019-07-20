<?php
session_start();
include "classes.php";
include "conn.php";
if(isset($_GET['FID'])){
    $chat = new chatMesenger();
    $chat->setUserId($_SESSION['userID']);
    $chat->setFriendId($_GET['FID']);
    $chat->displayChatMesenger($_GET['FID']);
    //$chat->createChatMesengerBox($_GET['FID']);
    /*$stmt1 = $con->prepare("SELECT * FROM test WHERE active=? LIMIT 3");
    $stmt1->execute(array(1));
    $count1 = $stmt1->rowCount();
    while($row1 = $stmt1->fetch()){
        $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
        $stmt->execute(array($row1["user_id"]));
        $row = $stmt->fetch();
       echo'<li>
                <div id="mesenger_user_'.$row["id"].'">
                    <div class="friend-img-cont"><img src="'.$row["user_img"].'"/></div>
                    <i class="fa fa-circle online-i"></i>
                </div>
            </li>'; 
    }*/
}
    
?>
