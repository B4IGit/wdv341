<?php

session_start();    //join on existing session, if any, otherwise start a new session
// us a session variable to restrict this page to only a valid user - must sign on to see the page
if($_SESSION['validUser'] =='valid') {
    //true branch - valid user, let them see the page
}
else {
    //false branch - INVALID user, return them to the Login page or home page
    header('Location: login.php');
}

if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];

}
// this file is a self posting form that will UPDATE a record in the database

require 'database/dbConnect.php';

$sql = 'SELECT * FROM trendyflorals_products WHERE product_id = :productID';

$stmt = $conn->prepare($sql);

$stmt->bindParam(':productID', $productID);

$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$recordData = $stmt->fetch();   //associative array name=value  column name-value in that column

//process results?? display the SELECT values for each field on the form


/*
Algorithm
    choose which record to UPDATE - showEvents passed eventID to this page
    do a SELECT for the eventID to get the data for the UPDATE
    place the data into the form (show the user what they entered)
    display the filled out form to the user - validate the form fields
    if validData
        UPDATE record in database
    else
        show error messages
        display the form back to the user */


$confirmMessage = false;
$productNameMsg = '';
$productDescMsg = '';
$productPriceMsg = '';
$productImgMsg = '';
$productStockMsg = '';
$productTimeEnteredMsg = '';
$productDateInsertedMsg = '';
$ProductDateUpdatedMsg = '';

$inProductName = isset($recordData['product_name']) ? $recordData['product_name'] : '';
//$inEventTitle = ''; // honey pot must add note
$inProductDesc = isset($recordData['product_description']) ? $recordData['product_description'] : '';
$inProductPrice = isset($recordData['product_price']) ? $recordData['product_price'] : 0; //assuming this is a numeric field, hence assigning 0
$inProductImg = isset($recordData['product_image']) ? $recordData['product_image'] : '';
$inProductStock = isset($recordData['product_inStock']) ? $recordData['product_inStock'] : 0; // assuming it's numeric
$inProductTimeEntered = isset($recordData['product_time_entered']) ? $recordData['product_time_entered'] : '0000-00-00 00:00:00'; // assuming it's a datetime field


