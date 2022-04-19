<?php

namespace classes\Dao;

require_once("classes/Models/User.php");


use \classes\Models\UserDAO;
use \classes\Models\User;
use \classes\Sanitize\Sanitize;

class UserDAOMysql implements UserDAO{

    public $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function buildUser($data){
        $newUser = new User(new Sanitize());

        $newUser->setId($data['id']);
        $newUser->setName($data['name']);
        $newUser->setLastName($data['lastname']);
        $newUser->setEmail($data['email']);
        $newUser->setPass($data['password']);
        $newUser->setToken($data['token']);

        return $newUser;

    }

    public function update(User $user){

        $stmt = $this->pdo->prepare("UPDATE users SET name=:name, lastname=:lastname, email=:email, password=:password, token=:token WHERE id=:id");

        $stmt->bindValue(":name", $user->getName());
        $stmt->bindValue(":lastname", $user->getLastName());
        $stmt->bindValue(":email", $user->getEmail());
        $stmt->bindValue(":password", $user->getPass());
        $stmt->bindValue(":token", $user->getToken());
        $stmt->bindValue(":id", $user->getId());


        $stmt->execute();


    }

    public function destroy($id){}
    public function findAll(){}
    public function findById($id){}

    public function findByEmail($email){
        
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");

        $stmt->bindValue(":email",$email);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            
            $user = $this->buildUser($stmt->fetch());
            return $user;
        }else{
            return false;
        }
    }

    public function findByToken($token){

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE token=:token");

        $stmt->bindValue(":token",$token);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            
            $user = $this->buildUser($stmt->fetch());

            return $user;

        }else{
            return false;
        }
    }

    public function create(User $user){

        $stmt = $this->pdo->prepare("INSERT INTO users (name, lastname, email, password, token) VALUES (:n, :l, :e, :p, :t)");

        $stmt->bindValue(":n",$user->getName());
        $stmt->bindValue(":l",$user->getLastName());
        $stmt->bindValue(":e",$user->getEmail());
        $stmt->bindValue(":p",$user->getPass());
        $stmt->bindValue(":t",$user->getToken());
        $stmt->execute();

        $this->setTokenToSession($user->getToken());

    }

    public function setTokenToSession($token){

        $_SESSION['token'] = $token;
    }

    public function verifyToken($protected=false){

        if(isset($_SESSION['token'])){

            $user = $this->findByToken($_SESSION['token']);

            if($user){
                return $user;
            }else{

                if($protected){
                    header("Location: login.php");
                    exit;
                }

                return false;
            }

            
        }else{

            if($protected){
                header("Location: login.php");
                exit;
            }

            return false;
        }
    }

    public function login(User $user){

        $data = $this->findByEmail($user->getEmail());

        if($data){
            
            $key = $data->getPass();

            if(password_verify($user->getPass(), $key)){

                $this->setTokenToSession($data->getToken());
                
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}
