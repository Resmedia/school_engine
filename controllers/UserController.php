<?php


namespace app\controllers;

use app\models\repositories\UserRepository;
use app\models\entities\User;

class UserController extends Controller
{
    public function actionLogin() {
        if (isset($_POST['submit'])) {
            //TODO переделать на request
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            if (!(new UserRepository())->auth($login, $pass)) {
                Die("Не верный пароль!");
            } else
                header("Location: /");
            exit();
        }
    }
    public function actionLogout() {
        session_destroy();
        header("Location: /");
        exit();
    }
}