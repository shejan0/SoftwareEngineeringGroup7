<?php
include_once "php/head.php";
include_once "php/header.php";

if(!isset($_SESSION['email']))
{
    header("Location: ../html/sign-in.html");
}

?>
<h1>Welcome</h1>
<?php

if (isset($_SESSION['email'])) {
    echo $_SESSION['name'];
}else{
    echo "You are Not logged in";
}

?>