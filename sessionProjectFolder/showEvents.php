<?php

session_start();
     //database work flow
    // 1. Connect to the database
    // 2. Create your SQL command
    // 3. Prepare your Statement PDO Prepared Statements
    // 4. Bind any parameters as needed 
    // 5. Execute your SQL command/prepared statement 
    // 6. Process your result-set/object

    //include  on external  PHP file into this file
    //include
    //require

    //1. Connect to the database
    require 'database/dbConnect.php';        //copies the content of the dbConnect.php INTO this page

    //2. Create your SQL command
    $sql = "SELECT  events_id, events_name, events_description, events_presenter, events_date, events_time, events_date_inserted, events_date_updated FROM wdv341_events";

    //3. Prepare your statement PDO Prepared statement
    $stmt = $conn->prepare($sql);       //  -> is used instead of  (period ( . )) for object ->property or object

    // (this is wrong) $stmt = $conn.prepare($sql);        //concatenating $conn with the prepare

    //4. Bind any parameters as needed

    //5. Execute your SQL command/prepared statement
    $stmt->execute();       //runs the prepared statement, stores the results within the statement object

    //6. Process the results-set/object
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Example</title>
    <style>
        .flexContainer {
            display: flex;
        }

        .flexContainer div {
            width: 200px;
            border: 1px solid black;
            padding: 8px;
        }

        div button {
            border-radius: 8px;
        }

        #update:hover {
            color: white;
            background-color: green;
        }

        #delete:hover {
            color: white;
            background-color: red;
        }
    </style>
</head>
<body>
    <h1>Events System</h1>
    <h2>Delete Events</h2>  
    <p>Display a list of events</p> 
        <section>
            <?php
                while($row = $stmt->fetch()) {
                    echo "<div class='flexContainer'>";
                    echo "<div>" . $row['events_name'] . "</div>";
                    echo "<div>" . $row['events_description'] . "</div>";
                    echo "<div>" . $row['events_presenter'] . "</div>";
                    echo "<div>" . $row['events_date'] . "</div>";
                    echo "<div>" . $row['events_time'] . "</div>";
                    echo "<div>" . $row['events_date_inserted'] . "</div>";
                    echo "<div>" . $row['events_date_updated'] . "</div>";
                    $eventID = $row['events_id'];
                      // added to allow for UPDATE selection
                      echo "<div><a href='updateEvent.php?eventID=$eventID'><button id='update'>Update</button></a></div>";
                    echo "<div><a href='deleteEvent.php?eventID=$eventID'><button id='delete'>Delete</button></a></div>";
                     echo "\n";
                    echo "</div>";  //closes flexContainer

                }
            ?>
        </section>

        <!--        sample layout for PHP formatting
        <section>
            <div class="flexContainer">
                <div>Event Name</div>
                <div>Event Description</div>
            </div>
            <div class="flexContainer">
                <div>Event Name</div>
                <div>Event Description</div>
            </div>
        </section>
            -->
    
</body>
</html>