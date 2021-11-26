<?php

//for register and login script

define('HOST', 'localhost'); // نام هاست
define('USER', 'root');   // نام کاربری پایگاه داده
define('PASSWORD', ''); // رمز عبور پایگاه داده
define('DATABASE', 'devil');   // نام پایگاه داده

function DB()
{
    // doc for help https://www.roxo.ir/how-to-connect-to-the-database-using-pdo/
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $charset = 'utf8mb4';
    try {
        $db = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD, $options);
        return $db;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
