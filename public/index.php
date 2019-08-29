<?php
//Точка входа в приложение, сюда мы попадаем каждый раз когда загружаем страницу

include_once "../config/config.php";

$url_array = explode("/", $_SERVER['REQUEST_URI']);

$url = $_SERVER['REQUEST_URI'];

//Читаем параметр page из url, чтобы определить, какую страницу-шаблон
//хочет увидеть пользователь, по умолчанию это будет index

$id = 0;
$page = '';
$count = count($url_array);

for ($i = 0; $i < $count; $i++) {
    if ($count >= 3) {
        $page = $url_array[$count - 2];
        $id = $url_array[$count - 1];
    }
    if ($count < 3) {
        $page = $url_array[1];
    }
    if ($url_array[1] == "") {
        $page = 'main';
    }
}

$params = prepareVariables($url, $id, $_POST);

//Вызываем рендер, и передаем в него имя шаблона и массив подстановок
echo render($page, $params);