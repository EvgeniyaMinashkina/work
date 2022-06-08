<?php

namespace App\Services;

class Router
{
    private $routes;


    public function __construct()
    {
        $routesPath = ROOT . '/router/routes.php';
        // Assign an array to the routes property in the routes.php file
        $this->routes = include($routesPath);
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
        // Get query string
        $uri = $this->getURI();

        // Check for such a request in routes.php
        foreach ($this->routes as $uriPattern => $path) {

            // Compare $uriPattern and $uri
            if (preg_match("~$uriPattern~", $uri)) {
                if ($uriPattern or $_SERVER['REQUEST_URI'] === '/') {
                    // We get the internal path from the external according to the rule
                    $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                    // Determine controller, action and parameters

                    $segments = explode('/', $internalRoute);

                    $controllerName = ucfirst(array_shift($segments)) . 'Controller';

                    $actionName = 'action' . ucfirst(array_shift($segments));

                    $parametrs = $segments;

                    // Include controller class file

                    // Create object, call method (action)
                    $controllerPath = "App\Controllers\\" . $controllerName;
                    $controllerObject = new $controllerPath();

                    $result = call_user_func_array([$controllerObject, $actionName], $parametrs);

                    if ($result != null) {
                        break;
                    }
                } else {
                    self::error('404');
                }
            }
        }
    }

    /**
     * Redirects to the page by the $uri
     * @param $uri
     * @return void
     */
    public static function redirect($uri)
    {
        header('Location: ' . $uri);
    }

    /**
     * Connects the corresponding error page
     * @param $error
     * @return void
     */
    public static function error($error) {
        require_once (ROOT . "/views/errors/" . $error . ".php");
    }

}
