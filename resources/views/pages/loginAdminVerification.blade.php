<?php
//session start
session_start();

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

$sql = "SELECT * FROM users WHERE email='".$email."' AND isAdmin='1'";
$result = $DBConnection->query($sql);

//check if the entry exits in the table
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    //verify the password
    if($password == $row['password']){
        $_SESSION["isAdmin"] = $row['isAdmin'];
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