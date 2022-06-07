<?php

namespace App\Services;

class Page
{
    public static function part($part_name) {
        require_once "views/layouts/" . $part_name . ".php";
    }

    public static function data($data){
        return $data;
    }
}
