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
        <form action="php/product/process_order.php" method="POST">
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