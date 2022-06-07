<?php

namespace App\Services;


class Connection
{
    protected static $instance;

    public static $dsn;

    public static $username;

    public static $password;

    public function __construct()
    {
        try {
            self::$instance = new \PDO(self::$dsn, self::$username, self::$password);
        } catch (\PDOException $e) {
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            new Connection();
        }

        return self::$instance;
    }
}
