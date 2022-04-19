<?php
    require_once("templates/header.php");

    use \classes\Dao\UserDAOMysql;

    $userDao = new UserDAOMysql($pdo);

    $userData = $userDao->verifyToken(true);

?>
<div class="container my-account">
    <div class="container-register">
            <?php require_once("templates/message.html")?>
            <h1>Editar Conta</h1>
            <div class="alert alert-danger" id="register-message" role="alert">
            A simple primary alert—check it out!
            </div>

            <form class="row g-3" method="POST" action="<?=$BASE_URL?>account_action.php" id="form-edit">

                <input type="hidden" name="type" value="edit-user">

                <div class="col-md-6">
                    <label for="" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" value="<?=$userData->getName()?>">
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" name="lastname" value="<?=$userData->getLastName()?>">
                </div>
                <div class="col-12">
                    <label for="" class="form-label">Email</label>
                    <input type="text" class="form-control" placeholder="@" name="email" disabled value="<?=$userData->getEmail()?>">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Editar Conta</button>
                </div>
            </form>

            <form class="row g-3" id="form-reset-password">
                <h1>Resetar Senha</h1>
                <input type="hidden" name="type" value="reset-password">
                <div class="col-md-12">
                        <label for="" class="form-label">Senha</label>
                        <input type="password" class="form-control" name="password">
                </div>

                <div class="col-md-12">
                        <label for="" class="form-label">Confirme a Senha</label>
                        <input type="password" class="form-control" name="c-password">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Resetar Senha</button>
                </div>
            </form>
            
    </div>
</div>
<?php
    require_once("templates/footer.php");

?>
