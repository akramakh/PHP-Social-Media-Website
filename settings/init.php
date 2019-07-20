<?php
include 'inc/db.php';
//Routes

$tpl = 'inc/templates/'; //template directory
$css = 'css/'; //css directory
$func = 'inc/functions/'; //css directory
$js = 'js/'; //js directory
$lang = 'inc/languages/';

// Include The Important Files
include $func.'functions.php';
include $lang.'en.php';
include $tpl.'header.php';

// Include Navbar in all Pages Exept The One with $noNavbar variable
if(isset($_SESSION['logged_in'])){
    //include $tpl.'navbar.php';
    
}else{
    //include $tpl.'navbar-defualt.php';
    header('Location: login-system');
}

