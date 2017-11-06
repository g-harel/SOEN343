<?php

include_once(__DIR__ . "/../../../resources/login/Login.php");
include_once(__DIR__ . "/../../../resources/login/Login.php");


//session start
session_start();

$email = $_POST['username'];
$password = $_POST['password'];
// use gateway



//$login = new Login($email, $password);
//$result = $login->validate();
//
//if($result == 1){
//    $_SESSION['isAdmin'] = $result;
////    $gateway =
//    $_SESSION['adminId'] = // id from user table;
//    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/admin");
//    exit();
//}
//else{
//    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/login");
//    exit();
//}
//?>