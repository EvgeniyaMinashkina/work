<?php

namespace App\Services;

class Router
{
    private $routes;


    public function __construct()
    {
        $routesPath = ROOT . '/router/routes.php';
        $this->routes = include($routesPath); // присваиваем свойству routes массив в файле routes.php
    }

    /**
     * Returns request strings
     * @return string|void
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     *
     * @return void
     */
    public function run()
    {
        // Получить строку запроса
        $uri = $this->getURI();

        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {

            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {

                // Получаем внутренний путь из внешнего согласно правилу
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                // Определить какой контроллер, экшн и параметры

                $segments = explode('/', $internalRoute);

                $controllerName = ucfirst(array_shift($segments)) . 'Controller';

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parametrs = $segments;

                // Подключить файл класса-контроллера

                // Создать объект, вызвать метод (action)
                $controllerPath = "App\Controllers\\" . $controllerName;
                $controllerObject = new $controllerPath();

                    $result = call_user_func_array([$controllerObject, $actionName], $parametrs);

                if ($result != null) {
                    break;
                }
            }
        }
    }

    /**
     *
     * @param $uri
     * @return void
     */
    public static function redirect($uri)
    {
        header('Location: ' . $uri);
    }

}
