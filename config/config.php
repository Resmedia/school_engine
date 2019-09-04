<?php
include_once "db.php";
/* DB config */
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', 'root');
define('DB', 'school');

const STATUS_PUBLISHED = 1;

define("CONTROLLERS", '../controllers/');
define("TEMPLATES_DIR", "../views/");
define("LAYOUTS_DIR", 'layout/');
define("ADMIN_DIR", 'admin/');
define("IMAGES_DIR", "/gallery_img/");

include_once CONTROLLERS . 'autoload.php';
include_once "../views/widgets/FeedBackMessage.php";

const ERRORS = [
    'email_error' => 'Email набран с ошибками!',
    'password_error' => 'Пароль имеет недопустимые знаки!',
    'password_user_error' => 'Пользователь или пароль неверный!',
    'fields_empty' => 'Все поля обязательны!',
    'user_exist' => 'Такой пользователь существует!',
    'something_wrong' => 'Что-то пошло не так!',
];