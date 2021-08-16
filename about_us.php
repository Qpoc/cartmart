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
    <link rel="stylesheet" href="css/about_us.css">
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
    <header>
        <?php
            require_once('php/header.php');
        ?>
    </header>
    <main>
        <div class="term-wrapper">
            <div class="term-header">
                <h2>About Us</h2>
                <ol>
                    <li>
                        <div class="question-wrapper">
                            <div class="answer">
                                <p>Welcome to CartMart! Your number one source for all grocery needs. We’re dedicated to giving you the very best of our products, with a focus on dependability, customer service and uniqueness. We are continuously expanding our network of delivery riders to ensure we can reach and deliver to your area. We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don’t hesitate to contact us.</p>
                            </div>
                        </div>
                    </li>
                </ol>
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