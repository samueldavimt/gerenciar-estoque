<?php


header("Content-Type: application/json");

require_once("config/globals.php");
require_once("vendor/autoload.php");

use \classes\Models\Section;
use \classes\Dao\SectionDAOMysql;
use \classes\Models\Message;
use \classes\Sanitize\Sanitize;
use \classes\Dao\UserDAOMysql;

$sectionDAO = new SectionDAOMysql($pdo);
$userDAO = new UserDAOMysql($pdo);

$newMessage = new Message();

$type = filter_input(INPUT_POST, 'type');

$userData = $userDAO->verifyToken();


if($type){

    if($userData){

        if($type == "all"){
            $newMessage->returnMessage("", $sectionDAO->findAll());
        }
    }else{
        $newMessage->returnMessage("error token", "");
    }
}
