<?php

include_once(__DIR__ . "/../../../resources/login/Login.php");

//session start
session_start();

$email = $_POST['username'];
$password = $_POST['password'];

$login = new Login($email, $password);
$result = $login->validate();

if($result >= 0){
    $_SESSION['isAdmin'] = $result;
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/items");
    exit();
}
else{
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/login");
    exit();
}

?>