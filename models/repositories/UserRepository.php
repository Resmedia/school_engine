<?php


namespace app\models\repositories;

use app\models\entities\User;
use app\models\Repository;
use ErrorException;

class UserRepository extends Repository
{

    public function getTableName()
    {
        return 'users';
    }

    public function isAuth()
    {
        $model = new UserRepository();
        if (isset($_COOKIE["hash"])) {

            $hash = $_COOKIE["hash"];
            $user = $model->getUserByHash($hash);
            if ($_SESSION['email'] == $user->email) {
                echo true;
            }
        }
        echo false;
    }

    public function getName()
    {
        return $this->isAuth() ? $this->getEntityClass()->name : "Guest";
    }

    public function getEntityClass()
    {
        return User::class;
    }

    public function getUserByHash(string $hash)
    {
        if (!$hash) {
            throw new ErrorException('Нет хеша!');
        }

        $user = $this->getWhere('default_hash', $hash);

        return $user;
    }

    public function setDefaultHash(int $count, string $email = '')
    {
        $hash = bin2hex(random_bytes($count));
        if ($email) {
            $model = new UserRepository();

            $existUser = $this->getWhere('email', $email);

            $existUser->default_hash = $hash;
            $existUser->time_update = time();

            $model->save($existUser);
        }
        return $hash;
    }

    public function getUser(string $email)
    {
        return $this->getWhere('email', $email);
    }

    public function generatePassHash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function existUser(string $email)
    {
        return empty($this->getWhere('email', $email));
    }

    public function isValidEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
    }

    public function isValidPassword(string $password)
    {
        return preg_match("/\s/", $password);
    }
}