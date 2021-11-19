<?php
include_once "../php/inc/user-connection.php";
include_once "inc/session_start.php";

$conn;
if (!$conn) {
    $_SESSION['message'] = "Could not connect";
    header("location: settings.php");
    exit();
}
// if form is submitted
if (isset($_POST['update'])) {

    // if no input field was entered before submitting form
    if (empty($_POST['newName']) && empty($_POST['newEmail']) && empty($_POST['newPassword'])) {
        $_SESSION['alert'] = "alert alert-warning alert-dismissible fade show";
        $_SESSION['message'] = "Warning: User profile not updated - did not enter any inputs.";
        header("location: settings.php");
        exit();
    }
    // if invalid email and not empty
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL) && !empty($newEmail)) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Not a valid email address";
        header("location: settings.php");
        exit();
    }
    // current user info
    $currName = $_SESSION['name'];
    $currEmail = $_SESSION['email'];
    $currPassword = $_SESSION['password'];

    // new user info
    $newName = $_POST['newName'];
    $newPassword =  $_POST['newPassword'];
    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
    $newEmail = $_POST['newEmail'];

    // update name
    $updateName = "UPDATE admin set name='$newName' where name='$currName'";
    $result = mysqli_query($conn,$updateName);
    if ($result) {
        $currName = $newName;
        $_SESSION['name'] = $newName;

        $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
        $_SESSION['message'] = "Success! Updated profile.";

        header("location: settings.php");
        exit();

    } else if (!$result){
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Failed to update profile";
        header("location: settings.php");
        exit();
    }
}
