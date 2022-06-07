<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Services\Router;

//use App\models\Product;
include_once ROOT . '/app/models/Product.php';
include_once ROOT . '/app/models/User.php';


class ProductController
{
    public function actionIndex()
    {
        $userId = User::checkLogged();

        // Получаем данные о пользователе из БД
        $user = User::getUserById($userId);

        $productsList = [];
        $productsList = Product::getAll(); //замениь если статик и с use

        require_once(ROOT . '/views/pages/products/index.php');

        return true;
    }

    public function actionView($id)
    {
        $userId = User::checkLogged();

        // Получаем данные о пользователе из БД
        $user = User::getUserById($userId);

        if ($id) {
            $productsItem = Product::get($id);

            require_once(ROOT . '/views/pages/products/view.php');

        }

        return true;
    }

    public function actionCreate()
    {
        //Проверка доступа
        User::checkAdmin();

        //Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['price'] = $_POST['price'];
            $options['quantity'] = $_POST['quantity'];
            $options['manufacturer'] = $_POST['manufacturer'];
            $options['description'] = $_POST['description'];

            // Ошибки в форме
            $errors = false;

            // Можно валидировать необходимые значения
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Field Name is requared. Пожауйста, заполните поле';
            }
            if (!isset($options['manufacturer']) || empty($options['manufacturer'])) {
                $errors[] = 'Field Brand is requared. Пожауйста, заполните поле';
            }

            if($errors == false) {
                //Если ошибок нет, добавляем новый товар
                $id = Product::create($options);

                // Если запись добавлена
                if($id) {
                    //Проверяем, загружалось ли через форму изображение
                    if(is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переносим его в нужную папку, даем имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/uploads/products/{$id}.jpg");
                    }
                }

                //Перенаправляем на страницу управления товарами
                Router::redirect('/products');
            }

        }

        // Подключаем вид
        require_once(ROOT . '/views/pages/products/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        //Проверка доступа
        User::checkAdmin();

        $product = Product::get($id);

        //Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['price'] = $_POST['price'];
            $options['quantity'] = $_POST['quantity'];
            $options['manufacturer'] = $_POST['manufacturer'];
            $options['description'] = $_POST['description'];

            // Ошибки в форме
            $errors = false;

            // Можно валидировать необходимые значения
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Field Name is requared. Пожауйста, заполните поле';
            }
            if (!isset($options['manufacturer']) || empty($options['manufacturer'])) {
                $errors[] = 'Field Brand is requared. Пожауйста, заполните поле';
            }

            if ($errors == false) {
                //Если ошибок нет, сохраняем изменения

                if (Product::update($id, $options)) {
                    //Проверяем, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переносим его в нужную папку, даем имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/uploads/products/{$id}.jpg");
                    }
                }

                //Перенаправляем на страницу управления товарами
                Router::redirect('/products');
            }
        }
        require_once(ROOT . '/views/pages/products/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        // Проверка доступа
        User::checkAdmin();

        // Обработка формы
        if (isset ($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем товар
            Product::delete($id);

            //Перенаправляем пользователя на страницу управления товарами
            Router::redirect('/products');
        }
        // Подключаем вид
        require_once(ROOT . '/views/pages/products/delete.php'); //Возможно для delete не надо
        return true;
    }

    public static function actionSearch(){
        if(isset($_POST['query'])){
            $search =  Product::search($_POST['query']);
            $productsList = $search;
            require_once(ROOT . '/views/pages/products/search.php');
        }

        return true;

//            // Обработка формы
//            if (isset ($_POST['submit'])) {
//                // Если форма отправлена
//                $name = $_POST['search'];
//
//                // Ищем товары по имени
//                $search =  Product::search($name);
//
//                require_once(ROOT . '/views/pages/products/index.php');
//
//            }
//
//            return true;
    }

}
