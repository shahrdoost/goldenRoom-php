<?php

// starting project at 1399/2/27
// tips after upload script
// 1- change adress captcha font file
// 2- chek ip remote addres at getRealIpAddr() function

session_start();
date_default_timezone_set('Asia/Tehran');
ini_set('display_errors', 1); // erros show
$ip_server = $_SERVER['SERVER_ADDR'];
include 'model/db.php';
include 'model/class.php';
// this if fro after register user need to be login and set other session
$page = @$_SESSION['page'];
// If you have Id you can go
if (empty($_SESSION['onlineid'])) {
} else {

    // set session who need to send message and use

    $app = new USERS();
    $name = $_SESSION['name'];
    $id = $_SESSION['onlineid'];
    $ip = $app->getRealIpAddr();
    $app->SetOnlineId($id, $name, $ip);
    $page = 'main';
}
// redirect from buttom in forms
if (@$_POST['register'] == 'true') {
    $page = 'register';
}
if (@$_POST['logout'] == 'true') {
    $page = 'logout';
}
// after login redirect to login page
if (@$_SESSION['registered'] == 'true') {
    $page = 'login';
    $_SESSION['registered'] = 'false';
}
if (@$_POST['login'] == 'true') {
    $page = 'login';
}
// redirect to requested url
switch ($page) {
    case 'login':
        include 'view/login.php';
        $_SESSION['page'] = 'login';
        break;
        case 'logout':
            //first delet from onlinelist
            $app = new USERS();
            $app->DeletUserFromOnlineList($id);
            // remove all session variables
            session_unset();
            // destroy the session
            session_destroy();
            $_SESSION['page'] = 'login';
            break;
    case 'main':
        include 'view/main.php';
        $_SESSION['page'] = 'main';
        break;
    case 'register':
        include 'view/register.php';
        $_SESSION['page'] = 'register';
        break;
    default:
        include 'view/login.php';
        $_SESSION['page'] = 'login';
}