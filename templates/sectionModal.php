
<?php

    if($typeFormSection == "edit-section"){
        $buttonName = "Editar Seção";
        $titleModal = "Editar a Seção";
    }else{
        $buttonName = "Criar Seção";
        $titleModal = "Criar Nova Sessão";
    }

?>

<div class="modal fade" id="modalSection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=$titleModal?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="displayMessage(false, '', msg='')"></button>
      </div>
      <div class="modal-body">
      <?php require_once("templates/message.html");?>

        <form id="form-create-section">

            <input type="hidden" name="type" value="<?=$typeFormSection?>">
            
            <?php if($typeFormSection != "edit-section"):?>
                <label class="col-form-label">
                    Imagem da Sessão:
                </label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="image-section">
                    
                </div>
            <?php endif?>
            
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nome da Sessão:</label>
            <input type="text" class="form-control" name="name-section" id="recipient-name" value="<?=$section->getName()?>">
          </div>


          <div class="mb-3">
            <label for="message-text" class="col-form-label">Descrição da Sessão:</label>
            <textarea class="form-control" name="desc-section" id="message-text"><?=$section->getDesc()?></textarea>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="displayMessage(false, '', msg='')">Close</button>
            <button type="submit" class="btn btn-primary"><?=$buttonName?></button>
        </div>
        </form>
      </div>
     
    </div>
  </div>
</div>

