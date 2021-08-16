<?php
    session_start();

    require_once('php/navigation.php');

    if (!isset($_SESSION['rideremail'])) {
        header("location:../admin/admin_login.php");
    }

    if (isset($_SESSION['transactionid']) && isset($_SESSION['customerid'])) {
        unset($_SESSION['transactionid']);
        unset($_SESSION['customerid']);
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rider_order_list.css">
    <link rel="stylesheet" href="css/navigation.css">
    <script src="script/utilities.js"></script>
    <script src="script/accept.js"></script>
    <title>CartMart</title>
</head>

<body onload="loadCustomerOrders()">
    <main>
        <div class="navigation-container">
            <label for="navigation">
                <img src="images/icon/menu.png" alt="nav" width="32" height="32">
            </label>
        </div>
        <div class="wrapper" id="transactionContainer">
            <div class="transaction" id="orderContainer">
                <div class="header">
                    <select name="" id="">
                        <option value="" selected hidden>Filter by: </option>
                        <option value="branch">Branch</option>
                        <option value="location">Location</option>
                    </select>
                    <p><a href="accepted_cust.php">View accepted order</a></p>
                </div>
            </div>
        </div>
    </main>
    <?php
        navigation();
    ?>
</body>

</html>