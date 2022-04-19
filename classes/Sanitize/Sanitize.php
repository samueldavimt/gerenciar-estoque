<?php

namespace classes\Sanitize;

class Sanitize{

    public static function clearInput($input){

        $input = trim($input);
        $input = strip_tags($input);
        $input = filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS);

        return $input;

    }

    public function clearId($id){

        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $id = addslashes($id);

        return $id;
    }

    public function clearToken($token){

        return addslashes($token);
    }
}

