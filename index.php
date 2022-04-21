
<?php
    require_once("templates/header.php");
    require_once("templates/card.html");

    use \classes\Dao\UserDAOMysql;
    use \classes\Models\Section;
    

    $section = new Section(new \classes\Sanitize\Sanitize);
    $userDao = new UserDAOMysql($pdo);

    $userData = $userDao->verifyToken(true);

    $typeFormSection = 'create';

?>

<?php require_once("templates/sectionModal.php")?>

<div class="container sections">
    <div class="buttons-add">
    <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" id="create-section" class="btn btn-outline-primary" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSection" data-bs-whatever="@mdo">Criar Sessão</button>
        <button type="button" class="btn btn-primary">Outro</button>
    </div>
    </div>
    <h3 class="text-center ">Sessão de Produtos</h3>
    <div class="container-sections d-flex flex-wrap justify-content-center">     
    </div>
</div>


<script src="js/sections.js"></script>
<script>
  addSections()
</script>

<?php
    require_once("templates/footer.php");

?>
