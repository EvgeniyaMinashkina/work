<?php

namespace App\Models;

use App\Core\Model;
use App\Services\Router;


class User extends Model
{
    /**
     *
     * @param $email
     * @param $password
     * @return bool
     */
    static function register($email, $password)
    {
        $db = self::connection();
        $sql = 'INSERT INTO users (email, password) '
            . 'VALUES (:email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->bindParam(':password', $password, \PDO::PARAM_STR);

        return $result->execute();

    }

    /**
     * Проверка email
     * @param $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет пароль - не меньше чем 6 символов
     * @param $password
     * @return bool
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     *
     * @param $password
     * @param $password_confirm
     * @return bool
     */
    public static function checkPasswordConfirm($password, $password_confirm)
    {
        if ($password == $password_confirm) {
            return true;
        }
        return false;
    }

    /**
     *
     * @param $email
     * @return bool
     */
    public static function checkEmailExist($email)
    {
        $db = self::connection();

        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return $result->execute();
        }
        return false;
    }

    /**
     *
     * @param $email
     * @param $password
     * @return false|mixed
     */
    public static function checkUserData($email, $password)
    {
        $db = self::connection();

        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->bindParam(':password', $password, \PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }
        return false;
    }

    /**
     *
     * @param $userId
     * @return void
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    /**
     *
     * @return mixed|void
     */
    public static function checkLogged()
    {
        //Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        Router::redirect('/login');
        //header("Location: /login"); //Route
    }

    /**
     *
     * @return bool
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     *
     * @param $id
     * @return mixed|void
     */
    public static function getUserById($id)
    {
        //Запрос к БД
        if ($id) {

            $db = self::connection();
            $sql = 'SELECT * FROM users WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, \PDO::PARAM_INT);

            // Указываем, хотим ли получить в виде массива
            $result->setFetchMode(\PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();

        }
    }

    /**
     *
     * @return bool|void
     */
    public static function checkAdmin()
    {
        // Проверяем авторизован ли пользователь
        $userId = self::checkLogged();

        // Получаем информацию о пользоваителе
        $user = self::getUserById($userId);

        // Если стоит флаг что isAdmin, то есть возможность управлять товарами
        if ($user['is_admin'] == '1') {
            return true;
        }

        // Иначе завершаем работу с сообщением о закрытом доступе
        die('Access denied');
    }

}
