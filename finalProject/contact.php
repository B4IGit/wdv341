<?php

$message_sent = false;
if(isset($_POST['email']) && $_POST['email'] != '') {

    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        // submit the form
        if (isset($_POST['email']) && $_POST['email'] != '') {
            $userFirstName = $_POST['firstName'];
            $userLastName = $_POST['lastName'];
            $userEmail = $_POST['email'];
            $userPhoneNum = $_POST['phone'];
            $userSubject = $_POST['subject'];
            $userMsg = $_POST['message'];

            $to = $_POST['email'];
            $body = '';

            $body .= 'From: ' . $userFirstName . '' . $userLastName . '\r\n';
            $body .= 'Email: ' . $userEmail . '\r\n';
            $body .= 'Phone Number: ' . $userPhoneNum . '\r\n';
            $body .= 'Message: ' . $userSubject . '\r\n';

            mail($to, $userSubject, $body);

            $message_sent = true;
    }
        else {
            $invalid_form_submission = 'invalid-form';
        }

    }

}








?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="sassFiles/styleLogin.css">
    <link rel="stylesheet" href="sassFiles/styleLogin.scss">
    <link rel="stylesheet"href="sassFiles/styleContactForm.css">
    <link rel="stylesheet" href="sassFiles/styleContactForm.scss">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
        <nav>
        <div class="navBar" id="navBar">
            <div class="navLogo">
                <p>trendy florals</p>
            </div>
            <div class="navLinks" id="navLinks">
                <a href="/wdv341/finalProject/index.php">Home</a>
                <a href="#about">About</a>
                <a href="contact.php">Contact</a>
                <a href="#shop">Shop</a>
                <a href="#checkout">Checkout</a>
                <a href="/wdv341/finalProject/sessionFolder/login.php">Login</a>
            </div>
            <button class="mobileMenuIcon" onclick="toggleMenu()">&#9776;</button>
            <script>
                function toggleMenu() {
                    var navLinks = document.getElementById('navLinks');
                    if (navLinks.style.display === "none" || navLinks.style.display === "") {
                        navLinks.style.display = "flex";
                    } else {
                        navLinks.style.display = "none";
                    }
                }
            </script>
        </div>
    </nav>
        <section>
            <?php
            if($message_sent):
                ?>
                <div class="confirmEmailMsg">
                    <p>Jeff, My brain hurts. Your email has been sent to <?php echo $userEmail;?>;</p><br>
                    <p>Click, to go back to Contact page <a href="contact.php">Go Back</a> </p>
                </div>
            <?php
            else:
            ?>
            <div class="contactForm-container">
                <div class="contact-box">
                    <div class="left"></div>
                    <div class="right">
                        <h2>Contact Us</h2>
                        <form action="contact.php" method="post">
                            <input type="text" name="firstName" class="field"  placeholder="First Name" required>
                            <input type="text" name="lastName" class="field"  placeholder="Last Name" required>
                            <!--                        validate email. if invalid, form does not submit-->
                            <input  type="email" name="email" class="field <?php $invalid_form_submission ?? "" ?>" placeholder="Email" required>
                            <input type="tel" name="phone" class="field" placeholder="Phone Number">
                            <input type="text" name="subject" class="field" placeholder="Subject">
                            <textarea name="message" class="field area" placeholder="Send Us A Message..."></textarea>
                            <button class="contactBtn">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
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
                    <div class="social-icons">
                        <i class='bx bxl-facebook-circle'></i>
                        <i class='bx bxl-instagram-alt' ></i>
                        <i class='bx bxl-twitter'></i>
                    </div>
                </div>
            </div>
        </footer>

        <div class="copy-rights">
            <p>All Rights Reserved. WDV Final Project, &copy;
                <?php echo date('Y');?>.
            </p>
        </div>
</div>
<?php
endif;
?>
</body>
</html>