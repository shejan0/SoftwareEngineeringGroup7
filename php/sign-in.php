<?php
include_once "inc/user-connection.php";

// get the input the user entered, protect from sql injections
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
                    // upon successful login, redirect user to landing apge
                    header ("location: dashboard.php");
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
