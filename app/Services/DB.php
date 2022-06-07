<?php

//namespace App\services;

class DB
{

     public static function getConnection()
     {
         $paramsPath = ROOT . '/config/db.php';
         $params = include($paramsPath);

         $dsn = "mysql:host={$params['host']}};dbname={$params['db_name']}";
         $db = new PDO($dsn, $params['username'], $params['password']);

         return $db;

     }
}