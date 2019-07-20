<?php

session_start();
include "../functions/functions.php";
include "../db.php";

$userid =  isset($_SESSION['logged_in']) ? $_SESSION['userID'] : 0 ;    

$stmt = $con->prepare("SELECT * FROM naficationsstatus WHERE friend_id = ?");
$stmt->execute(array($userid));
//$row = $stmt->fetch();
//$count = $stmt->rowCount();
if($stmt->rowCount()>0){
        echo $stmt->rowCount().' Nafications';
}else{
    echo 'Thiere are no Nafications';
}

?>