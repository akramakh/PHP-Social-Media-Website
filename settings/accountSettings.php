<?php 
require 'inc/db.php';
session_start();

if(isset($_SESSION['logged_in'])){
?>
<div id="containerAccountSettings"></div>
<script>
    $(document).ready(function(){
        $("#containerAccountSettings").load("showAccountInfo.php");
    });     
</script>
<?php

}
else{
    header('Location: ../index.php');
    
}

?>

