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
    $sql = 'SELECT * FROM trendyflorals_products';

    //3. Prepare your Statement PDO Prepared Statements
    $stmt = $conn->prepare($sql);

    //4. Bind any parameter as needed

    //5. Execute your SQL command/prepare statement
    $stmt->execute(); //runs the prapared statement

    //6. Process the results - set/object
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lists Products</title>
    <link rel="stylesheet" href="../sassFiles/styleLogin.scss">
    <link rel="stylesheet" href="../sassFiles/styleLogin.css">

    <style>

        main, .style {
            display: flex;
            margin: 4rem 0 0 0;
            padding: 0;

        }
        .products-container {

            height: auto;
            margin: 24px;
            background-color: #ece8f8;
            border-radius: 16px;
            border: 1.5px solid #484c9b;
        }

        section, .products-container {
            display: block;
            margin: 0 auto;
            padding: 32px;
            box-shadow: 1px 2px 32px #484c9b;
        }
        section div {
            border: 1px solid black;
        }
        .products-container div {
            margin: 0 auto;
            width: 1400px;
            padding: 8px;
            margin: 16px 0;
            color: #000;

        }

        .container-body {
            display: flex;
            flex-direction: row;
            justify-content: center;
            border-radius: 16px;

        }

        footer {
            margin-top: 4rem;
        }

        @media (max-width: 1024px) {
            main {
                grid-template-columns: 1fr;
            }

            .container-body {

            }
        }
    </style>
</head>

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

        <main class="style">
            <section class="products-container">
                <?php
                while ($row = $stmt->fetch()) {
                        // Process each row of the result-set
                    echo '<div class="container-body">';
                    echo '<div>' . $row['product_name'] . '</div>';
                    echo '<div>' . $row['product_description'] . '</div>';
                    echo '<div>' . $row['product_price'] . '</div>';
                    echo '<div><img src="' . $row['product_image'] . '" alt="Product Image"></div>';
                    echo '<div>' . $row['product_inStock'] . '</div>';
                    echo '<div>' . $row['product_time_entered'] . '</div>';
                    echo '<div>' . $row['product_date_inserted'] . '</div>';
                    echo '<div>' . $row['product_date_updated'] . '</div>';
                    echo "\n";
                    echo'</div>';
                    //$eventID = $row['products_id'];
                    // this section allows admin to update or delete
                    //echo '<div><a href="updateProduct.php?productID=$eventID"><button id="update">Update</button></a></div>';
                    //echo '<div><a href="deleteProduct.php?productID=$eventID"><button id="delete">Delete</button></a></div>';
                    }
                ?>
            </section>
        </main>
            <footer>
                <div class="nested-grid">
                    <div class="footer-card">
                        <div class="navLogo">
                            <p>Trendy Florals</p>
                        </div>
                        <p>Where Flowers Trend</p>
                    </div>
                    <div class="footer-card">
                        <div class="subscribeEmail" id="subscribeEmail">
                            <input class="break" type="text" placeholder="Your e-mail">
                            <button class="emailBtn" id="emailBtn" type="button">Subscribe Now!</button>
                        </div>
                    </div>
                    <div class="footer-card">
                        <p>Follow Us</p>
                    </div>
                </div>
            </footer>

            <div class="copy-rights">
                <p>All Rights Reserved. WDV Final Project, &copy;
                    <?php echo date('Y');?>.
                </p>
            </div>
</div>

</body>

</html>
