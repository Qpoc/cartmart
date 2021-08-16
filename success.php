<?php

session_start();

require_once('php/navigation.php');
require_once('php/connection.php');

if (!isset($_SESSION['sessionusername']) && !isset($_SESSION['sessionpassword'])) {
    header("location:login.php");
}

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

$connection = new Connection();
$con = $connection->get_connection();

if (mysqli_connect_errno($con)) {
    die("An error occurred: " . mysqli_connect_error());
    header("location:checkout.php");
}else {

    date_default_timezone_set("Asia/Manila");

    $customerid = $_SESSION['sessioncustomerid'];
    $accept = 'false';
    $date = date('Y-m-d');
    $transactionid = $_SESSION['transactionid'];
    $branchid = $_SESSION['branch'];
    $productid = $_SESSION['productid'];
    $quantity = $_SESSION['quantity'];
    $item_total_price = $_SESSION['item_total_price'];
    $subtotal =  $_SESSION['subtotal'];
    $del_fee = $_SESSION['del_fee'];
    $total_price = $_SESSION['total_price'];
    $mod = $_SESSION['mod'];
    $points = $_SESSION['points'];

    $query = "INSERT INTO transactiontable (transactionID, customerID, subtotal, delfee, totalprice, dateadded, accept, modepayment) VALUES ('$transactionid', '$customerid', $subtotal, '$del_fee', $total_price, '$date', '$accept', '$mod')";

    if (mysqli_query($con, $query)) {
        $output = "";
        for ($index=0; $index < count($productid); $index++) { 
            $output = $output . "('$transactionid', '$branchid[$index]', '$productid[$index]', $quantity[$index], $item_total_price[$index])";
            if ($index + 1 != count($productid)) {
                $output = $output . ", ";
            }
        }
        
        $query = "INSERT INTO ordertable (transactionID, branchID, productID, quantity, itemprice) VALUES " . $output;

        if (mysqli_query($con, $query)) {
            // additional
            $query = "UPDATE customerpoints SET customerpoints = '$points' WHERE customerid = '$customerid'";

            if (mysqli_query($con, $query)) {
                $_SESSION['transactionid'] = $transactionid;
                $_SESSION['totalPrice'] = $total_price;
                $_SESSION['dateorder'] = $date;
                require "Mailer/mail.php";
            }else {
                die("An error occurred: " . mysqli_error($con));
                // header("location:checkout.php");
            }
        }else {
            die("An error occurred: " . mysqli_error($con));
            // header("location:checkout.php");
        }


    }else {
        // header("location:checkout.php");
    }
}

mysqli_close($con);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/success.css">
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
        <div class="thankyou-container">
            <h2>THANK YOU FOR PURCHASING WITH US!</h2>
            <?php
                echo "<p>Hi $_SESSION[sessioncustomername],
                Just following up on your recent purchase with us. 
                There are plenty of choices out there that do something similar to us, but we’re ecstatic that you’ve decided to choose us.
                Thank you for your support!
                -CartMart";
            ?>
            </p>
            <p>We've attached your receipt to your email address.</p>
            <p>If you have any concerns, please <a href="contact_us.php">contact us</a></p>
            <p><a href="track_order.php"><input type="button" value="TRACK YOUR ORDER"></a></p>
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