<?php
    session_start();

    if (!isset($_SESSION['sessionusername']) && !isset($_SESSION['sessionpassword'])) {
        header("location:index.php");
    }

    require_once('php/navigation.php');

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
    <title>Welcome to CartMart</title>
    <link rel="icon" href="images/Icon/eco-bag.png">
    <link rel="stylesheet" href="css/view_cart.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="script/userSettings.js"></script>
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
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
        echo "<body onload='onEditLoadCart(false)'>";
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
        <div class="view-cart-wrapper">
            <div class="view-cart-container" id="view-cart-container">
                <div class='view-cart-header'>
                    <?php
                        if (isset($_SESSION['count_cart'])) {
                            echo "<h1>Cart Item $_SESSION[count_cart]</h1>";
                        }else {
                            echo "<h1>Cart Item 0</h1>";
                        }
                    ?>
                   
                </div> 
            </div>
            <div class='view-cart-voucher-container' id="view-cart-voucher-container">
               
            </div>
        </div>
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