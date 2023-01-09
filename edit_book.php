<?php
session_start();
require_once 'functions.php';
$book = [];


isAdmin();

if (isset($_GET['id'])) {
    $book = selectOne('books',['id'=>$_GET['id']]);
}

if (isset($_POST['title'])) {
    update('books', $book['id'], $_POST);
    header('location: index.php');
}

if (isset($_GET['del_id'])) {
    delete('books', $_GET['del_id']);
    header('location: index.php');
}


?>

<html>
<link href="style.css" rel="stylesheet" type="text/css">
<div style="width: 100%">
    <form method="post">
        <p style="width: 50%">Редактировать книгу</p>
        <input style="width: 50%" type="text" name="title" value="<?=$book['title']; ?>" required placeholder="Название книги">
        <input style="width: 50%" type="text" name="author" value="<?=$book['author']; ?>" required placeholder="Автор(ы)">
        <input style="width: 50%" type="hidden" name="created_at" value="<?=date("Y-m-d H:i:s"); ?>">
        <div style="display: block; width: 50%">
            <input type="submit" value="Обновить">
            <a href="index.php">
                <input type="button" value="Назад">
            </a>
        </div>
    </form>
</div>

</html>

