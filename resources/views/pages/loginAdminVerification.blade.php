<?php
//session start
session_start();

include_once(__DIR__ . "/../../../dataModels/mappers/SessionMapper.php");
include_once(__DIR__ . "/../../../dataModels/mappers/UserMapper.php");
include_once(__DIR__ . "/../../../database/gateway/UserGateway.php");

$email = $_POST['username'];
$password = $_POST['password'];

$userMap = new UserMapper();
$user = $userMap->setUserFromRecordByEmail($email);

$userGate = new UserGateway();
$result = $userGate->getUserByEmail($email);

//check if the entry exits in the table
if (count($result) > 0) {
    //verify the password
    if($password == $result[0]['password']){
        $_SESSION["isAdmin"] = $result[0]['isAdmin'];
        
		$sessionMap = new SessionMapper();
		$sessionMap->openSession($user);
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/admin");
        exit();
    }
    else{
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/login");
        exit();
    }
}
else{
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/login");
    exit();
}

?>