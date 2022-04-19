
<?php
    require_once("templates/header.php");

    use \classes\Dao\UserDAOMysql;

    $userDao = new UserDAOMysql($pdo);

    $userData = $userDao->verifyToken(true);

?>


<?php
    require_once("templates/footer.php");

?>
