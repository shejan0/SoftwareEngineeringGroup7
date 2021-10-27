<?php
include_once "php/head.php";
include_once "php/header.php";
include_once "../php/inc/user-connection.php";

if(!isset($_SESSION['email']))
{
    header("Location: ../html/sign-in.html");
}

$sql = 'SELECT email,password,name FROM user WHERE email = ?';
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('s', $_SESSION['email']);
    $stmt->execute();
    $stmt->store_result(); // Store the result so we can check if the account exists in the database.
}
if ($stmt->num_rows > 0) {
    $stmt->bind_result($email, $password,$name);
    $stmt->fetch();
}

echo "<h2>EMAIL $email</h2>";
echo "<h2>PASSWORD $password</h2>";
echo "<h2>NAME $name</h2>";