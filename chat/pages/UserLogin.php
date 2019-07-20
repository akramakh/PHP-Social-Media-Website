<?php
include "classes.php";
session_start();
if(isset($_POST['UserMailLogin']) && isset($_POST['UserPasswordLogin']) ){
    $user = new user();
    $user->setUserMail($_POST['UserMailLogin']);
    $user->setUserPassword($_POST['UserPasswordLogin']);
    if($user->userLogin() == true){
        $_SESSION['UserId']=$user->getUserId();
        $_SESSION['UserMail']=$user->getUserMail();
        $_SESSION['UserPassword']=$user->getUserPassword();
        $_SESSION['UserName']=$user->getUserName();
    }
    
}  
?>