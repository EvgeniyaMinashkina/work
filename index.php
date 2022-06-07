<?php

//use App\Services\Router;

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . "/vendor/autoload.php";

require_once __DIR__ . "/router/routes.php";

//надо чтоб нормально прописать путь до сюда из Router. Определяем ROOT?
define('ROOT', dirname(__FILE__));
require_once (ROOT . '/app/services/Router.php');
//require_once (ROOT . '/app/services/DB.php');
require_once (ROOT . '/app/services/Connection.php');

//Вызов Router
//Router::run();
$router = new App\Services\Router();
$router->run();

//

