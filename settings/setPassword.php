<?php
require 'inc/db.php';
session_start();
$id            =   $_SESSION['userID'];
$newpassword   =   $_POST['newpassword'] ;

$stmt = $con->prepare("UPDATE users SET password = ?, pass = ? WHERE id = ? LIMIT 1");
$stmt->execute(array(sha1($newpassword),$newpassword,$id));
    
?>