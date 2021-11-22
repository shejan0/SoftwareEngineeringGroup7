<?php
function FindifFull($conn,$reservationID, $hotelID, $roomType, $numRooms, $arrival, $departure)
{
    if($reservationID!= NULL)
    {
        $result=$conn->query("SELECT numRoom FROM reservation WHERE ReservationID = $reservationID");
        $assoc = $result->fetch_assoc();
        $curResRooms = $assoc['numRoom'];
    }
    $curResRooms = 0;
    $day = "1000-01-01";
    $begin = new DateTime(strval( $arrival ));
    $end2   = new DateTime(strval( $departure ));
    $result=$conn->query("SELECT numStandard,numKing,numQueen FROM hotel WHERE hotelID = $hotelID");
    $assoc = $result->fetch_assoc();
    if($roomType == "Standard"){
        $totalRoom = $assoc['numStandard'];
    }else if($roomType == "Queen"){
        $totalRoom = $assoc['numQueen'];
    }else if($roomType == "King"){
        $totalRoom = $assoc['numKing'];
    }else{
        $totalRoom = NULL;
    }
    //Loop through days and identify number of weekend days and week days
    $stmt_obj=$conn->stmt_init();
   // print_r($stmt_obj);
    if(!$stmt_obj){
        echo $conn->error;
    }
    if(!($stmt_obj->prepare("SELECT numRoom FROM reservation WHERE hotelID = ? AND roomType = ? AND arrivalDate <= ? AND departureDate >= ?;")&&
    $stmt_obj->bind_param("isss",$hotelID, $roomType, $day, $day)&&
    $stmt_obj->bind_result($recordNum))){
        print_r($stmt_obj->error);
    }
    for($i = $begin; $i <= $end2; $i->modify('+1 day'))
    {
        $roomTotal = 0;
        $day = $i->format("Y-m-d");
        $stmt_obj->execute();
        while($stmt_obj->fetch())
        {
            $roomTotal += $recordNum;
            
        }
        if($totalRoom - $roomTotal - $numRooms + $curResRooms < 0){
            return true;
        }
    }
    return false;
}

?>