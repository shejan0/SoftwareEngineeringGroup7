<?php
include_once "inc/user-connection.php";
?>
<html>
<body>
    <h1>Hotel listings</h1>
    <?php
    $sql = 'SELECT * from hotel';
    $result = $conn->query($sql);
    $rows = $result->num_rows;
    $columns = $result->field_count;
    $i = 0;
    echo "<h2>Rows: $rows</h2>";
    echo "<h2>Columns: $columns</h2>";
    echo "<table>";
    echo "<tr> <td>hotelID</td><td>hotelName</td><td># of Rooms</td><td>weekend Surge rate</td><td>AVAILABLE</td></tr>";
    while($row = $result->fetch_assoc()){
        $hotelId=$row['hotelID'];
        $hotelName=$row['hotelName'];
        $numrooms=$row['number_of_rooms'];
        $standard=$row['Standard'];
        $queen=$row['Queen'];
        $king=$row['King'];
        $surge=$row['weekendSurge'];
        echo "<tr>";
        echo "<td>$hotelId</td>";
        echo "<td>$hotelName</td>";
        echo "<td>$numrooms</td>";
        echo "<td><ul>";
        echo "<li>Standard: $standard</li>";
        echo "<li>Queen: $queen</li>";
        echo "<li>King: $king</li>";
        echo "</ul></td>";
        echo "<td>$surge</td>";
        if($king>0 || $queen >0 || $standard >0){
            echo "<td>YES</td>";
        }else{
            echo "<td>NO</td>";
        }
        echo "</tr>";
    }
    echo "</table>"
    ?>
