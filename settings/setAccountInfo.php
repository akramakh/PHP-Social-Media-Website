<?php
require 'inc/db.php';
session_start();

    $id            =   $_SESSION['userID'];
    $user          =   $_POST['username'] ;
    $email         =   $_POST['email'] ;
    $phone          =   $_POST['phone'] ;
    $nationality    =   $_POST['nationality'] ;
    $language       =   $_POST['language'] ;
    if($user !=null && $email !=null ){
        if(empty($formError)){
            $stmt = $con->prepare("UPDATE users SET username = ?, email = ?, phone = ?, nationality = ?, language = ? WHERE id  =?");
            $stmt->execute(array($user, $email, $phone, $nationality, $language, $id));
            //Echo Success Message
             echo '<div class="alert alert-success" >  Your Updating Successed</div>';
            }
        foreach($formErrors as $error){
            echo '<div class="alert alert-danger">'.$error.'</div>';
        }
    }else{
        echo 'error';
    }
    
?>