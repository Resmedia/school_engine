<?
session_start();

// TODO Make it all asynchronously!!!

function getAuthUser()
{
    if (isset($_COOKIE["hash"])) {

        $hash = $_COOKIE["hash"];
        $user = getUserByHash($hash);
        if ($_SESSION['email'] == $user[0]['email']) {
            return $user[0];
        }
    }
    return false;
}

function getUserByHash(string $hash)
{
    if (!$hash) {
        throw new ErrorException('Нет хеша!');
    }

    $user = getAssocResult("SELECT * FROM `users` WHERE `default_hash` = '$hash'");

    return $user;
}

function logout()
{
    session_destroy();
    setcookie("hash");
    header("Location: /");
}

function login(string $email, string $password)
{
    $email = strip_tags(stripslashes($email));
    $email = preg_replace('/\s+/', '', $email);

    if($email && $password) {
        if(!isValidEmail($email)) {
            return 'Email набран с ошибками!';
        }

        if(isValidPassword($password)){
            return 'Пароль имеет недопустимые знаки!';
        }

        $result = getAssocResult("SELECT * FROM `users` WHERE `email` = '$email'");

        if ($result) {
            if (password_verify($password, $result[0]['password_hash'])) {
                $hash = setDefaultHash(11, $email);
                setcookie("hash", $hash, time() + 3600);
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $result[0]['id'];
                header("Location: /cabinet/catalog");
            }
            return 'Пользователь или пароль неверный!';
        }
        return 'Пользователь или пароль неверный!';
    }
    return 'Все поля обязательны!';
}

function setDefaultHash(int $count, string $email = '')
{
    $time = time();
    $hash = bin2hex(random_bytes($count));
    if($email){
        updateSql("UPDATE `users` SET `default_hash` = '$hash', `time_update` = '$time' WHERE `email` = '$email'");
    }
    return $hash;
}

function signUp(string $name, string $email, string $password)
{
    $email = strip_tags(stripslashes($email));
    $name = strip_tags(stripslashes($name));

    if($name && $email && $password){

        if(!isValidEmail($email)) {
            return 'Email набран с ошибками!';
        }

        if(isValidPassword($password)){
            return 'Пароль имеет недопустимые знаки!';
        }

        if(!existUser($email)){

            $password_hash = generatePassHash($password);
            $default_hash = setDefaultHash(11);
            $time_create = time();
            $time_update = time();

            $insert = updateSql("
        INSERT INTO `users` (`name`, `email`, `password_hash`, `default_hash`, `role`, `status`, `time_create`, `time_update`) 
                     VALUES ('$name', '$email', '$password_hash', '$default_hash', 'user', 1, '$time_create', '$time_update')
        ");
            if($insert){
                $result = getAssocResult("SELECT * FROM `users` WHERE `email` = '$email'");

                setcookie("hash", $default_hash, time() + 3600);
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $result[0]['id'];
                header("Location: /cabinet/catalog");
                return true;
            }

            return 'Что-то пошло не так!';

        }
        return 'Такой пользователь существует!';
    }

    return 'Все поля обязательны к заполнению!';
}

function generatePassHash(string $password): string
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function existUser($email)
{
    return count(getAssocResult("SELECT * FROM `users` WHERE `email` = '$email'"));
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
}

function isValidPassword($password)
{
    return preg_match("/\s/", $password) && preg_match('/[a-zA-Z0-9-_$#&]/', $password);
}