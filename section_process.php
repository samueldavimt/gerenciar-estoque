<?php


header("Content-Type: application/json");

require_once("config/globals.php");
require_once("vendor/autoload.php");

use \classes\Models\Section;
use \classes\Dao\SectionDAOMysql;
use \classes\Models\Message;
use \classes\Sanitize\Sanitize;
use \classes\Dao\UserDAOMysql;
use \classes\Models\Upload;

$sectionDAO = new SectionDAOMysql($pdo);
$userDAO = new UserDAOMysql($pdo);

$newMessage = new Message();

$type = filter_input(INPUT_POST, 'type');

$userData = $userDAO->verifyToken();


if($type){

    if($userData){

        if($type == "all"){
            $newMessage->returnMessage("", $sectionDAO->findAllByUser($userData->id));

        }elseif($type == "create"){
            
            $image = $_FILES['image-section'];
            $name = filter_input(INPUT_POST, "name-section");
            $description = filter_input(INPUT_POST, 'desc-section');

            if(!empty($name) && !empty($description)){
                
                $newSection = new Section(new Sanitize());

                $newSection->setName($name);
                $newSection->setDesc($description);
                $newSection->setUserId($userData->getId());
                
                if(empty($image['name'])){
                    $newSection->setImage("");
                    $sectionDAO->create($newSection);
                    $newMessage->returnMessage("", "create success"); 
                }else{

                    $localUpload = "images/sections/";
                    $imageName = $image['name'];
                    $imageType = $image['type'];
                    $imageTmp = $image['tmp_name'];
                    $imageSize = $image['size'];

                    $upload = new Upload($imageName, $imageType, $imageSize, $imageTmp, $localUpload, 600, 600);

                    if($upload->getAlerts()){
                        $newMessage->returnMessage("Erro ao Carregar Imagem! Tente Novamente.", ""); 

                    }else{

                        $fileName = $upload->finalFile;

                        if($fileName){
                            $newSection->setImage($fileName);
                            $sectionDAO->create($newSection);
                            $newMessage->returnMessage("", "create success");

                        }else{
                            $newMessage->returnMessage("Erro ao Fazer Upload da Imagem!", ""); 

                        }
                    }
                    
                }
                
            }else{

                $newMessage->returnMessage("Insira Todos os Dados!", "");
            }

           
            

        }elseif($type == "edit-section"){
            $newMessage->returnMessage("Ok", "");

        }
    }else{
        $newMessage->returnMessage("error token", "");
    }
}
