<?php
session_start();
require_once 'functions.php';
$errmsg = '';


if ($_POST) {
    $errmsg = userValidate($_POST);
}


?>


<html>
    <link href="style.css" rel="stylesheet" type="text/css">
    <div>
        <form style="width: 40%; justify-content: left" method="post">
            <p style="float: left; font-size: 30px">Авторизуйтесь</p>
            <div style="width: 100%"><?php echo $errmsg; ?></div>
            <input style="width: 80%" type="text" name="username" required placeholder="Логин"><br>
            <input style="width: 80%" type="password" name="password" required placeholder="Пароль"><br>
            <input type="submit">
            <a href="registration.php">
                <input type="button" value="Регистрация">
            </a>
        </form>


    </div>
</html>


