<?php 


    require_once("templates/header.php");
    require_once("templates/card.html");

    use \classes\Dao\SectionDAOMysql;
    use \classes\Sanitize\Sanitize;
    use \classes\Dao\UserDAOMysql;

    $userDao = new UserDAOMysql($pdo);
    $sectionDao = new SectionDAOMysql($pdo);
    $sanitize = new Sanitize();

    $userData = $userDao->verifyToken(true);

    if(isset($_GET['id'])){

        $sectionId = $sanitize->clearInput($_GET['id']);

        $section = $sectionDao->findById($sectionId, $userData->id);

        if(!$section){
            echo "<h4>Section not Found!</h4>";exit;
        }

    }

    $typeFormSection = "edit-section"




?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>


<?php require_once("templates/sectionModal.php")?>

<div class="container products">
    <div class="mt-4 info-section d-flex flex-column justify-content-center align-items-center">
        <h3 class="mb-3"><?=$section->getName()?></h3>
        <span class="card-text"><?=$section->getDesc()?></span>
    </div>

    <div class="buttons-add">
        <button type="button" class="btn btn-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Adicionar Produto</button>

        <button type="button" class="btn btn-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSection" data-bs-whatever="@mdo">Editar Sessão</button>
    </div>

    <div class="container products mt-4 container-sections d-flex flex-wrap justify-content-center">
    </div>
</div>

<script src="js/sections.js"></script>

<?php require_once("templates/footer.php")?>
