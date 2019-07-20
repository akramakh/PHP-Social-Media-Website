<?php
require 'inc/db.php';
session_start();
$deactivateTime = $_POST['deactivateTime'];
        $stmt = $con->prepare("UPDATE users SET active = 0, deactivateTime = ? WHERE id = ?");
        $stmt->execute(array($deactivateTime, $_SESSION['userID']));
        //Echo Success Message
        unset($_SESSION['userID']);
        unset($_SESSION['logged_in']);
        session_destroy();
?>
