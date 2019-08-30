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
            <h1><i class="fa fa-sign-in"></i> Вход на сайт</h1>
            <?php if ($result): ?>
                <div class="alert">
                    <?= $result ?>
                </div>
            <?php endif; ?>
            <form class="registration" method="post">
                <input class="form-control" type="email" name="email" autocomplete="off" placeholder="Ваш E-mail">
                <input class="form-control" type="password" name="pass" autocomplete="off" placeholder="Ваш Пароль">
                <button type="submit" class="btn btn-success">Отправить</button>
            </form>
            <a href="/registration" class="text-center registration-link text-default">
                Регистрация на сайте
            </a>
        <?php else: ?>
            <h3>Здраствуйте <?= $user['name'] ?>, Вы активированы сайте!</h3>
            <a href="/logout" class="text-center registration-link text-default">
                Выйти из аккаунта
            </a>
        <?php endif; ?>
    </div>
</div>


