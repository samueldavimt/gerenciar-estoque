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
    public function update(){}
    public function create(){}

    public function findAll(){

        $stmt = $this->pdo->query("SELECT * FROM sections");

        $sections = [];

        foreach($stmt->fetchAll() as $section){

            $newSection = $this->buildSection($section);

            $sections[] = $newSection;
        }

        return $sections;
    }
    public function findProductsBySection(){}
}