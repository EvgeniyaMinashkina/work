<?php

namespace App\Models;

use App\Core\Model;
use App\Services\Router;


class User extends Model
{
    /**
     * Adding a new registered user to the database
     * @param $email
     * @param $password
     * @return bool
     */
    static function register($email, $password)
    {
        $db = self::connection();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO users (email, password) '
            . 'VALUES (:email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->bindParam(':password', $password, \PDO::PARAM_STR);

        return $result->execute();

    }

    /**
     * Email verification
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
     * Checks password - no less than 6 characters
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
     * Checks if the password matches
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
     * Checking if an email exists in the database
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

        $sql = 'SELECT * FROM users WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();

        if ($user) {
            if(password_verify($password, $user['password'])){
                return $user['id'];
            }
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
     * Checking if the user is logged in
     * Checking if a session exists
     * @return mixed|void
     */
    public static function checkLogged()
    {
        //If there is a session, return the user ID
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        Router::redirect('/login');
    }

    /**
     * Checking if the user is logged in
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
     * Getting user information with specified id
     * @param $id
     * @return mixed|void
     */
    public static function getUserById($id)
    {
        if ($id) {

            $db = self::connection();
            $sql = 'SELECT * FROM users WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, \PDO::PARAM_INT);

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
        // Checking if the user is logged in
        $userId = self::checkLogged();

        // Getting user information
        $user = self::getUserById($userId);

        // If there is a flag that isAdmin, then it is possible to manage goods
        if ($user['is_admin'] == '1') {
            return true;
        }

        // Otherwise, we exit with a message about closed access
        die('Access denied');
    }

}
