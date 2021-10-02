<?php
// get the input the user entered
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
                        echo "<script> window.location.assign('../index.html'); </script>";
                    } else {
                        // Incorrect password
                        echo 'Incorrect email and/or password!';
                    }
                } else {
                    // Incorrect username
                    echo 'Incorrect email and/or password!';
                }
                $stmt->close();
            }
        }
    } else {
        echo "Password should not be empty";
        die();
    }
} else {
    echo "email should not be empty";
    die();
}
