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

        if(strlen($name) > 50 || strlen($lastname) > 50 || strlen($email) > 50 || strlen($password) > 50 || strlen($c_password) > 50){
            $newMessage->returnMessage("Dados Inválidos! Tente Novamente.", "");

        }
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
        
        $newMessage->returnMessage("", "register success");



    }else{
        
        $newMessage->returnMessage("Preencha Todos os Campos!", "");
    }

}elseif($type == "login"){
    
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if(!empty($email) && !empty($password)){

        if(strlen($email) > 100 ||  strlen($password) > 100){
            $newMessage->returnMessage("Login ou Senha Inválido(s)", "");
        }

        $newUser = new User(new Sanitize());

        $newUser->setEmail($email);
        $newUser->setPass($password);

        $result = $userDAO->login($newUser);

        if($result){
            $newMessage->returnMessage("", "login success");
        }else{
            $newMessage->returnMessage("Login ou Senha Inválido(s)", "");

        }

    }else{
        $newMessage->returnMessage("Preencha Todos os Campos!", "");
    }

}