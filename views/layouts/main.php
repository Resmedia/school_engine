<?php
/**
 * @var $menu app\models\Menu
 */
$copy = ' © Copyright Company';
$rights = 'All rights reserved';

use app\widgets\MenuWidget;

$menuItems = new MenuWidget($menu)
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Template document</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/icons.css">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
<div class="container">
    <div class="top">
        <header class="header">
            <nav class="top-nav content">
                <ul class="nav">
                    <?= $menuItems->run() ?>
                    <li class="nav__item">
                        <a class="nav__link" href="/cart">
                            <i class="fa fa-shopping-cart">
                                <span class="count-cart">0</span>
                            </i>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        <section class="content">
            <?= $content ?>
        </section>
    </div>
    <footer class="footer">
        <div class="content">
            <div class="copyright">
                <div class="copyright__left">
                    <?= $copy ?>
                </div>
                <div class="copyright__right">
                    <?= $rights ?>
                </div>
            </div>
        </div>
    </footer>
    <script src="/js/main.js"></script>
</body>
</html>