<?php

global $conn;
session_start();    // join an existing session, if any, otherwise start a new session


/*
Algorithm for a sign on page

provide a form - username and password, self posting

if(validUser) {
    show Admin page
}
else {
    if(form has been submitted)
    {
        process the form
        validate input data
            if error
                displayForm
                validData = false      //bad data switch on
        if validated correctly
        if(validData)
            access database
            (SQL SELECT WHERE clause username/password)
        if you find the username/password in the database
                -you are valid user
                -display Admin Page.content
                -set SESSION variables to maintain the state-keep you signed on, have access to pages
    }
    else {
        display the form
    }
    //VIEW - HTML area

    if(validUser -signed on) {
        display the admin content
    }
    else {
        ERROR - INvalid username or password
        display login form
    }
        else {
            display the login form
        }
    } end validUser
*/

if(isset($_SESSION['validUser']) && $_SESSION['validUser'] == 'valid') {
    //show Admin page
    $displayForm = false;   //display form (true) or Admin page (false)
}
else {
    $inUsername = '';
    $inPassword = '';
    $usernameMsg = '';
    $passwordMsg = '';
    $signOnMsg = '';



    if(isset($_POST['submit'])) {
        //echo '<h1>Form has Been Submitted</h1>';
        $displayForm = false;

        $inUsername = $_POST['username'];
        $inPassword = $_POST['password'];

        //validate input values

        $validData = true;
        if($inUsername == '') {
            //display error message on the form
            $usernameMsg = 'Please enter a valid username';
            $passwordMsg = 'Please enter a valid password';

            $validData = false;
            //put the input values back into the form fields
            //display the form
        }

        if($validData) {
            //process the database
            //database work flow
        // 1. Connect to the database
        // 2. Create your SQL command
        // 3. Prepare your Statement PDO Prepared Statements
        // 4. Bind any parameters as needed 
        // 5. Execute your SQL command/prepared statement 
        // 6. Process your result-set/object
        require 'database/dbConnect.php';

        // $sql = 'SELECT event_user_name, event_user_password from wdv341_event_users WHERE event_user_name = :userName';
        $sql = 'SELECT COUNT(*) FROM wdv341_event_users WHERE event_user_name = :userName AND event_user_password = :passWord';

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':userName', $inUsername);
        $stmt->bindParam(':passWord', $inPassword);

        $stmt->execute();

        //How do I know whether or not I found a matching username/password in the database?
        $numberOfRows = $stmt->fetchColumn();   //get the number of rows from the result
        //echo '<h1>' . $numberOfRows . '</h1>';
        if($numberOfRows > 0) {
            //found a valid username/password - continue processing this as a valid user
            //display the Admin page
            $displayForm = false;   //do not display the form - display ADMIN page
        }
        else {
            //invalid username/password
            //display error message
            $inUsername = '';
            $inPassword = '';
            $signOnMsg = 'Invalid username or password. Please try again';
            //display the form
            $displayForm = true;    //invalid username/password - show the form to the user
        }


        }
        else {
            //display the form
            $displayForm = true;    //set out displayForm flag/switch to true
        }
    }
    else {
        //echo '<h1>Display Login Form</h1>';
        $displayForm = true;
    }

} // end the validUser of statement
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignOn</title>
</head>
<body>
    <h1>Login to the Session Example Project</h1>
    <?php
        if($displayForm) {
            // the user has signed ON and should display the Admin System
            //echo '<h2>Display form</h2>';
    ?>
            <div style='color: red'>
                <?php echo $signOnMsg;?>
            </div>

                    <form action="signOn.php" method="post">
                        <p>
                            <label for="username">Username:</label>
                            <input type="text" name="username" id="username" value="<?php echo $inUsername;?>">
                            <span><?php echo $usernameMsg;?></span>
                        </p>

                        <p>
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" value="<?php echo $inPassword;?>">
                            <span><?php echo $passwordMsg;?></span>
                        </p>

                        <p>
                            <input type="submit" name="submit" id="submit" value="Submit">
                            <input type="reset" name="reset" id="reset">
                        </p>
                    </form>
      



    <?php
        }
        else {
            //the user needs to display the form - to sign on OR fix their input
            $_SESSION['validUser'] = 'valid';   // check this on all Admin pages
    ?>

        <h2>display Event ADMIN System</h2>
            <ol>Admin Functions
                <li><a href="inputEvent.php">Add Event</a></li>
                <li><a href="showEvents.php">Show All Events - Update/Delete Event</a></li>
                <li><a href="database/logout.php">Sign Out</a></li>
            </ol>
    <?php
           // echo $_SESSION['validUser'];
        } // close else branch of the ADMIN display area
    ?>
    
</body>
</html>