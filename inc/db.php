<?php
/* Database connection settings 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'socialnetwork';
$mysqli = new mysqli($host,$user,$pass,$db) ;//or die($mysqli->error);
*/
$dsn = 'mysql:host=localhost;dbname=socialnetwork';
$user = 'root';
$pass = '';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo 'Failed To Connect '.$e->getMessage();
}