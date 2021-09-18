<?php
$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
$user_type = $_POST['user_type'];
$hotel_type = $_POST['hotel_type'];
$free_wifi = $_POST['free_wifi'];
$room_service = $_POST['room_service'];
$spa = $_POST['spa'];
$breakfast = $_POST['breakfast'];

if (
    !empty($user_name) || !empty($user_email) ||
    !empty($user_password) || !empty($user_type) || !empty($hotel_type) || !empty($free_wifi)
    || !empty($room_service) || !empty($spa) || !empty($breakfast)
) {
    # connect to database
    $host = "swe-project-db.ckec3iue5fvo.us-east-2.rds.amazonaws.com" ;
    $dbUsername = "admin";
    $dbPassword = "softwareengineering";
    $dbname = "software engineering";

    # create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()){
        die('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
    } else{
        $SELECT = "SELECT user_email From register Where user_email = ? Limit 1";
        $INSERT = "INSERT Into register (user_name, user_email, user_password, user_type, hotel_type free_wifi, room_service, spa, breakfast)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $stmt->bind_result($user_email);
        $stmt->store_result();
        $rnum = $stmt->num_rows();

        if ($rnum == 0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssssssss", $user_name, $user_email, $user_password, $user_type, $hotel_type, $free_wifi, $room_service, $spa, $breakfast);
            $stmt->execute();
            echo "New record inserted successfully";
        }
        else{
            echo "Someone already registred using this email";
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "All field are required";
    die();
}
