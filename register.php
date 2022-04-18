
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

<div class="container-register">
        <h1>Crie uma Conta</h1>
        <div class="alert alert-danger" id="register-message" role="alert">
        A simple primary alert—check it out!
        </div>
        <form class="row g-3" method="POST" action="<?=$BASE_URL?>account_action.php" id="form-register">

            <input type="hidden" name="type" value="register">

            <div class="col-md-6">
                <label for="" class="form-label">Nome</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" name="lastname">
            </div>
            <div class="col-12">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="@" name="email">
            </div>
            
           
            
            <div class="col-md-6">
                <label for="" class="form-label">Senha</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Confirme a Senha</label>
                <input type="password" class="form-control" name="c-password">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Criar Conta</button>
            </div>
        </form>
        <div id="emailHelp" class="form-text link-register">Já tem uma Conta? Conecte-se em : <a href="<?=$BASE_URL?>login.php">login</a>
</div>

<?php
    require_once("templates/footer.php");

?>
