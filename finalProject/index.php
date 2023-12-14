<?php

require 'sessionFolder/database/dbConnect.php';        //copies the content of the dbConnect.php INTO this page

//2. Create your SQL command
$sql = "SELECT * FROM trendyflorals_products LIMIT 10 OFFSET 0";
$stmt = $conn->prepare($sql);
$stmt->execute();
// fetch the first row from the result
$row_1_ProductsArray = $stmt->fetch(PDO::FETCH_ASSOC);
$row_2_ProductsArray = $stmt->fetch(PDO::FETCH_ASSOC);
$row_3_ProductsArray = $stmt->fetch(PDO::FETCH_ASSOC);
$row_4_ProductsArray = $stmt->fetch(PDO::FETCH_ASSOC);
$row_5_ProductsArray = $stmt->fetch(PDO::FETCH_ASSOC);
$row_6_ProductsArray = $stmt->fetch(PDO::FETCH_ASSOC);
$row_7_ProductsArray = $stmt->fetch(PDO::FETCH_ASSOC);
$row_8_ProductsArray = $stmt->fetch(PDO::FETCH_ASSOC);

$productsArray = $stmt->fetch();

//for testing purposes
//print_r($productsArray);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendy Florals</title>
    <link type="text/css" rel="stylesheet" href="./sassFiles/main.css">
    <link type="text/css" rel="stylesheet" href="./sassFiles/main.scss">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="grid-container" id="grid-container">
        <div class="grid-nav active" id="grid-nav">
            <div class="navLogo" id="navLogo">
                <p>TRENDY FLORALS</p>
            </div>
            <div class="navLinks" id="navLinks">
                <span class="styleLinks">
                    <a href="/wdv341/finalProject/index.php">Home</a>
                    <a href="#about">About Us</a>
                    <a href="contact.php">Contact</a>
                    <a href="#shop">Shop</a>
                    <a href="#checkout">Checkout</a>
                </span>
                <a href="/wdv341/finalProject/sessionFolder/login.php"><span class="login" id="login">Login</span></a>
            </div>
        </div>
        <div class="grid-banner" id="grid-banner">
            <div class="banner" id="banner">
                <div class="banner-bg" id="banner-bg">
                    <div class="banner-text" id="banner-text">
                        <h2>Welcome to Trendy Florals!</h2>
                        <h1>Tis the Season for Christmas</h1>
                        <div class="banner-btn" id="banner-btn">
                            <a href="#shop">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid-main" id="grid-main">
            <h1>christmas</h1>
            <div class="main-section" id="main-section">
                <div class="main-card" id="main-card">
                    <div class="img-card" id="img-card">
                        <img src="<?php echo 'productImages/' . $row_1_ProductsArray['product_image'];?>" alt="christmas">
                    </div>
                    <div class="card-overlay">
                        <h3><?php echo $row_1_ProductsArray['product_name'];?></h3>
                        <h4>$<?php echo $row_1_ProductsArray['product_price'];?></h4>
                    </div>
                </div>
                <div class="main-card" id="main-card">
                    <div class="img-card" id="img-card">
                        <img src="<?php echo 'productImages/' . $row_2_ProductsArray['product_image'];?>" alt="christmas">
                    </div>
                    <div class="card-overlay">
                        <h3><?php echo $row_2_ProductsArray['product_name'];?></h3>
                        <h4>$<?php echo $row_2_ProductsArray['product_price'];?></h4>
                    </div>
                </div>
                <div class="main-card" id="main-card">
                    <div class="img-card" id="img-card">
                        <img src="<?php echo 'productImages/' . $row_3_ProductsArray['product_image'];?>" alt="christmas">
                    </div>
                    <div class="card-overlay">
                        <h3><?php echo $row_3_ProductsArray['product_name'];?></h3>
                        <h4>$<?php echo $row_3_ProductsArray['product_price'];?></h4>
                    </div>
                </div>
                <div class="main-card" id="main-card">
                    <div class="img-card" id="img-card">
                        <img src="<?php echo 'productImages/' . $row_4_ProductsArray['product_image'];?>" alt="christmas">
                    </div>
                    <div class="card-overlay">
                        <h3><?php echo $row_4_ProductsArray['product_name'];?></h3>
                        <h4>$<?php echo $row_4_ProductsArray['product_price'];?></h4>
                    </div>
                </div>
            </div>
            <h1 class="space">Trendy Picks</h1>
            <div class="main-section" id="main-section">
                <div class="main-card" id="main-card">
                    <div class="img-card" id="img-card">
                        <img src="<?php echo 'productImages/' . $row_5_ProductsArray['product_image'];?>" alt="christmas">
                    </div>
                    <div class="card-overlay">
                        <h3><?php echo $row_5_ProductsArray['product_name'];?></h3>
                        <h4>$<?php echo $row_5_ProductsArray['product_price'];?></h4>
                    </div>
                </div>
                <div class="main-card" id="main-card">
                    <div class="img-card" id="img-card">
                        <img src="<?php echo 'productImages/' . $row_6_ProductsArray['product_image'];?>" alt="christmas">
                    </div>
                    <h3><?php echo $row_6_ProductsArray['product_name'];?></h3>
                    <h4>$<?php echo $row_6_ProductsArray['product_price'];?></h4>
                </div>
                <div class="main-card" id="main-card">
                    <div class="img-card" id="img-card">
                        <img src="<?php echo 'productImages/' . $row_7_ProductsArray['product_image'];?>" alt="christmas">
                    </div>
                    <h3><?php echo $row_7_ProductsArray['product_name'];?></h3>
                    <h4>$<?php echo $row_7_ProductsArray['product_price'];?></h4>
                </div>
                <div class="main-card" id="main-card">
                    <div class="img-card" id="img-card">
                        <img src="<?php echo 'productImages/' . $row_8_ProductsArray['product_image'];?>" alt="christmas">
                    </div>
                    <h3><?php echo $row_8_ProductsArray['product_name'];?></h3>
                    <h4>$<?php echo $row_8_ProductsArray['product_price'];?></h4>
                </div>
            </div>
        </div>
        <div class="grid-footer" id="grid-footer">
            <div class="footer-section" id="footer-section">
                <div class="footer-card" id="footer-card">
                    <span class="navLogo">TRENDY FLORALS</span>
                    <p>Where Flowers Trend</p>
                </div>
                <div class="footer-card" id="footer-card">
                    <div class="subscribeEmail" id="subscribeEmail">
                        <form method="post" action="">
                            <input type="email" name="subscriberEmail" id="subscribeEmail" placeholder="Your e-mail">
                            <button class="emailBtn" id="emailBtn" type="submit" name="submit">Subscribe Now!</button>
                        </form>
                    </div>

                    <?php
                    if(isset($_POST['submit'])) {
                        if(filter_var($_POST['subscriberEmail'], FILTER_VALIDATE_EMAIL)) {
                            // $subscriberEmail = $_POST['subscriberEmail'];
                            // Code to insert email in your subscribers' table.
                            echo "<script type='text/javascript'>alert('You have been successfully added to the subscriber list');</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Invalid email');</script>";
                        }

                    }
                    ?>
                </div>
                <div class="footer-card" id="footer-card">
                    <p>Follow Us</p>
                    <div class="social-icons">
                        <i class='bx bxl-facebook-circle'></i>
                        <i class='bx bxl-instagram-alt' ></i>
                        <i class='bx bxl-twitter'></i>
                    </div>
                </div>
                <div class="footer-copyRight" id="footer-copyRights">
                    <p>All Rights Reserved. WDV Final Project, &copy;<?php echo date('Y');?>.</p>
                </div>
            </div>
        </div>
    </div>




</body>

</html>