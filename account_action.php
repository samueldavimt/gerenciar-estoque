<?php

header("Content-Type: application/json");

require_once("vendor/autoload.php");
require_once("config/globals.php");

use \classes\Sanitize\Sanitize;
use \classes\Models\User;
use \classes\Dao\UserDAOMysql;
use \classes\Models\Message;

$userDAO = new UserDAOMysql($pdo);
$newMessage = new Message();

$type = filter_input(INPUT_POST, 'type');

if($type == "register"){
   
    $name = filter_input(INPUT_POST, 'name');
    $lastname = filter_input(INPUT_POST, 'lastname');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $c_password = filter_input(INPUT_POST, 'c-password');

    if(!empty($name) && !empty($lastname) && !empty($email) && !empty($password) && !empty($c_password)){
        
        // Efetuando Verificacoes

        if(!User::validateEmail($email)){        
            $newMessage->returnMessage("Este Email é Inválido!", ""); 
        }

        $email = Sanitize::clearInput($email);

        if($userDAO->findByEmail($email)){
            $newMessage->returnMessage("Este email já está Cadastrado!", "");
        }

        if($password != $c_password){
            $newMessage->returnMessage("As Senhas precisam ser Iguais!", "");
        }

        // Registrando

        
        $newUser = new User(new Sanitize());

        $passwordHash = $newUser->generatePassword($password);
        $token = $newUser->generateToken();

        $newUser->setName($name);
        $newUser->setLastName($lastname);
        $newUser->setEmail($email);
        $newUser->setPass($passwordHash);
        $newUser->setToken($token);

        $userDAO->create($newUser);
        
        $newMessage->returnMessage("", true);



    }else{
        
        $newMessage->returnMessage("Preencha Todos os Campos!", "");
    }

}