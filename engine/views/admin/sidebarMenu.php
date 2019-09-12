<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 01.09.19
 * Time: 18:03
 */
$menus = [
    [
        'name' => 'Каталог',
        'url' => '/cabinet/catalog',
        'icon' => 'fa-folder',
    ],
    [
        'name' => 'Пользователи',
        'url' => '/cabinet/users',
         'icon' => 'fa-user',
    ],
    [
        'name' => 'Галерея',
        'url' => '/cabinet/gallery',
        'icon' => 'fa-picture-o',
    ],
    [
        'name' => 'Отзывы',
        'url' => '/cabinet/feedback',
        'icon' => 'fa-commenting',
    ],
    [
        'name' => 'Выйти',
        'url' => '/logout',
        'icon' => 'fa-sign-out',
    ],
];

?>

<ul class="sidebar-menu">
    <?php foreach($menus as $menuItem):  $menu = (object)$menuItem ?>
        <li>
            <a href="<?= $menu->url ?>" class="sidebar-link">
                <i class="fa <?= $menu->icon?>"></i>
                <?= $menu->name ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
