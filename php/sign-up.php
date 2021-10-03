<?php
include_once "inc/connection.php";

$name = mysqli_real_escape_string($conn, $_POST['name']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$username = mysqli_real_escape_string($conn, $_POST['username']);

if (!empty($email)) {
    if (!empty($password)) {
        $check_email = "SELECT * FROM sign_up WHERE email ='$email'";
        $validate_email = mysqli_query($conn, $check_email);

        // if email is taken
        if (mysqli_num_rows($validate_email) > 0) {
            header("location: ../html/sign-up-error.html");
        }
        // if  email isn't taken, insert into database
        else {
            $sql = "INSERT INTO sign_up (name,email,password) values ('$name','$email','$password')";

            if ($conn->query($sql))
                header("location: ../html/dashboard.html");
            else
                header("location: ../html/sign-up-error.html");
        }
        $conn->close();
    } else {
        header("location: ../html/404-error.html");
        die();
    }
} else {
    header("location: ../html/404-error.html");
    die();
}
