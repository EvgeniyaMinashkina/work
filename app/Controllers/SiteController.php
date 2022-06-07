<?php

namespace App\Controllers;

use App\Services\Router;

class SiteController
{
    public function actionIndex(){

        require_once (__DIR__ . '/views/pages/index.php');

        return true;
    }
}
