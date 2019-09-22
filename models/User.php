<?php

namespace app\models;

use \ErrorException;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property string $password_hash
 * @property string $default_hash
 * @property int $status
 * @property int $time_create
 * @property int $time_update
 */
class User extends Model
{
    public $id;
    public $name;
    public $email;
    public $pass;
    public $role;
    public $status;
    public $password_hash;
    public $default_hash;
    public $time_create;
    public $time_update;

    public static function getTableName()
    {
        return 'users';
    }

    public function generateHash($password)
    {
        if ($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }
        return $this->errors;
    }

    public function signUp(string $name, string $email, string $password)
    {
        $email = strip_tags(stripslashes($email));
        $name = strip_tags(stripslashes($name));

        if ($name && $email && $password) {

            if (!$this->isValidEmail($email)) {
                throw new \ErrorException('Не верный email');
            }

            if ($this->isValidPassword($password)) {
                throw new \ErrorException('Пароль с ошибками');
            }

            if (!$this->existUser($email)) {

                $this->default_hash = $this->setDefaultHash(11);
                $this->password_hash = $this->generateHash($password);
                $this->time_create = time();
                $this->time_update = time();

                if ($this->save()) {
                    $user = $this->findOne(['email' => $email]);
                    setcookie("hash", $user->default_hash, time() + 3600);
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $user[0]['id'];
                    header("Location: /cabinet/catalog");
                    return true;
                }

            }
            throw new \ErrorException('Пароль существует');
        }

        throw new \ErrorException('Поля пустые');
    }

    public function setDefaultHash(int $count, string $email = '')
    {
        $time = time();
        $hash = bin2hex(random_bytes($count));
        $user = $this->findOne(['email' => $email]);
        if ($email && $user) {
            /** @var $user self */
            $user->default_hash = $hash;
            $user->time_update = $time;
            $user->save();
        }
        return $hash;
    }

    public function login(string $email, string $password)
    {
        $email = strip_tags(stripslashes($email));
        $email = preg_replace('/\s+/', '', $email);

        if ($email && $password) {
            if (!$this->isValidEmail($email)) {
                throw new \ErrorException('Не верный email');
            }

            if ($this->isValidPassword($password)) {
                throw new \ErrorException('Пароль с ошибками');
            }

            $result = $this->findOne(['email' => $email]);

            if ($result) {
                if (password_verify($password, $result['password_hash'])) {
                    header("Location: /");
                }
                throw new \ErrorException('Не верный пароль или email');
            }
            throw new \ErrorException('Не верный пароль или email');
        }
        throw new \ErrorException('Поля пустые');
    }

    public function getAuthUser()
    {
        if (isset($_COOKIE["hash"])) {

            $hash = $_COOKIE["hash"];
            $user = $this->getUserByHash($hash);
            if ($_SESSION['email'] == $user[0]['email']) {
                return $user[0];
            }
        }
        return false;
    }

    public function getAdminUser()
    {
        if (isset($_COOKIE["hash"])) {

            $hash = $_COOKIE["hash"];
            $user = $this->getUserByHash($hash);
            if ($_SESSION['email'] == $user[0]['email'] && $user[0]['role'] == 'admin') {
                return $user[0];
            }
        }
        return false;
    }

    public function getUserByHash(string $hash)
    {
        if (!$hash) {
            throw new ErrorException('Нет хеша!');
        }

        $user = $this->findOne(['default_hash' => $hash]);

        return $user;
    }

    function logout()
    {
        session_destroy();
        setcookie("hash");
        header("Location: /");
    }

    public function existUser($email)
    {
        $user = $this->findOne(['email' => $email]);
        return count($user);
    }

    public function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
    }

    public function isValidPassword($password)
    {
        return preg_match("/\s/", $password) && preg_match('/[a-zA-Z0-9-_$#&]/', $password);
    }
}