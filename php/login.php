<?php
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
if (!empty($email)) {
    if (!empty($password)) {
        $host = "swe-project-db.ckec3iue5fvo.us-east-2.rds.amazonaws.com";
        $dbusername = "admin";
        $dbpassword = "softwareengineering";
        $dbname = "user";

        // Create connection
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
        if (mysqli_connect_error())
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        else {
            if (!isset($_POST['email'], $_POST['password'])) {
                // Could not get the data that should have been sent.
                exit('Please fill both the username and password fields!');
            }
             // Now we check if the data from the login form was submitted, isset() will check if the data exists.
    if (!isset($_POST['email'], $_POST['password'])) {
        // Could not get the data that should have been sent.
        exit('Please fill both the username and password fields!');
    }
    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    if ($stmt = $conn->prepare('SELECT email, password FROM sign_up WHERE email = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();
            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            if ($_POST['password'] === $password)  {
                // Verification success! User has logged-in!
                // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                echo 'Welcome !';
                echo "<script> window.location.assign('../html/home.html'); </script>";
            } else {
                // Incorrect password
                echo 'Incorrect username and/or password!';
            }
        } else {
            // Incorrect username
            echo 'Incorrect username and/or password!';
        }


        $stmt->close();
    }
        }
    } else {
        echo "Password should not be empty";
        die();
    }
} else {
    echo "Username should not be empty";
    die();
}
