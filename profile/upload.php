<?php
session_start();
include "db.php";
if($_FILES['file']['name'] != ''){
    $test = explode('.',$_FILES['file']['name']);
    $extension = end($test);
    $name = 'prof'.$_SESSION['userID'].'.'.$extension;
    $location = 'profile/upload/'.$name;
    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$name);
    //$_SESSION['post_image_location'] = $location;
}
$req=$con->prepare("UPDATE users SET user_prof_img = ? WHERE id = ?");
        $req->execute(array($location, $_SESSION['userID']));
?>