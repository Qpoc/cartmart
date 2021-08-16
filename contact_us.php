<?php
session_start();

require_once('php/createDB.php');
require_once('php/navigation.php');

$database = new CreateDB();

if (isset($_SESSION['buynow'])) {
    unset($_SESSION['buynow']);
    unset($_SESSION['branchid']);
}

if (isset($_SESSION['descriptionquantity'])) {
    unset($_SESSION['descriptionquantity']);
}

if (isset($_SESSION['category'])) {
    unset($_SESSION['category']);
}

if (isset($_SESSION['descriptionquantity'])) {
    unset($_SESSION['descriptionquantity']);
}

if (isset($_POST['transactionid'])) {
    $_SESSION['transactionid'] = $_POST['transactionid'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contact_us.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/searchbar.css">
    <script src="script/userSettings.js"></script>
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
    <script src="script/search.js"></script>
    <title>CartMart - Sign up</title>
</head>

<?php
    if (isset($_SESSION['sessioncustomerid'])) {
        echo "<body onload='onLoadCart()'>";
    }else {
        echo "<body>";
    }
?>
<header id="header">
    <?php
        require_once('php/header.php');
    ?>
</header>
    <main>
       <div class="con-wrapper">
            <div class="con-container">
                <div class="header">
                    <h2>CONTACT US</h2>
                    <p>For any questions or concerns regarding your order, please do not hesitate to talk to us, Fill out the form on the left side below with your details and we will get back to you as soon as we can.Feel free to contact us anytime!
                    </p>
                    <h4 id="feedback">Your feedback is important to us as we continuously aim to improve our service.</h4>
                </div>
                <form action="">
                    <div class="content">
                        <div class="customer-info">
                            <input type="text" placeholder="Name">
                            <input type="text" placeholder="Email">
                            <div class="contact-number">
                                <input type="text" placeholder="Contact Number">
                                <input type="text" placeholder="Order Number">
                            </div>
                            <div class="concern">
                                <h4>What is your concern?</h4>
                            </div>
                            <select name="concern" id="concern">
                                <option value="" selected hidden>Select type of concern</option>
                            </select>
                            <textarea name="message" id="message" cols="10" rows="10" placeholder="message"></textarea>
                            <div class="button">
                                <input type="submit" value="SUBMIT">
                            </div>
                        </div>
                        <div class="contact-info">
                            <div class="info-content">
                                <h4>For Immediate Assistance</h4>
                                <ul>
                                    <li>Call us at (45) 415-4574</li>
                                    <li>Monday-Friday, between office hours</li>
                                    <li>9:00 AM - 7:30 PM</li>
                                </ul>
                            </div>
                            <div class="info-content">
                                <h4>Corporate Address</h4>
                                <ul>
                                    <li>CartMart Inc., Philippines Manila</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
       </div>
    </main>
    <footer>
        <div id="footer-wrapper">
            <P>Copyright &copy; 2021 CartMart</P>
        </div>
    </footer>
    <?php
    get_navigation();
    ?>
</body>

</html>