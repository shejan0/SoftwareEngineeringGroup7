<?php
$config = parse_ini_file('/var/www/database/hotel_db.ini');
print_r($config);
//$host = getenv('DB_HOST');
$host = $config['DB_HOST'];
//$username = getenv('DB_USERNAME');
$username = $config['DB_USERNAME'];
//$password = getenv('DB_PASSWORD');
$password = $config['DB_PASSWORD'];
//$database_name = getenv('DB_DATABASE');
$database_name = $config['DB_DATABASE'];
echo($host);
echo($username);
echo($password);
echo($database_name);
$conn = mysqli_connect($config['DB_HOST'],$config['DB_USERNAME'],$config['DB_PASSWORD'],$config['DB_DATABASE']);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
