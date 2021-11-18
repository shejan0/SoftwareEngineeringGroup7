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

    // if no input field was entered before submitting form
    if (empty($_POST['name']) && empty($_POST['email']) && empty($_POST['password'])){
        $_SESSION['alert'] = "alert alert-warning alert-dismissible fade show";
        $_SESSION['message'] = "Warning: User profile not updated - did not enter any inputs.";
        header("location: settings.php");
        exit();
    }
    $name = $_POST['name'];
    $password =  $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];

        // if invalid email and not empty
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)){
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Not a valid email address";
        header("location: settings.php");
        exit();
    }
    $_SESSION['message'] = "Name:" . $name . " Email: " . $email . " Password: " . " password: " . $password;
    header("location: settings.php");
    exit();
}