if(isset($_POST['submit'])) {
    //process form data into the database
    //echo '<h3>PPROCESS the form. It has been submitted.';     //testing purposes

    //process form data into PHP variables


    // validation functions here
    $inProductName = $_POST['product_name'];
    //add honey pot field here
    $inProductDesc = $_POST['product_description'];
    $inProductPrice = $_POST['product_price'];
    $inProductImg = $_POST['product_image'];
    $inProductStock = $_POST['product_inStock'];
    $inProductTimeEntered = $_POST['product_time_entered'];





        function validateProductName($inName) {
            if($inName == '') {
                //invalid
                global $validInput, $productNameMsg;
                $validInput = false;
                $productNameMsg = 'Please enter Product Name';
            }
        }

        function validateProductDesc($inDesc) {
            if($inDesc == '') {
                //invalid
                global $validInput, $productDescMsg;
                $validInput = false;
                $productDescMsg = 'Please enter Product Description';
            }
        }

        function validateProductPrice($inPrice) {
            if($inPrice == '') {
                //invalid
                global $validInput, $productPriceMsg;
                $validInput = false;
                $productPriceMsg = 'Please enter Product Price';
            }
        }

        function validateProductImg($inImg) {
            if($inImg == '') {
                //invalid
                global $validInput, $productImgMsg;
                $validInput = false;
                $productImgMsg = 'Please enter a Product Image';
            }
        }

        function validateProductStock($inStock) {
            if($inStock == '') {
                //invalid
                global $validInput, $productStockMsg;
                $validInput = false;
                $productStockMsg = 'Please enter Product Quanity';
            }
        }

        function validateProductTime($inTime) {
            if($inTime == '') {
                //invalid
                global $validInput, $productTimeEnteredMsg;
                $validInput =false;
                $productTimeEnteredMsg = 'Please enter Product Time Entered';
            }
        }

        function validateProductDateInserted($dateInserted)
        {
            if ($dateInserted == '') {
                //invalid
                global $validInput, $productDateInsertedMsg;
                $validInput = false;
                $productDateInsertedMsg = 'Please enter Product Date Inserted';
            }
        }

        function validateProductDateUpdated($dateUpdated)
        {
            if ($dateUpdated == '') {
                //invalid
                global $validInput, $productDateUpdatedMsg;
                $validInput = false;
                $productDateUpdatedMsg = 'Please enter Product Date Updated';
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
        validateProductName($inProductName);
        validateProductDesc($inProductDesc);
        validateProductPrice($inProductPrice);
        validateProductImg($inProductImg);
        validateProductStock($inProductStock);
        validateProductTime($inProductTimeEntered);


        if($validInput) {
            //process into data
            /*
            TDD - Test Driven Development
            write tests first, then code

            input           expected output
             */

            //create our SQL command and insert into database
            //update the database

            if(file_exists('database/dbConnect.php')) {
                require 'database/dbConnect.php';
            } else {
                echo "The file 'database/dbConnect.php' does not exist.";
            }

            //build mySQL command


            $sql = 'UPDATE trendyflorals_products SET product_name = :productName,';
            $sql .= ' product_description = :productDesc,';
            $sql .= ' product_price = :productPrice,';
            $sql .= ' product_image = :productImg,';
            $sql .= ' product_inStock = :productStock,';
            $sql .= ' product_time_entered = :productTime,';
            $sql .= ' product_date_updated = :productDateUpdated';
            $sql .= ' WHERE product_id = :productID';

//prepare statement
            $stmt = $conn->prepare($sql);

//bind parameters
            $today = date('Y-m-d');
            $stmt->bindParam(':productName', $inProductName);
            $stmt->bindParam(':productDesc', $inProductDesc);
            $stmt->bindParam(':productPrice', $inProductPrice);
            $stmt->bindParam(':productImg', $inProductImg);
            $stmt->bindParam(':productStock', $inProductStock);
            $stmt->bindParam(':productTime', $inProductTimeEntered);
            $stmt->bindParam(':productDateUpdated', $today);
            $stmt->bindParam(':productID', $productID);

//execute SQL command
            $stmt->execute();



            //close connection

            //execute the query


            //display confirmation message - display the HTML
            $confirmMessage = true; //this is set once all the data is in the database
        }
        else {

        }
//    }
    // form has been submitted to user
}



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
<h1>Update Event</h1>

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
        <p><a href="listProducts.php">Return to Products page</a></p>
    </div>

    <?php
}
else {

    ?>


    <form method="post" action="updateProduct.php?productID=<?php echo $productID;?>">
        <p>
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" id="product_name" value="<?php echo $inProductName;?>">
            <span class="errMsg"><?php echo $productNameMsg;?></span>
        </p>


        <p>
            <label for="product_description">Product Description:</label>
            <input type="text" name="product_description" id="product_description" value="<?php echo $inProductDesc;?>">
            <span class="errMsg"><?php echo $productDescMsg;?></span>
        </p>

        <p>
            <label for="product_price">Product Price:</label>
            <input type="text" name="product_price" id="product_price" value="<?php echo $inProductPrice;?>">
            <span class="errMsg"><?php echo $productPriceMsg;?></span>
        </p>

        <p>
            <label for="product_image">Product Image:</label>
            <input type="file" name="product_image" id="product_image" value="<?php echo $inProductImg;?>">
            <span class="errMsg"><?php echo $productImgMsg;?></span>
        </p>

        <p>
            <label for="product_inStock">Product Stock:</label>
            <input type="text" name="product_inStock" id="product_inStock" value="<?php echo $inProductStock;?>">
            <span class="errMsg"><?php echo $productStockMsg;?></span>
        </p>

        <p>
            <label for="product_time_entered">Product Time Inserted:</label>
            <input type="time" name="product_time_entered" id="product_time_entered" value="<?php echo $inProductTimeEntered;?>">
            <span class="errMsg"><?php echo $productTimeEnteredMsg;?></span>
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