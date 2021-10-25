<?php
include_once "inc/user-connection.php";

session_start();
$name = mysqli_real_escape_string($conn, $_POST['name']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$username = mysqli_real_escape_string($conn, $_POST['username']);

// sign up 
if (isset($_POST['sign-up'])) {
    if (!empty($email) and !empty($username)) {
        if (!empty($password)) {
            $check_email = "SELECT * FROM user WHERE email=?";
            $check_username = "SELECT * FROM user WHERE username=?";

            $stmt_email = $conn->prepare($check_email);
            $stmt_email->bind_param('s', $email);
            $stmt_email->execute();
            $stmt_email->store_result();

            $stmt_username = $conn->prepare($check_username);
            $stmt_username->bind_param('s', $username);
            $stmt_username->execute();
            $stmt_username->store_result();

            // if email is taken
            if ($stmt_email->num_rows() > 0 or $stmt_username->num_rows() > 0) {
                header("location: ../html/sign-up-error.html");
            }
            // if  email isn't taken, insert into database
            else {
                $sql = "INSERT INTO user (name,email,password,username) values (?,?,?,?)";

                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param('ssss', $name, $email, $password, $username);
                    $stmt->execute();
                    $stmt->store_result();
                    header("location: ../html/sign-in.html");
                    die();
                }
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $name;
            }
            $stmt->close();
            $conn->close();
        }
    }
}
// sign in
if (isset($_POST['sign-in'])) {
    if (!empty($email) and !empty($password)) {
        $sql = 'SELECT email, password FROM user WHERE email = ?';

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
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    // upon successful login, redirect user to landing apge
                    header("location: ../customer/search.html");
                    die();
                } else {
                    // Incorrect password
                    header("location: ../html/sign-in-error.html");
                    die();
                }
            } else {
                // Incorrect username
                header("location: ../html/sign-in-error.html");
                die();
            }
            $stmt->close();
        }
    }
}

if (isset($_POST['admin-sign-in'])) {
    if (!empty($email) and !empty($password)) {


        $sql = 'SELECT email, password, name FROM admin WHERE email = ?';

        // preparing the SQL statement
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('s', $_POST['email']);
            $stmt->execute();
            $stmt->store_result(); // Store the result so we can check if the account exists in the database.

            // If email exists in sign_up table
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($email, $password, $name);
                $stmt->fetch();

                // if password user enters matches the one in the database
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    // upon successful login, redirect user to landing apge
                    header("location: ../dashboard/dashboard.php");
                    die();
                } else {
                    // Incorrect password
                    header("location: ../html/sign-in-error.html");
                    die();
                }
            } else {
                // Incorrect email
                header("location: ../html/sign-in-error.html");
                die();
            }
            $stmt->close();
        }
    }
}
