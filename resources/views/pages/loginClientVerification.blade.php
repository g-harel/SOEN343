<?php
//session start
session_start();

include_once(__DIR__ . "/../../../dataModels/mappers/SessionMapper.php");
include_once(__DIR__ . "/../../../dataModels/mappers/UserMapper.php");

$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "soen343";

$DBConnection = new mysqli($serverName, $userName, $password, $databaseName);

if ($DBConnection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='".$email."'";
$result = $DBConnection->query($sql);

//check if the entry exits in the table
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    //verify the password
    if($password == $row['password']){
		$userMap = new UserMapper();
		$user = $userMap->setUserFromRecordByEmail($email);
		$sessionMap = new SessionMapper();
		$sessionMap->openSession($user);
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/");
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