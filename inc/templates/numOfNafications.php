<?php

session_start();
include "../functions/functions.php";
include "../db.php";

$userid =  isset($_SESSION['logged_in']) ? $_SESSION['userID'] : 0 ;    

$stmt = $con->prepare("SELECT * FROM naficationsstatus WHERE friend_id = ? AND readed=0 ");
$stmt->execute(array($userid));
//$row = $stmt->fetch();
//$count = $stmt->rowCount();
if($stmt->rowCount()>0){
    if($stmt->rowCount()<=9){
        echo '<span id="numOfNafications" class="alert-span">'.$stmt->rowCount().'</span>';
    }else{
        echo '<span id="numOfNafications" class="alert-span" style="width:26px;border-radius:9px;">9+</span>';
    }
}else{
    //echo '<span id="numOfNafications" class="alert-span" style="color:green"></span>';
}

?>