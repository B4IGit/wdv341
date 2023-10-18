<?php
require 'dbConnect.php';

$sql = "SELECT events_name, events_description, events_presenter, events_date, events_time, events_date_inserted, events_date_updated FROM wdv341_events WHERE events_id = :eventID";

$stmt = $conn->prepare($sql);

$eventID = 2;
$stmt->bindParam(':eventID' , $eventID);

$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);

try {
    testID (2);
} catch (Exception $e) {
    echo "Oh no!" . $e->getMessage();
}

function testID($number) {
    if ($number != 2) {
        throw new Exception(" No records matching.");
        return true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7-2: Create selectOneEvent</title>

    <style>
        * {
            box-sizing: border-box;
        }

        table {
            padding: 2em;
        }
        
        td {
            border: 3px solid white;
            border-radius: 10px;
            height: 100%;
        }

        tr {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: .5em;
            border: 1px solid black;
        }
        
        #eventDescription {
            background-color: lightblue;
            padding: .25em 2em;
        }

        #padding {
            padding: .5em;
        }
        </style>
</head>
<body>
    <?php

echo "<table border='1'>

<tr>
<th id='eventDescription':>Event Description</th>
</tr>";

while($row = $stmt->fetch()) {
    echo "<tr>";
    echo "<td id='padding'; style='background-color: lightgrey';>". $row['events_name'] . "</td>";

    echo "<td id='padding';>" . $row['events_description'] . "</td>";
  
    echo "<td id='padding'; style='background-color: lightgrey';>" . $row['events_presenter'] . "</td>";
  
    echo "<td id='padding';>" . $row['events_date'] . "</td>";
  
    echo "<td id='padding'; style='background-color: lightgrey';>" . $row['events_time'] . "</td>";
  
    echo "<td id='padding';>" . $row['events_date_inserted'] . "</td>";
  
    echo "<td id='padding'; style='background-color: lightgrey';>" . $row['events_date_updated'] . "</td>";
    echo "</tr>";
}

echo "</table>";
  
?>
    
</body>
</html>
