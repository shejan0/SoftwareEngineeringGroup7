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
    $newPassword = $_POST['newPassword'];
    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
    $newEmail = $_POST['newEmail'];

    if(!empty($_POST['newName'])){
        // update name
        $updateName = "UPDATE admin set name='$newName' where email='$currEmail'";
        $result = mysqli_query($conn,$updateName);
        if ($result) {
            $currName = $newName;
            $_SESSION['name'] = $newName;

            $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
            $_SESSION['message'] .= "Success! Updated name.";
            header("location: settings.php");      
        } else{
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] .= "Error: Failed to update name";
            header("location: settings.php");
        }
    }
    if(!empty($_POST['newPassword'])){
        $updateName = "UPDATE admin set password='$newPassword' where email='$currEmail'";
        $result = mysqli_query($conn,$updateName);
        if ($result) {
            $currName = $newName;
            $_SESSION['password'] = $newPassword;
            $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
            $_SESSION['message'] .= "Success! Updated password.";
            header("location: settings.php");     
        } else{
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] .= "Error: Failed to update password";
            header("location: settings.php");
        }
    }
    if(!empty($_POST['newEmail'])){
        $exists = false;
        $query = "SELECT email FROM admin";
        $result = mysqli_query($conn,$query);
        while($assoc = $result->fetch_assoc()){
            if($newEmail == $assoc['email']){
                $exists = true;
                break;
            }
        }
        if(!$exists){
            $updateName = "UPDATE admin set email='$newEmail' where email='$currEmail'";
            $result = mysqli_query($conn,$updateName);
            if ($result) {
                $currName = $newName;
                $_SESSION['email'] = $newEmail;
                $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
                $_SESSION['message'] .= "Success! Updated email.";
                header("location: settings.php");
            } else{
                $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
                $_SESSION['message'] .= "Error: Failed to update email";
                header("location: settings.php");
            }
        }
        else{
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] .= "Error: Chosen email already exists. Please select a different email";
            header("location: settings.php");
        }
    }
}
