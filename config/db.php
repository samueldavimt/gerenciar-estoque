<?php

$host = "localhost";
$user = "samsepiol";
$db = "Gerenciamento";
$pass = "t00r";

try{
    $pdo = new PDO("mysql:host=$host;dbname=$db",$user, $pass);

}catch(PDOException $e){
    echo $e->getMessage();
}