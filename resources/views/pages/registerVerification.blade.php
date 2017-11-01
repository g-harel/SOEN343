<?php

include_once(__DIR__ . "/../../../resources/login/Register.php");

session_start();
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$is_Admin = false;
$phoneNumber = $_POST['phone_number'];


$doorNumber = $_POST['door_number'];
$street = $_POST['street'];
$appt = $_POST['appartment'];
$city = $_POST['city'];
$province = $_POST['province'];
$country = $_POST['country'];
$postalCode = $_POST['postal_code'];


$register = new Register($firstName,$lastName,$email,$password,$phoneNumber,$doorNumber,$street,$appt,$city,$province,$country,$postalCode);
$result = $register->createUser();

if($result >= 0) {
    $_SESSION['isAdmin'] = $result;
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/login");
    exit();
}

else {
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/register");
    exit();
}

?>