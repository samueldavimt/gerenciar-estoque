<?php

require_once("config/db.php");

$BASE_URL = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';

if(!isset($_SESSION)){
    session_start();
}
