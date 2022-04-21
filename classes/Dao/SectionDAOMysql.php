<?php

namespace classes\Dao;

require_once("classes/Models/Section.php");

use \classes\Models\Section;
use \classes\Sanitize\Sanitize;

class SectionDAOMysql implements \classes\Models\SectionDAO{

    public $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function buildSection($data){

        $section = new Section(new Sanitize());
        $section->setName($data['name']);
        $section->setDesc($data['description']);
        $section->setImage($data['image']);
        $section->setUserId($data['user_id']);
        $section->setId($data['id']);

        return $section;



    }    
    public function update(Section $section){}

    public function create(Section $section){

        $stmt = $this->pdo->prepare("INSERT INTO sections (name, description, image, user_id) VALUES (:name, :desc, :img, :user_id)");

        $stmt->bindValue(":name",$section->getName());
        $stmt->bindValue(":desc",$section->getDesc());
        $stmt->bindValue(":img",$section->getImage());
        $stmt->bindValue(":user_id",$section->getUserId());
        $stmt->execute();

       

    }

    public function findAll(){

        $stmt = $this->pdo->query("SELECT * FROM sections");

        $sections = [];

        foreach($stmt->fetchAll() as $section){

            $newSection = $this->buildSection($section);

            $sections[] = $newSection;
        }

        return $sections;
    }

    public function findAllByUser($id){
        $stmt = $this->pdo->prepare("SELECT * FROM sections WHERE user_id=:id");
        $stmt->bindValue(":id",$id);
        $stmt->execute();

        $sections = [];

        foreach($stmt->fetchAll() as $section){

            $newSection = $this->buildSection($section);

            $sections[] = $newSection;
        }

        return $sections;
    }

    public function findById($id_section, $id_user){

        $stmt = $this->pdo->prepare("SELECT * FROM sections WHERE id=:section_id AND user_id=:user_id");

        $stmt->bindValue(":user_id",$id_user);
        $stmt->bindValue(":section_id",$id_section);

        $stmt->execute();
        
        if($stmt->rowCount() > 0){

            $section = $this->buildSection($stmt->fetch());

        }else{
            return false;
        }
        
        
        return $section;
    }

    public function findProductsBySection($id_section){}
}