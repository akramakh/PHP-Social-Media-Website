<?php
require 'inc/db.php';

$userid = isset($_POST['userid']) ? $_POST['userid'] : null;
$friendid = isset($_POST['friendid']) ? $_POST['friendid'] : null;

    $stmt = $con->prepare("INSERT INTO friends(user_id,friend_id) VALUES ('$userid' , '$friendid') ");
    $stmt->execute();
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    if($count > 0){
        echo "<script>alert('success');</script>";
    }else{
        echo "Error";
    }

?>
