<?php
$name = filter_input(INPUT_POST, 'name');
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'user_password');
$email = filter_input(INPUT_POST, 'user_email');
$usertype = filter_input(INPUT_POST, 'usertype');
$hoteltype = filter_input(INPUT_POST, 'hoteltype');

if (!empty($username)) {
    if (!empty($password)) {
        $host = "swe-project-db.ckec3iue5fvo.us-east-2.rds.amazonaws.com";
        $dbusername = "admin";
        $dbpassword = "softwareengineering";
        $dbname = "user-info";

        // Create connection
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        // insert into tables
        if (mysqli_connect_error())
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        else {
            $sql = "INSERT INTO 
            signup (name,email,password,username,user_type,hotel_type) values ('$name','$email','$password','$username','$usertype','$hoteltype')";

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
