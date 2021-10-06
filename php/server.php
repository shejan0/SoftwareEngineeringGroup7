<?php
include_once "inc/user-connection.php";

session_start();

$name = mysqli_real_escape_string($conn, $_POST['name']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$username = mysqli_real_escape_string($conn, $_POST['username']);

$_SESSION['name'] = $row;
// sign up 
if (isset($_POST['sign-up'])) {
    if (!empty($email) and !empty($username)) {
        if (!empty($password)) {
            $check_email = "SELECT * FROM sign_up WHERE email ='$email'";
            $validate_email = mysqli_query($conn, $check_email);

            $check_username = "SELECT * FROM sign_up WHERE username ='$username'";
            $validate_username = mysqli_query($conn, $check_username);

            // if email is taken
            if (mysqli_num_rows($validate_email) > 0 or mysqli_num_rows($validate_username)) {
                header("location: ../html/sign-up-error.html");
            }
            // if  email isn't taken, insert into database
            else {
                $sql = "INSERT INTO sign_up (name,email,password,username) values ('$name','$email','$password','$username')";
                if ($conn->query($sql))
                    header("location: ../html/sign-in.html");
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
                        // upon successful login, redirect user to landing apge
                        header("location: ../customer-view//html/index.html");
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
                        // upon successful login, redirect user to landing apge
                        header("location: dashboard.php?name=" . $name);
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
