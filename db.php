<?php

$driver = 'mysql';
$host = 'localhost';
$db_name = 'adminbooks';
$db_user = 'root';
$db_password = '';
$charset = 'utf8';
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];

$pdo = new PDO("$driver:host=$host;charset=$charset", $db_user, $db_password, $options);
$sql = "SHOW DATABASES LIKE '$db_name'";
$db = $pdo->query($sql);
if ($db->rowCount() == 1) {
    unset($pdo);
    $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_password, $options);
    $tb1 = $pdo->query('SHOW TABLES LIKE "users"');
    $tb2 = $pdo->query('SHOW TABLES LIKE "books"');
    if (!$tb1->rowCount() == 1) {
        $table1 = "CREATE TABLE `$db_name`.`users` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `username` 
        VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
        PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        $pdo->query($table1);
    }
    if (!$tb2->rowCount() == 1) {
        $table2 = "CREATE TABLE `$db_name`.`books` (`id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(100) NOT NULL , `author` 
        VARCHAR(100) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        $pdo->query($table2);
    }
} else {
    $sql = "CREATE DATABASE $db_name";
    $pdo->query($sql);
    unset($pdo);
}


function selectAll(string $table, array $params = [], $options = '') {
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key=>$value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=:$key";
            } else {
                $sql = $sql . " AND $key=:$key";
            }
            $i++;
        }
    }
    $sql = $sql.$options;
    $query = $pdo->prepare($sql);
    $query->execute($params);

    return $query->fetchAll();
}

function selectOne(string $table, array $params = []) {
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key=>$value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=:$key";
            } else {
                $sql = $sql . " AND $key=:$key";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute($params);

    return $query->fetch();
}

function insert($table, $params) {
    global $pdo;
    $i = 0;
    $fields = '';
    $mask = '';
    foreach ($params as $key=>$value) {
        if ($i === 0) {
            $fields = $fields."$key";
            $mask = $mask.":$key";
        }else {
            $fields = $fields.", "."$key";
            $mask = $mask.", ".":$key";
        }
        $i++;
    };
    $sql = "INSERT INTO $table ($fields) VALUES ($mask);";

    $query = $pdo->prepare($sql);
    $query->execute($params);
    return $pdo->lastInsertId();
}

function update($table, $id, $params) {
    global $pdo;
    $i = 0;
    $row = '';
    foreach ($params as $key=>$value) {
        if ($i === 0) {
            $row = $row.$key."=:".$key;
        }else {
            $row = $row.", ".$key."=:".$key;
        }
        $i++;
    };
    $sql = "UPDATE $table SET $row WHERE id=$id";

    $query = $pdo->prepare($sql);
    $query->execute($params);
}

function delete($table, $id) {
    global $pdo;
    $sql = "DELETE FROM $table WHERE id=$id";

    $query = $pdo->prepare($sql);
    $query->execute();
}

