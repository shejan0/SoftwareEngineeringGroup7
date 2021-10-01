<?php
$name = filter_input(INPUT_POST, 'name');
$password = filter_input(INPUT_POST, 'user_password');
$email = filter_input(INPUT_POST, 'user_email');

if (!empty($email)) {
    if (!empty($password)) {
        $host = "swe-project-db.ckec3iue5fvo.us-east-2.rds.amazonaws.com";
        $dbusername = "admin";
        $dbpassword = "softwareengineering";
        $dbname = "user";

        // Create connection
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        // insert into tables
        if (mysqli_connect_error())
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        else {
            $sql = "INSERT INTO sign_up (name,email,password) values ('$name','$email','$password')";

            if ($conn->query($sql))
                echo "New record is inserted sucessfully";
            else
                echo "Error: " . $sql . " " . $conn->error;

            $conn->close();
        }
    } else {
        echo "Password should not be empty";
        die();
    }
} else {
    echo "Username should not be empty";
    die();
}
