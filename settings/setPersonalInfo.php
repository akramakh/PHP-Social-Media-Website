<?php
require 'inc/db.php';
session_start();
$id            =   $_SESSION['userID'];
$fname         =   $_POST['firstname'];
$lname         =   $_POST['lastname'];
$dob           =   $_POST['dob'];
$pob           =   $_POST['pob'];
$site          =   $_POST['site'];
$bio           =   $_POST['bio'];

$formErrors = array();
if(empty($fname)){
    $formErrors[] = 'First Name Can\'t be <b>Empty</b>';
}
if(empty($lname)){
    $formErrors[] = 'Last Name Can\'t be <b>Empty</b>';
}

if($fname !=null && $lname !=null && $dob !=null && $pob !=null  ){
    if(empty($formError)){
        $stmt = $con->prepare("UPDATE users SET first_name = ?, last_name = ?, DOB = ?, POB = ?, site = ?, bio = ? WHERE id  =?");
        $stmt->execute(array($fname, $lname, $dob, $pob, $site, $bio, $id));
//Echo Success Message
         echo '<script>alert("Update Done Successfuly");</script>';
        }
    foreach($formErrors as $error){
        echo '<div class="alert alert-danger">'.$error.'</div>';
    }
}else{
    echo 'error';
}
?>