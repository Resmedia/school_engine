<?php

$result = '<nav class="top-nav content">';
$result .= '<ul class="nav">';
$result .= renderMenu(getBdItems('menu', 'position', 'ASC'));
$result .= '<li class="nav__item">';
$result .= !getAuthUser() ? '<a class="nav__link" href="/login">Вход</a>' : '<a class="nav__link" href="/logout">Выход (' . getAuthUser()['name'] .')</a>';
$result .= '<li>';
$result .= '</ul>';
$result .= '</nav>';
?>

<header class="header">
    <?= $result; ?>
</header>

