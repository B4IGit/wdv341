<?php
session_start();    //join on existing session, if any, otherwise start a new session
// us a session variable to restrict this page to only a valid user - must sign on to see the page
if(isset($_SESSION['validUser']) && $_SESSION['validUser'] == 'valid') {
    //true branch - valid user, let them see the page
}
else {
    //false branch - INVALID user, return them to the Login page or home page
    header('Location: login.php');
}
// this file is a self posting form that will get the Event data
// and INSERT the data into the wdv341_events table of our database


// allows variables to access the whole page
//  defines the global variable with no content
$confirmMessage = false;
$productNameMsg = '';
$productDescMsg = '';
$productPriceMsg = '';
$productImgMsg = '';
$productStockMsg = '';
$productTimeEnteredMsg = '';
$productDateInsertedMsg = '';
$ProductDateUpdatedMsg = '';

$inProductName = '';
//$inEventTitle = ''; honey pot must add
$inProductDesc = '';
$inProductPrice = '';
$inProductImg = '';
$inProductStock = '';
$inProductTimeEntered = '';


if(isset($_POST['submit'])) {
    //process form data into the database
    //echo '<h3>PPROCESS the form. It has been submitted.';     //testing purposes

    //process form data into PHP variables


    //get the data from the form feilds
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

            $sql = 'INSERT INTO trendyflorals_products';
            $sql .= '(product_name, product_description, product_price, product_image, product_inStock, product_time_entered, product_date_inserted, product_date_updated)';
            $sql .= 'VALUES';
            $sql .= '(:productName, :productDesc, :productPrice, :productImg, :productStock, :productTimeEntered, :productDateInserted, :productDateUpdated)';

            //prepare statement
            $stmt = $conn->prepare($sql);

            //bind parameters
            $today = date('Y-m-d');
            $stmt->bindParam(':productName', $inProductName);
            $stmt->bindParam(':productDesc', $inProductDesc);
            $stmt->bindParam(':productPrice', $inProductPrice);
            $stmt->bindParam(':productImg', $inProductImg);
            $stmt->bindParam(':productStock', $inProductStock);
            $stmt->bindParam(':productTimeEntered', $inProductTimeEntered);
            $stmt->bindParam(':productDateInserted', $today);
            $stmt->bindParam(':productDateUpdated', $today);

            //execute SQL command
            $stmt->execute();


//display confirmation message - display the HTML
            $confirmMessage = true; //this is set once all the data is in the database
        } else {

        }

if ($confirmMessage) {


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
    <link rel="stylesheet" href="finalProject/sassFiles/styleLogin.css">
    <link rel="stylesheet" href="finalProject/sassFiles/styleLogin.scss">

    <style>
        .confirmMessage {
            width: 500px;
            background-color: mediumpurple;
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
<?php

//display confirmation message - display the HTML
$confirmMessage = true; //this is set once all the data is in the database
}
else {
    //send form back to user
}

if($confirmMessage) {

    ?>

    <div class="confirmMessage">
        <h3>Your Product(s) have been successfully added.</h3>
        <p><a href="login.php">Please return to the Admin Page.</a></p>
    </div>

    <?php
}
else {
?>
<body>
<div class="grid-login-page-container">
    <nav>
        <nav class="grid-nav-container">
            <div class="navBar" id="navBar">
                <div class="navLogo">
                    <p>trendy florals</p>
                </div>
                <div class="navLinks" id="navLinks">
                    <a href="/wdv341/finalProject/index.php">Home</a>
                    <a href="#about">About</a>
                    <a href="#shop">Contact</a>
                    <a href="#checkout">Checkout</a>
                    <a href="/wdv341/finalProject/sessionFolder/login.php">Login</a>
                </div>
            </div>
        </nav>

    <h1>Insert New Product</h1>
    <form method="post" action="inputProduct.php">
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