<?php

use app\engine\App;
?>

<a href="/"> Главная </a>
<a href="/product/catalog/"> Каталог </a>
<a href="/basket/"> Корзина <span id="count"><?= $count?></span></a>
<?php if(App::call()->userRepository->isAdmin()): ?>
    <a href="/admin"> Админ панель </a>
<?php endif; ?>
