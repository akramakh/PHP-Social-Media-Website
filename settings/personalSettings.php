<?php 
/* Main page with two forms: sign up and log in */
require 'inc/db.php';
session_start();
if(isset($_SESSION['logged_in'])){  
?>
<div id="containerPersonalSettings"></div>
<script>
    $(document).ready(function(){
        $("#containerPersonalSettings").load("showPersonalInfo.php");
    });     
</script>
<?php
}else{
    header('Location: index.php');
    exit();
}
?>
