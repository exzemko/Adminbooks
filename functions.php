<?php
session_start();
require_once 'db.php';



function isAdmin() {
    if ($_SESSION['username'] != 'admin') {
        header('location: login.php');
        die();
    }
}

function isUser() {
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
        die();
    }
}

function logout() {
    if (isset($_POST['unlogin'])) {
        session_destroy();
        header('location: login.php');
    }
}

function register($user) {
    $errmsg = '';
    if ($user['password'] == $user['password2']) {
        unset($user['password2']);
        if (selectOne('users', ['username'=>$user['username']])) {
            $errmsg = 'Такой пользователь уже существует';
        }else {
            insert('users', $user);
            header('location: login.php');
        }
    } else $errmsg = "Пароли не совпадают";
    return $errmsg;
}

function userValidate($user) {
    if (selectOne('users',$user)) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $user['password'];
        header('location: index.php');
    }
    $errmsg = 'Неверный логин или пароль';
    return $errmsg;
}

function addBook($book) {
    $errmsg = '';
    if (isset($book['title'])) {
        if (selectOne('books', $book)) {
            $errmsg = 'Такая книга уже есть';
        } else {
            insert('books', $book);
            header('location: index.php');
        }
    }
    return $errmsg;
}

