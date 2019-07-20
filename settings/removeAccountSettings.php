<?php 
require 'inc/db.php';
session_start();

if(isset($_SESSION['logged_in'])){
?>
<div id="containerRemoveAccountSettings"></div>
<script>
    $(document).ready(function(){
        $("#containerRemoveAccountSettings").load("showRemoveAccountSettings.php");
    });     
</script>
<?php

}
else{
    header('Location: ../index.php');
    
}

?>
