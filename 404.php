<?php 
/* Main page with two forms: sign up and log in */
require 'inc/db.php';
session_start();

include 'init.php';

redirectHome('404 Not Found',5);
?>



<?php include $tpl."footer.php"?>