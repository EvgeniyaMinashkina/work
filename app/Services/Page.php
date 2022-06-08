<?php

namespace App\Services;

class Page
{
    /**
     * Include the necessary part of the view
     * @param $part_name
     * @return void
     */
    public static function part($part_name)
    {
        require_once "views/layouts/" . $part_name . ".php";
    }

    /**
     *
     * @param $data
     * @return mixed
     */
    public static function data($data)
    {
        return $data;
    }
}
