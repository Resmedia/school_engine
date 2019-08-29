<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 29.08.19
 * Time: 11:21
 */

$codeText = $code == 404 ?
    'К сожалению такой страницы не существует' :
    ($code == 403 ? 'К сожалению у Вас нет доступа к этой странице' : 'Неизвестная ошибка');

switch ($code) {
    case 404:
        header("HTTP/1.0 404 Not Found");
        break;
    case 403:
        header("HTTP/1.0 403 Access denied");
        break;
    default:
        throw new ErrorException('Error');
}
?>

<div class="container">'
    <h1 class="text-center">
        Ошибка <?= $code ?: '' ?>
    </h1>
    <h2 class="text-center">
        <?= $codeText ?>
    </h2>
</div>
