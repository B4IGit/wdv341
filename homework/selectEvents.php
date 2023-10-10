<?php

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
    require 'dbConnect.php';        //copies the content of the dbConnect.php INTO this page

    //2. Create your SQL command
    $sql = "SELECT  events_name, events_description, events_presenter, events_date, events_time, events_date_inserted, events_date_updated FROM wdv341_events";

    //3. Prepare your statement PDO Prepared statement
    $stmt = $conn->prepare($sql);       //  -> is used instead of  (period ( . )) for object ->property or object

    // (this is wrong) $stmt = $conn.prepare($sql);        //concatenating $conn with the prepare

    //4. Bind any parameters as needed

    //5. Execute your SQL command/prepared statement
    $stmt->execute();       //runs the prepared statement, stores the results within the statement object

    //6. Process the results-set/object
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    /*
    $row = $stmt->fetch();
    echo $row["events_name"];

    $row = $stmt->fetch();
    echo $row["events_name"];

    $row = $stmt->fetch();
    echo $row["events_name"];
    */

    /*
    while($row = $stmt->fetch() ) {
        echo "<h3>";
        echo $row["events_name"];
        echo "</h3>";
        echo "<p>";
        echo $row["events_description"];
        echo "</p>";
    }
    */







?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        * {
            box-sizing: border-box;
        }

        table {
            padding: 2em;
            border: none
        }
        
        td {
            border: 3px solid white;
            border-radius: 10px;
        }

        #padding {
            padding: .5em;
            border-bottom: .05em solid black;
        }

        .red {
            background-color: red;
            color: white;
        }

        .orange {
            background-color: orange;
        }

        .yellow {
            background-color: yellow;
        }

        .green {
            background-color: green;
            color: white;
        }

        .blue {
            background-color: blue;
            color: white;
        }

        .purple {
            background-color: purple;
            color: white;
        }

        .pink {
            background-color: pink;
        }
    </style>
</head>
<body>
    <h1>WDV341 Intro to PHP</h1>
    <h2>Unit-7 Select data from events table</h2>
    <h3>Event Names</h3>
    <?php

        echo "<table border='1'>

<tr>
<th class='red';>Name</th>
<th class='orange'>Description</th>
<th class='yellow'>Presenter</th>
<th class='green'>Date</th>
<th class='blue'>Time</th>
<th class='purple'>Date Inserted</th>
<th class='pink'>Date Updated</th>
</tr>";

while($row = $stmt->fetch()) {
    echo "<tr>";

  echo "<td id='padding';>". $row['events_name'] . "</td>";

  echo "<td id='padding';>" . $row['events_description'] . "</td>";

  echo "<td id='padding';>" . $row['events_presenter'] . "</td>";

  echo "<td id='padding';>" . $row['events_date'] . "</td>";

  echo "<td id='padding';>" . $row['events_time'] . "</td>";

  echo "<td id='padding';>" . $row['events_date_inserted'] . "</td>";

  echo "<td id='padding';>" . $row['events_date_updated'] . "</td>";

  echo "</tr>";

  }

echo "</table>";

   
    ?>

    <p>In real life, I would not have changed the colors to this hideous display but was experimenting with styling.</p>
    
    
</body>
</html>