<?php
// $db_host = $_ENV['DB_HOST'];
// $db_username = $_ENV['DB_USERNAME'];
// $db_password = $_ENV['DB_PASSWORD'];
// $db_name = $_ENV['DB_DATABASE'];

$conn = mysqli_connect("swe-project-db.ckec3iue5fvo.us-east-2.rds.amazonaws.com", "admin", "softwareengineering", "hotel");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
