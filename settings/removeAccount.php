<?php
require 'inc/db.php';
session_start();
$id = $_POST['id'];
        $stmt = $con->prepare("DELETE FROM chats WHERE ChatUserId = ? OR ChatFriendId = ?");
        $stmt->execute(array($id,$id));

        $stmt = $con->prepare("DELETE FROM comments WHERE user_id = ?");
        $stmt->execute(array($id));

        $stmt = $con->prepare("DELETE FROM likes WHERE user_id = ?");
        $stmt->execute(array($id));

        $stmt = $con->prepare("DELETE FROM disLikes WHERE user_id = ?");
        $stmt->execute(array($id));

        $stmt = $con->prepare("DELETE FROM friends WHERE user_id = ? OR friend_id = ?");
        $stmt->execute(array($id,$id));

        $stmt = $con->prepare("DELETE FROM messages WHERE senderID = ? OR receiverID = ?");
        $stmt->execute(array($id,$id));

        $stmt = $con->prepare("DELETE FROM nafications WHERE user_id = ?");
        $stmt->execute(array($id));

        $stmt = $con->prepare("DELETE FROM naficationsstatus WHERE friend_id = ?");
        $stmt->execute(array($id));

        $stmt = $con->prepare("DELETE FROM pages WHERE ownerID = ?");
        $stmt->execute(array($id));

        $stmt = $con->prepare("DELETE FROM posts WHERE user_id = ?");
        $stmt->execute(array($id));

        $stmt = $con->prepare("DELETE FROM sharedposts WHERE userID = ?");
        $stmt->execute(array($id));

        $stmt = $con->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute(array($id));
        //Echo Success Message
        unset($_SESSION['userID']);
        unset($_SESSION['logged_in']);
        session_destroy();
?>
