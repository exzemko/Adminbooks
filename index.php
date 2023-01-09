<?php
session_start();
require_once 'db.php';
require_once 'functions.php';


$books = selectAll('books', options: " ORDER BY created_at DESC");

isUser();
logout();

?>


<html>
    <link href="style.css" rel="stylesheet" type="text/css">
    <div style="width: 100%; display: block">
        <div style="float: right">
            <form method="post">
                <input style="font-size: 16px" type="submit" name="unlogin" value="Выйти из аккаунта">
            </form>
        </div>
    </div>

    <h1 style="width: 100%">
        Список книг
        <?php if ($_SESSION['username'] == 'admin') { ?>
            <a href="add_book.php" style="margin-left: 12px; margin-top: 8px">
                <input type="button" value="Добавить книгу">
            </a>
        <?php } ?>
    </h1>

    <table>
        <?php foreach ($books as $book) { ?>
            <tr>
                <td style="font-size: 20px">
                    <p>Название книги:</p> "<?=$book['title']?>" <p>Автор:</p> <?=$book['author']?><hr>
                </td>
                <?php if ($_SESSION['username'] == 'admin') { ?>
                    <td>
                        <a href="edit_book.php?id=<?=$book['id']; ?>">
                            <input type="submit" for value="Редактировать">
                        </a>
                    </td>
                    <td>
                        <a href="edit_book.php?del_id=<?=$book['id']; ?>">
                            <input type="submit" for value="Удалить">
                        </a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
</html>