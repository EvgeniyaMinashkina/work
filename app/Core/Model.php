<?php

namespace App\Core;

use App\Services\Connection;

abstract class Model
{
    /**
     *
     * @return \PDO
     */
    protected static function connection()
    {
        $paramsPath = include ROOT . '/config/db.php';
        Connection::$dsn  = 'mysql:host=' . $paramsPath['host'] . ';dbname=' . $paramsPath['db_name'];
        Connection::$username  = $paramsPath['username'];
        Connection::$password  = $paramsPath['password'];
        return Connection::getInstance();
    }
}
