<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 01.09.19
 * Time: 15:54
 */
$sidebarMenu = 'sidebarMenu.php';

/** @var $menus */
// TODO needs to refactoring auth visible content
?>
<?php
/** @var $content */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/css/main.css?_007">
    <link rel="stylesheet" href="/css/icons.css">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="/js/moment.js?_09"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        moment.locale('ru');
    </script>
</head>
<body>
    <div class="top">
        <?= renderTemplate('header') ?>
        <section class="content">
            <div class="cabinet">
                <?= getAdminUser() ? renderTemplate('admin/sidebarMenu') : null ?>
                <div class="admin-content">
                    <?= $content ?>
                </div>
            </div>
        </section>
    </div>
    <?= renderTemplate('footer') ?>
<script src="/js/cart.js"></script>
<script src="/js/main.js"></script>
</body>
</html>


