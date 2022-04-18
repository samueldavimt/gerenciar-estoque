<?php

namespace classes\Models;

use \classes\Sanitize\Sanitize;

class User{

    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $token;

    public $sanitize;

    public function __construct(Sanitize $san){
        $this->sanitize = $san;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){   

        $this->id = $this->sanitize->clearId($id);
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){   

        $this->name = $this->sanitize->clearInput($name);
    }

    public function getLastName(){
        return $this->lastname;
    }

    public function setLastName($lastName){   

        $this->lastname = $this->sanitize->clearInput($lastName);
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){   

        $this->email = $this->sanitize->clearInput($email);
    }

    public function getPass(){
        return $this->password;
    }

    public function setPass($pass){   

        $this->password = $this->sanitize->clearInput($pass);
    }


    public function getToken(){
        return $this->token;
    }

    public function setToken($token){   

        $this->token = $this->sanitize->clearToken($token);
    }


    public function generateToken(){
        return bin2hex(random_bytes(50));
    }

    public static function validateEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function generatePassword($pass){

        return password_hash($pass, PASSWORD_DEFAULT);
    }



}


interface UserDAO{

    public function update(User $user);
    public function destroy($id);
    public function findAll();
    public function findById($id);
    public function create(User $user);
}