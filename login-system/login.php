<?php

/* User login process, checks if user exists and password is correct */
include "db.php";
// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND active=1");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist OR This Account in deactive state!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( sha1($_POST['password'])=== $user['password'] ) {
        
        $_SESSION['userID'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['dob'] = $user['DOB'];
        $_SESSION['pob'] = $user['POB'];
        $_SESSION['nationality'] = $user['nationality'];
        $_SESSION['active'] = $user['active'];
        
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;
        // This to set cookie
        header("location: ../");
    }
    else {
        echo '
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
function(){
    //$(document).ready(function(){
        //alert();
        $("#mouth").css({
            "border-bottom": "3px solid transparent",
            "border-top": "3px solid #000",
            "border-left": "1px solid transparent",
            "border-right": "1px solid transparent",
            "border-radius": "50%"
        });
        //$("#mouth").removeClass("smile");
        $("#mouth").addClass("sad");
        //});
    }
</script>';
        
        $_SESSION['message'] = "You have entered wrong password, try again!";
       // header("location: error.php");
    }
}

