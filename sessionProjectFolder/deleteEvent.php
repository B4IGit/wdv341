<?php

session_start();    //join on existing session, if any, otherwise start a new session
// us a session variable to restrict this page to only a valid user - must sign on to see the page
if($_SESSION['validUser'] =='valid') {
    //true branch - valid user, let them see the page
}
else {
    //false branch - INVALID user, return them to the Login page or home page
    header('Location: signOn.php');
}

    $eventID = $_GET['eventID'];        // must match the index.name from showEvents
    //echo "<h1>$eventID</h1>";  confirming expectations 
    /*
Delete Algorithm - a set of steps/tasks to accomplish a task/mission/function

know what to delete? - get of list from the db and display it
should be able to  'choose' / 'select' an item to be deleted
delete the selected item
 */

      //1. Connect to the database
      require 'database/dbConnect.php';        //copies the content of the dbConnect.php INTO this page

      //2. Create your SQL command
      $sql = 'DELETE FROM wdv341_events WHERE events_id = :eventID';
  
      //3. Prepare your statement PDO Prepared statement
      $stmt = $conn->prepare($sql);       //  -> is used instead of  (period ( . )) for object ->property or object
  
      // (this is wrong) $stmt = $conn.prepare($sql);        //concatenating $conn with the prepare
  
      //4. Bind any parameters as needed
      $stmt->bindParam(':eventID', $eventID);
  
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
    <title>Delete Events</title>
</head>
<body>
    <h1>Events System</h1>
    <h2>Event Delete</h2>
    <p>Your event has been deleted.<a href="signOn.php">Return to Admin Page</a></p>
    
</body>
</html>