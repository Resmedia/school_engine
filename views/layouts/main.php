<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Template document</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php if ($auth): ?>
        Добро пожаловать <?= $username ?> <a href="/user/logout/"> [Выход]</a>
    <?php else: ?>
        <br/><br/>
        <label>Вход:</label>
        <br>
        <div id="login" class="row">
            <div class="col">
                <input id="login-email" class="form-control" type="text" name="email" placeholder="Логин">
            </div>
            <div class="col">
                <input id="login-password" class="form-control" type="password" name="password" placeholder="Пароль">
            </div>
            <div class="col">
                <button id="login-btn" class="btn btn-success">Вход</button>
            </div>
            <div class="help-block"></div>
        </div>
        <br/>
        <label>Регистрация:</label>
        <br>
        <div id="signUp" class="row">
            <div class="col">
                <input id="sign-email" class="form-control" type="text" name="email" placeholder="Логин">
            </div>
            <div class="col">
                <input id="sign-name" class="form-control" type="text" name="name" placeholder="Имя">
            </div>
            <div class="col">
                <input id="sign-password" class="form-control" type="password" name="password" placeholder="Пароль">
            </div>
            <div class="col">
                <button id="sign-btn" class="btn btn-primary">Регистрация</button>
            </div>
            <div class="help-block"></div>
        </div>
    <?php endif; ?><br>

    <?= $menu ?><br>
    <?= $content ?>
</div>
<script src="/js/main.js?_=<?= time() ?>"></script>
</body>
</html>