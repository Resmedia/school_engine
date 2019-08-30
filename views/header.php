<?php

// TODO Refactoring all this!

$result = '<nav class="top-nav content">';
$result .= '<ul class="nav">';
$result .= renderMenu(getBdItems('menu', 'position', 'ASC'));
$result .= '<li class="nav__item">';
$result .= !getAuthUser() ? '<a class="nav__link" href="/login">Вход</a>' : '<a class="nav__link" href="/logout">Выход (' . getAuthUser()['name'] .')</a>';
$result .= '</li>';
$result .= '<li class="nav__item">';
$result .= '<a class="nav__link" href="/cart">
               <i class="fa fa-shopping-cart"></i>
               <span class="count-cart">' . getCartCount() . '</span>
               <span class="price-area">
                   Итого: <span class="total-price"> ' . getTotalPrice() . ' </span> руб.
               </span>
           </a>';
$result .= '</li>';
$result .= '</ul>';
$result .= '</nav>';
?>

<header class="header">
    <?= $result; ?>
</header>

