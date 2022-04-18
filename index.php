
<?php
    require_once("templates/header.php");

    use \classes\Dao\UserDAOMysql;

    $userDao = new UserDAOMysql($pdo);

    $userData = $userDao->verifyToken();

    if($userData){
        echo "logado";
    }else{
        echo "nao logado";
    }
?>


<?php
    require_once("templates/footer.php");

?>
