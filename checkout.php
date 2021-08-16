<?php
    session_start();

    if (!isset($_SESSION['sessionusername']) && !isset($_SESSION['sessionpassword'])) {
        header("location:login.php");
    }

    if (!isset($_SESSION['buynow']) && isset($_POST['productid'])) {
        $_SESSION['buynow'] = $_POST['productid'];
        $_SESSION['branchid'] = $_POST['branchid'];
    }

    if (isset($_POST['quantity'])) {
        $_SESSION['descriptionquantity'] = $_POST['quantity'];
    }

    if (isset($_POST['transactionid'])) {
        $_SESSION['transactionid'] = $_POST['transactionid'];
    }

    require_once('php/navigation.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CartMart - Checkout</title>
    <link rel="icon" href="images/Icon/eco-bag.png">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="script/userSettings.js"></script>
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
    <link rel="stylesheet" href="css/searchbar.css">
    <script src="script/search.js"></script>
    <script src='https://unpkg.com/@turf/turf@6.3.0/turf.min.js'></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
</head>
<?php
    if (isset($_SESSION['sessioncustomerid'])) {
        if (isset($_SESSION['descriptionquantity']) && isset($_SESSION['buynow'])) {
            echo "<body onload=\"loadCheckout('$_SESSION[buynow]', 1, $_SESSION[descriptionquantity], '$_SESSION[branchid]')\">";
        }else if(!isset($_SESSION['descriptionquantity']) && isset($_SESSION['buynow'])) {
            echo "<body onload=\"loadCheckout('$_SESSION[buynow]', 0, 1, '$_SESSION[branchid]')\">";
        }else {
            echo "<body onload='multipleCheckout()'>";
        }
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
    <section>
        <form id="formPlaceOrder" action="php/product/process_order.php" method="POST">
            <div class="view-cart-wrapper">
                <div class="view-cart-container" id="view-cart-container">
                    <div class='view-cart-header'>
                        
                    
                    </div> 
                </div>
                <div class='view-cart-voucher-container' id="view-cart-voucher-container">
                
                </div>
            </div>
        </form>
    </section>
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