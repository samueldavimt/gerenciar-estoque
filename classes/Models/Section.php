<?php

namespace classes\Models;

use \classes\Sanitize\Sanitize;

class Section {

    public $id;
    public $name;
    public $description;
    public $image;
    public $user_id;

    public $sanitize;


    public function __construct(Sanitize $san){
        $this->sanitize = $san;
    }


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $this->sanitize->clearId($id);
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $this->sanitize->clearInput($name);
    }

    public function getDesc(){
        return $this->description;
    }

    public function setDesc($description){
        $this->description = $this->sanitize->clearInput($description);
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        $this->image = $this->sanitize->clearInput($image);
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $this->sanitize->clearId($user_id);
    }
}

interface SectionDAO{

    public function update();
    public function create();
    public function findAll();
    public function findProductsBySection();


}