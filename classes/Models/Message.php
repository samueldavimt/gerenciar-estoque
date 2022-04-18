<?php

namespace classes\Models;

class Message{

    public $result = [];

    public function returnMessage($error, $resp){
        $this->result['error'] = $error;
        $this->result['response'] = $resp;

        echo json_encode($this->result);
        exit;
    }

   
}