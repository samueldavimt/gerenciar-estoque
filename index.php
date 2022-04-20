
<?php
    require_once("templates/header.php");

    use \classes\Dao\UserDAOMysql;

    $userDao = new UserDAOMysql($pdo);

    $userData = $userDao->verifyToken(true);

?>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-create-section">

            <input type="hidden" name="type" value="create">
            <label class="col-form-label">
                Imagem da Sessão:
            </label>
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="image-section">
                
            </div>
            
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nome da Sessão:</label>
            <input type="text" class="form-control" name="name-section" id="recipient-name">
          </div>


          <div class="mb-3">
            <label for="message-text" class="col-form-label">Descrição da Sessão:</label>
            <textarea class="form-control" name="desc-section" id="message-text"></textarea>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Criar Sessão</button>
        </div>
        </form>
      </div>
     
    </div>
  </div>
</div>

<div class="container sections">
    <div class="buttons-add">
    <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" id="create-section" class="btn btn-outline-primary" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Criar Sessão</button>
        <button type="button" class="btn btn-primary">Outro</button>
    </div>
    </div>

    <h3 class="text-center ">Sessão de Produtos</h3>
    <?php require_once("templates/message.html");?>

    <div class="container-sections d-flex flex-wrap justify-content-center">
        
        <div class="card section" style="width: 19rem;min-width:302px;display:none;">
            <img src="https://www.vidaloucadecasada.com.br/wp-content/uploads/2018/06/produtos-limpeza-essenciais.jpg.webp" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Produtos de Limpeza</h5>
                <p class="card-text">Itens de Limpeza para casa, variados.</p>
                <a href="#" class="btn btn-primary col-12">Acessar</a>
            </div>

        </div>
    </div>
</div>

<script src="js/sections.js"></script>
<?php
    require_once("templates/footer.php");

?>
