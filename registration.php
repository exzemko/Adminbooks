<?php
require_once 'functions.php';
$errmsg = '';


if ($_POST) {
    $errmsg = register($_POST);
}

?>

<html>
    <link href="style.css" rel="stylesheet" type="text/css">
    <div>
        <form style="width: 30%; justify-content: left" method="post">
            <p style="width: 70%; font-size: 30px">Регистрация</p>
            <div style="width: 100%"><?php echo $errmsg; ?></div>
            <input style="width: 90%" type="text" name="name" required placeholder="Ваше имя"><br>
            <input style="width: 90%" type="text" name="username" required placeholder="Имя пользователя"><br>
            <input style="width: 90%" type="password" name="password" required placeholder="Пароль"><br>
            <input style="width: 90%" type="password" name="password2" required placeholder="Повторите пароль"><br>
            <input type="submit"><br>
            <a href="login.php">
                <input type="button" value="На страницу авторизации">
            </a>
        </form>
    </div>
</html>


