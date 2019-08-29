<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 29.08.19
 * Time: 12:54
 */

?>
<div class="container">
    <div class="form-container text-center">
        <?php if (!$user): ?>
            <h1>Регистрация нового пользователя</h1>
            <?php if ($result): ?>
                <div class="alert">
                    <?= $result ?>
                </div>
            <?php endif; ?>
            <form class="registration" method="post">
                <input class="form-control" type="text" name="name" autocomplete="off" placeholder="Ваше ФИО">
                <input class="form-control" type="email" name="email" autocomplete="off" placeholder="Ваш E-mail">
                <input class="form-control" type="password" name="pass" autocomplete="off" placeholder="Ваш Пароль">
                <input type="submit" class="btn btn-success" name="send">
            </form>
            <a href="/login" class="text-center registration-link text-default">
                Войти на сайт
            </a>
        <?php else: ?>
            <h3>Здраствуйте <?= $user['name'] ?>, Вы активированы сайте!</h3>
            <a href="/logout" class="text-center registration-link text-default">
                Выйти из аккаунта
            </a>
        <?php endif; ?>
    </div>
</div>

