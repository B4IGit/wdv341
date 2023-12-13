<?php
global $conn;
session_start(); //joins an existing session, otherwise starts a new session

if (isset($_POST['username'])) { // check if this POST variable is set
    $welcomeUser = strtoupper($_POST['username']); // assign post value to a variable
    $_SESSION['welcomeUser'] = $welcomeUser; // store this variable in session
}

if(isset($_SESSION['validUser']) && $_SESSION['validUser'] == 'valid') {
    // show admin page
    $displayForm = false;   // if true, display form or false, show admin page
}
else {
    $inUsername = '';
    $inPassword = '';
    $usernameMsg = '';
    $passwordMsg = '';
    $loginMsg = '';

    if(isset($_POST['submit'])) {
        //echo '<h1>Form has been submitted</h1>';
        $displayForm = false;

        $inUsername = $_POST['username'];
        $inPassword = $_POST['password'];
        $welcomeUser = strtoupper($_POST['username']);

        $validData = true;
        if($inUsername == '') {
            $usernameMsg = 'Please enter a valid username';
            $passwordMsg = 'Please enter a valid password';

            $validData = false;
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

            $sql = 'SELECT COUNT(*) FROM trendyflorals_users WHERE users_username= :userName AND users_password= :passWord';

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':userName', $inUsername);
            $stmt->bindParam(':passWord', $inPassword);

            $stmt->execute();

            $numberOfRows = $stmt->fetchColumn();

            if($numberOfRows > 0) {
                $displayForm = false;
            }
            else {
                $inUsername = '';
                $inPassword = '';
                $loginMsg = 'Invalid username or password. Please try again';

                $displayForm = true;
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
    <title>Login</title>
    <link rel="stylesheet" href="../sassFiles/styleLogin.scss">
    <link rel="stylesheet" href="../sassFiles/styleLogin.css">

    <style>
        .login-msg span {
            color: red;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 16px 0;
        }

        .login-page {
            padding: 1em;
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
            </nav>
            <main>
                <div class="login-container">
                    <div class="login-wrapper">
                        <?php
                        if($displayForm) {
                        // the user has signed ON and should display the Admin System
                        //echo '<h2>Display form</h2>';
                        ?>
                        <form action="login.php" method= "post">
                            <h1>Login</h1>
                            <div class="login-msg">
                                <span><?php echo $loginMsg;?></span>
                            </div>
                            <div class="input-box">
                                <label for="username"></label>
                                <input type="text" name="username" id= "username" value="<?php echo $inUsername;?>" placeholder="Username" required>
                                <i class='bx bxs-user'></i>
                                <?php echo $usernameMsg?>
                                <span><?php echo $usernameMsg;?></span>
                            </div>
                            <div class="input-box">
                                <label for="password"></label>
                                <input type="password" name="password" id= "password" value="<?php echo $inPassword;?>" placeholder="Password" required>
                                <i class='bx bxs-lock-alt'></i>
                                <span><?php echo $passwordMsg;?></span>
                            </div>
                            <div class="remember-forgot">
                                <label><input type="checkbox">Remember me</label>
                                <a href="#">Forgot Password?</a>
                            </div>

                            <button type="submit" name="submit" class="submitBtn" id= "submitBtn">Login</button>
                            <div class="register-link">
                                <p>Don't have an account? <a href="">Register</a></p>
                            </div>
                        </form>
                            <?php
                        }
                        else {
                            //the user needs to display the form - to sign on OR fix their input
                            $_SESSION['validUser'] = 'valid';
                           // check this on all Admin pages
                            ?>

                            <div class="login-page">
                                <h1>Welcome, <?php echo $_SESSION['welcomeUser'];?> to Trendy Florals</h1>
                                <h2>Administrator Page</h2>
                                <ol>
                                    <li><a href="inputProduct.php">Add Product</a></li>
                                    <li><a href="listProducts.php">Show All Products - Update/Delete Product</a></li>
                                    <li><a href="database/logout.php">Log Out</a></li>
                                </ol>
                            </div>
                            <?php
                            // echo $_SESSION['validUser'];
                        } // close else branch of the ADMIN display area
                        ?>
                    </div>
                </div>
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