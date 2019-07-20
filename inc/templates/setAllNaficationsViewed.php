<?php

session_start();
include "../functions/functions.php";
include "../db.php";

$userid =  isset($_SESSION['logged_in']) ? $_SESSION['userID'] : 0 ;    

$stmt = $con->prepare("UPDATE naficationsstatus SET readed=1 WHERE friend_id = ? AND readed=0 ");
$stmt->execute(array($userid));

        echo '';
?>