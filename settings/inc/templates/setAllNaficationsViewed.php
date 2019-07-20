<?php

session_start();
include "../functions/functions.php";
include "../db.php";

$userid =  isset($_SESSION['logged_in']) ? $_SESSION['userID'] : 0 ;    

$stmt = $con->prepare("UPDATE naficationsstatus SET readed=1 WHERE friend_id IN (SELECT user_id from friends WHERE user_id = ? UNION SELECT friend_id from friends WHERE friend_id = ?) AND readed=0 ");
$stmt->execute(array($userid,$userid));

        echo '';
?>