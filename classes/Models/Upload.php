<?php

// 6 = 6291456;

namespace classes\Models;

class Upload {

    protected $fileName;
    protected $fileType;
    protected $fileSize;
    protected $fileLocalTemp;

    public $finalFile;

    protected $alerts = [];

    protected $localUpload;

    protected $mWidht;
    protected $mHeight;


    public function __construct($fileName, $fileType, $fileSize, $fileLocalTemp, $localUpload, $mWidht, $mHeight){

        $this->fileName = $fileName;
        $this->fileType = $fileType;
        $this->fileSize = $fileSize;
        $this->fileLocalTemp = $fileLocalTemp;
        $this->localUpload = $localUpload;
        $this->mHeight = $mHeight;
        $this->mWidht = $mWidht;

        
        if($this->fileSize == 0){
            $this->alerts[] = 'Arquivo vazio';
            return false;
        }
        
        elseif($this->checkName() == false){
            return false;
        }

        elseif($this->checkType() == false){
            return false;
        }

        elseif($this->checkContent() == false){
            return false;
        }
        else{
            $this->execUpload();
        }
    }


    public function checkName(){

        $fileName = $this->fileName;

        // Extensoes Aceitas
        $extAccept = ['.png', '.jpg', 'jpeg'];

        $extFile = substr($fileName, -4);

        if(!in_array($extFile, $extAccept)){
            $this->alerts[] = 'Extensao Invalida';
            return false;
        }

        // Extensoes Invalidas
        $extInvalid = ['txt','php','phtml','js','html','pht'];

        $nameVerify = strtolower($fileName);
        $preg = '/[1234567890]/';
        $nameVerify = preg_replace($preg, '',$nameVerify);

        foreach($extInvalid as $ext){
            if(strpos($nameVerify, $ext) != false){
                $this->alerts[] = "Extensao Invalida Encontrada: $ext";
                return false;
            }
        }

        return true; // Tudo certo!
    }

    public function checkType(){

        $fileType = $this->fileType;

        // Tipos Aceitos
        $typesAccept = ['image/jpg','image/png','image/jpeg'];

        if(!in_array(mime_content_type($this->fileLocalTemp), $typesAccept)){
            $this->alerts[] = "Tipo invalido encontrado: ". mime_content_type($this->fileLocalTemp);

            return false;
        }
        
        return true; // Tudo certo!
    }


    public function checkContent(){

        // Capturando Conteudo do arquivo
        $fileContent = file_get_contents($this->fileLocalTemp);

        // Buscando por Valores Maliciosos
        $filterContent = ['html','system','$_GET','$_POST','<?php', '; ?>'];

        foreach($filterContent as $value){
            if(strpos($fileContent, $value) != false){

                $this->alerts[] = "Erro! Conteudo Inapropriado: $value";
                unlink($this->fileLocalTemp);
                return false;
            }
        }

        /* Caso não Encontre Nehuma string Maliciosa, salve o local do arquivo
            temporario na propriedade $nameFileTemp */

        return true;
        

    }

    protected function ExecUpload(){

        $fileName = md5(time().rand(1,100)).'.jpg';

        $localFileUpload = $this->localUpload . $fileName;

        $this->finalFile = $fileName;

        //rename($this->fileLocalTemp, $localFileUpload);
        move_uploaded_file($this->fileLocalTemp, $localFileUpload);

        $this->resizeImage($localFileUpload, $this->mWidht, $this->mHeight);

        
    }

    public function resizeImage($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }

        if($this->fileType == "image/png"){
            $src = imagecreatefrompng($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            imagepng($dst, $file);
        }else{

            $src = imagecreatefromjpeg($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            imagejpeg($dst, $file);
        }
        
        
    }

    public function getAlerts(){
        return $this->alerts;
    }
    
}
