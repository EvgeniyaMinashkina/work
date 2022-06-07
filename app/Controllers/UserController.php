<?php

namespace App\Controllers;

use App\Services\Router;
use App\Models\User;

class UserController
{

    /**
     * @return bool
     */
    public function actionRegister()
    {

        $email = '';
        $password = '';
        $password_confirm = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            $errors = false;

            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if (!User::checkPasswordConfirm($password, $password_confirm)) {
                $errors[] = 'Пароль и подтверждение пароля должны быть одинаковы';
            }

            if (User::checkEmailExist($email)) {
                $errors[] = 'Такой email уже используется';
            }

            if ($errors == false) {
                $result = User::register($email, $password);
            }
        }

        require_once(ROOT . '/views/pages/user/register.php');

        return true;
    }

    /**
     * @return bool
     */
    public function actionLogin()
    {
        //Проверка залогинен ли если уже да, то перенаправляем на страницу продуктов
        if (!User::isGuest()) {
            Router::redirect('/products');
        }

        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            // Валидация полей
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $errors[] = "Неверный логин или пароль";
            } else {
                //Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);

                //Перенаправляем на страницу products
                Router::redirect('/products');

            }
        }

        require_once(ROOT . '/views/pages/user/login.php');

        return true;
    }

    /**
     * Удаляем данные с пользователя из сессии
     */
    public function actionLogout()
    {
        session_start();
        unset($_SESSION['user']);
        Router::redirect('/login');
    }

}
