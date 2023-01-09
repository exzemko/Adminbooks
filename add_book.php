<?php
session_start();
require_once 'functions.php';


isAdmin();

$errmsg = addBook($_POST);


?>
<html>
    <link href="style.css" rel="stylesheet" type="text/css">
    <div style="width: 100%">
        <form method="post">
            <p style="width: 50%">Добавить книгу</p>
            <div style="width: 100%"><?php echo $errmsg; ?></div>
            <input style="width: 50%" type="text" name="title" required placeholder="Название книги">
            <input style="width: 50%" type="text" name="author" required placeholder="Автор(ы)">
            <div style="display: block; width: 50%">
                <input type="submit" value="Добавить">
                <a href="index.php">
                    <input type="button" value="Назад">
                </a>
            </div>
        </form>
    </div>

</html>