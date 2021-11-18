<?php
include_once "../php/inc/user-connection.php";
include_once "inc/session_start.php";

$conn;

if(!$conn){
    $_SESSION['message'] = "Could not connect";
    header("location: settings.php");
    exit();
}
// if form is submitted
if (isset($_POST['update'])) {
    $first = $_POST['first'];
    $last =  $_POST['last'];
    $password =  $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];


    $_SESSION['message'] = " First name: " . $first . " Last name: " . $last . " Email: " . $email . " Password: " . " password: " . $password;
    header("location: settings.php");
    exit();
}
