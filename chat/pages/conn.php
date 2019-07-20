<?php
try{
    $con = new PDO("mysql:host=localhost;dbname=socialnetwork","root","");
}catch(Exception $e){
    die("ERROR : ".$e->getMessage());
}
?>