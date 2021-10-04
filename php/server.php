<?php
include_once "inc/user-connection.php";

session_start();

$name = mysqli_real_escape_string($conn, $_POST['name']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

// sign up 
if (isset($_POST['sign-up'])) {
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
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $name;

                if ($conn->query($sql))
                    header("location: dashboard.php");
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
}

// sign in
if (isset($_POST['sign-in'])) {

    // Data sanitization to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($email)) {
        if (!empty($password)) {
            $sql = 'SELECT email, password FROM sign_up WHERE email = ?';

            // preparing the SQL statement will prevent SQL injection.
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('s', $_POST['email']);
                $stmt->execute();
                $stmt->store_result(); // Store the result so we can check if the account exists in the database.

                // If email exists in sign_up table
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($email, $password);
                    $stmt->fetch();

                    // if password user enters matches the one in the database
                    if ($_POST['password'] === $password) {

                        $_SESSION['email'] = $email;
                        $_SESSION['name'] = $name;

                        // upon successful login, redirect user to landing apge
                        header("location: dashboard.php");
                    } else {
                        // Incorrect password
                        header("location: ../html/sign-in-error.html");
                    }
                } else {
                    // Incorrect username
                    header("location: ../html/sign-in-error.html");
                }
                $stmt->close();
            }
        } else {
            header("location: ../html/404-error.html");
            die();
        }
    } else {
        header("location: ../html/404-error.html");
        die();
    }
}

if (isset($_POST['admin-sign-in'])) {

    // Data sanitization to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($email)) {
        if (!empty($password)) {
            $sql = 'SELECT email, password FROM admin WHERE email = ?';

            // preparing the SQL statement will prevent SQL injection.
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('s', $_POST['email']);
                $stmt->execute();
                $stmt->store_result(); // Store the result so we can check if the account exists in the database.

                // If email exists in sign_up table
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($email, $password);
                    $stmt->fetch();

                    // if password user enters matches the one in the database
                    if ($_POST['password'] === $password) {

                        $_SESSION['email'] = $email;
                        $_SESSION['name'] = $name;

                        // upon successful login, redirect user to landing apge
                        header("location: dashboard.php");
                    } else {
                        // Incorrect password
                        header("location: ../html/sign-in-error.html");
                    }
                } else {
                    // Incorrect username
                    header("location: ../html/sign-in-error.html");
                }
                $stmt->close();
            }
        } else {
            header("location: ../html/404-error.html");
            die();
        }
    } else {
        header("location: ../html/404-error.html");
        die();
    }
}
