
<?php
    require_once("templates/header.php");
    
    use \classes\Dao\UserDAOMysql;

    $userDao = new UserDAOMysql($pdo);

    $userData = $userDao->verifyToken();

    if($userData){
        header("Location: index.php");
        exit;
    }
?>

<div class="container-login">
        <h1>Efetuar Login</h1>
        <?php require_once("templates/message.html")?>
        <form method="POST" action="<?=$BASE_URL?>account_action.php" id="form-login">
            <input type="hidden" name="type" value="login">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
           
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div id="emailHelp" class="form-text link-register">Não tem uma Conta? Registre-se em : <a href="<?=$BASE_URL?>register.php">register</a>
</div>

<?php
    require_once("templates/footer.php");

?>
