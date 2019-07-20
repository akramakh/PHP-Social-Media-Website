<?php
require 'inc/db.php';

$userid = isset($_POST['userid']) ? $_POST['userid'] : null;
$friendid = isset($_POST['friendid']) ? $_POST['friendid'] : null;

    $stmt = $con->prepare("DELETE FROM friends WHERE (user_id = ? AND friend_id = ? ) ||  (user_id = ? AND friend_id = ? )");
    //mysqli_query($con, $stmt);
    $stmt->execute(array($userid, $friendid, $friendid, $userid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    if($count > 0){
        echo "<script>alert('success');</script>";
    }else{
        echo "Error";
    }

?>
