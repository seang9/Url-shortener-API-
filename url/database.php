<?php
    $dsn = 'mysql:host=localhost:3307;dbname=shortdb;charset=utf8'; //change host=localhost:3307
    $username = 'root'; //enter your mysql username
    $password = ''; //enter your mysql password
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
       include('database_error.php');
        exit();
    }
?>