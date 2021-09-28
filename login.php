<?php
$username = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
if (!empty($username)) {
    if (!empty($password)) {
        $host = "swe-project-db.ckec3iue5fvo.us-east-2.rds.amazonaws.com";
        $dbusername = "admin";
        $dbpassword = "softwareengineering";
        $dbname = "sys";
        // Create connection
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        } else {
            $sql = "INSERT INTO login (username, password)
values ('$username','$password')";
            if ($conn->query($sql)) {
                echo "New record is inserted sucessfully";
            } else {
                echo "Error: " . $sql . "
" . $conn->error;
            }
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
