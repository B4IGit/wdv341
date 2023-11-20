<?php
        // this file is a self posting form that will get the Event data
        // and INSERT the data into the wdv341_events table of our database


    $confirmMessage = false;        //  make this variable to the whole page
    $eventNameMsg = '';             //define a global variable with no content
    $eventDescMsg = '';
    $eventPresenterMsg = '';
    $eventDateMsg = '';
    $eventTimeMsg = '';

    $inEventName = ''; 
    $inEventTitle = '';
    $inEventDescription = '';
    $inEventPresenter = '';
    $inEventDate = '';
    $inEventTime = '';

    if(isset($_POST['submit'])) {
        //process form data into the database
        //echo '<h3>PPROCESS the form. It has been submitted.';     testing purposes

        //process form data into PHP variables
        $inEventName = $_POST['events_name']; //get the data from the form fields
        $inEventTitle = $_POST['events_title'];
        $inEventDescription = $_POST['events_description'];
        $inEventPresenter = $_POST['events_presenter'];
        $inEventDate = $_POST['events_date'];
        $inEventTime = $_POST['events_time'];


        // beginning of HONEY POT
        if(empty($inEventTitle)) {
            // is a real person
        


        function validateEventName($inName) {
            if($inName == '') {
                    //invalid
                    global $validInput, $eventNameMsg;
                    $validInput = false;
                    $eventNameMsg = 'Enter Event Name';
            }
        }

        function validateEventDesc($inDesc) {
            if($inDesc == '') {
                //invalid
                global $validInput, $eventDescMsg;
                $validInput = false;
                $eventDescMsg = 'Enter Description for Event';
        }
    }

        function validateEventPresenter($inPresenter) {
            if($inPresenter == '') {
                //invalid
                global $validInput, $eventPresenterMsg;
                $validInput = false;
                $eventPresenterMsg = 'Enter Presenters name';
        }
    }

        function validateEventDate($inDate) {
            if($inDate == '') {
                //invalid
                global $validInput, $eventDateMsg;
                $validInput = false;
                $eventDateMsg = 'Select Date of event';
        }
    }

        function validateEventTime($inTime) {
            if($inTime == '') {
                //invalid
                global $validInput, $eventTimeMsg;
                $validInput = false;
                $eventTimeMsg = 'Select Time of event';
        }
    }


        //validate input data
        /*
        assume all the input data is valid - $validInput = true
        validate input data - field by field
        validation function
                if input data invalid
                $validInput = false
                display error message - who fixes the data? 
        validation function...

        if($validInput) {
                all input is good
                process the data into the database
        }
                
        else{
                sends this back to the user/customer to fix - shoe form to customer
                they will resubmit the form
        }
        */

        $validInput = true;
        validateEventName($inEventName);
        validateEventDesc($inEventDescription);
        validateEventPresenter($inEventPresenter);
        validateEventDate($inEventDate);
        validateEventTime($inEventTime);
        if($validInput) {
                //process into data
      

                /*
                TDD - Test Driven Development
                write tests first, then code

                input           expected output
                 */

        //create our SQL command and insert into database
        //update the database

        require '../database/dbConnect.php';

        //build mySQL command

        $sql = 'INSERT INTO wdv341_events';
        $sql .= '(events_name, events_description, events_presenter, events_date, events_time, events_date_inserted, events_date_updated)';
        $sql .= 'VALUES';
        $sql .= '(:eventName, :eventDesc, :eventPresenter, :eventDate, :eventTime, :eventDateEntered, :eventDateUpdated)';

        //prepare statement
        $stmt = $conn->prepare($sql);

        //bind parameters
        $today = date('Y-m-d');
        $stmt->bindParam(':eventName', $inEventName);
        $stmt->bindParam(':eventDesc', $inEventDescription);
        $stmt->bindParam(':eventPresenter', $inEventPresenter);
        $stmt->bindParam(':eventDate', $inEventDate);
        $stmt->bindParam(':eventTime', $inEventTime);
        $stmt->bindParam(':eventDateEntered', $today);
        $stmt->bindParam(':eventDateUpdated', $today);
        
        //execute SQL command
        $stmt->execute();


        //close connection

        //execute the query


        //display confirmation message - display the HTML
        $confirmMessage = true; //this is set once all the data is in the database
        }
        else {
            //send form back to user
    }
    }
    // form has been submitted to user
}
    else {
        //	is a bot, DO NOT SEND
        // clears form
        
    }   //end of honey pot
            

?>

                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Single Page Form</title>

                        <style>
                            .confirmMessage {
                                width: 500px;
                                background-color: green;
                                margin-left: auto;
                                margin-right: auto;
                                text-align: center;
                            }

                            [for="events_title"] {
                            display: none;
                            }

                            [name="events_title"] {
                            display: none;
                            }

                            .errMsg {
                            color: red;
                            }
                        </style>
                    </head>
                    <body>
                                <h1>Insert New Event</h1>

<?php
    
    /*
    if we have updated the database
        display Message Block
    else
        display the form block
    */

    if($confirmMessage) {

    ?>

    <div class="confirmMessage">
        <h3>Thank you very much. We have input your information.</h3>
    </div>

    <?php
    }
        else {
    ?>
                    
                    
                    <form method="post" action="eventForm.php">
                            <p>
                                <label for="events_name">Event Name:</label>
                                <input type="text" name="events_name" id="events_name" value="<?php echo $inEventName;?>">
                                <span class="errMsg"><?php echo $eventNameMsg;?></span>
                            </p>

                            <p>
                                <label for="events_title">Event Title:</label>
                                <input type="text" name="events_title" id="events_title">
                            </p>

                            <p>
                                <label for="events_description">Event Description:</label>
                                <input type="text" name="events_description" id="events_description" value="<?php echo $inEventDescription;?>">
                                <span class="errMsg"><?php echo $eventDescMsg;?></span>
                            </p>

                            <p>
                                <label for="events_presenter">Event Presenter:</label>
                                <input type="text" name="events_presenter" id="events_presenter" value="<?php echo $inEventPresenter;?>">
                                <span class="errMsg"><?php echo $eventPresenterMsg;?></span>
                            </p>

                            <p>
                                <label for="events_date">Event Date:</label>
                                <input type="date" name="events_date" id="events_date" value="<?php echo $inEventDate;?>">
                                <span class="errMsg"><?php echo $eventDateMsg;?></span>
                            </p>

                            <p>
                                <label for="events_time">Event Time:</label>
                                <input type="time" name="events_time" id="events_time" value="<?php echo $inEventTime;?>">
                                <span class="errMsg"><?php echo $eventTimeMsg;?></span>
                            </p>

                            <p>
                                <input type="submit" name="submit" value="Submit">
                                <input type="reset" name="reset" value="Reset">
                            </p>
                    </form>

                    <?php
                        }
                    ?>

</body>
</html>