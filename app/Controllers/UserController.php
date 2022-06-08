<?php

namespace App\Controllers;

use App\Services\Router;
use App\Models\User;

class UserController
{

    /**
     * Describes the behavior for the register
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
                $errors[] = 'Wrong email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Password must not be shorter than 6 characters';
            }

            if (!User::checkPasswordConfirm($password, $password_confirm)) {
                $errors[] = 'Password and password confirmation must be the same';
            }

            if (User::checkEmailExist($email)) {
                $errors[] = 'This email is already in use';
            }

            if ($errors == false) {
                $result = User::register($email, $password);
            }
        }

        require_once(ROOT . '/views/pages/user/register.php');

        return true;
    }

    /**
     * Describes the behavior for the login
     * @return bool
     */
    public function actionLogin()
    {
        // Checking if you are already logged in, then redirect to the products page
        if (!User::isGuest()) {
            Router::redirect('/products');
        }

        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            // Field Validation
            if (!User::checkEmail($email)) {
                $errors[] = 'Wrong email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Password must not be shorter than 6 characters';
            }

            // Checking if the user exists
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $errors[] = "Wrong login or password";
            } else {
                // If the data is correct, remember the user (session)
                User::auth($userId);

                // Redirecting to the products page
                Router::redirect('/products');

            }
        }

        require_once(ROOT . '/views/pages/user/login.php');

        return true;
    }

    /**
     * Remove data from a user from a session
     */
    public function actionLogout()
    {
        session_start();
        unset($_SESSION['user']);
        Router::redirect('/login');
    }

}
