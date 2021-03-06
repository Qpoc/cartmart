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
    <link rel="stylesheet" href="css/rider_home.css">
    <link rel="stylesheet" href="css/navigation.css">
    <script src="script/utilities.js"></script>
    <script src="script/onload.js"></script>
    <title>CartMart</title>
</head>

<body onload="loadData()">
    <main>
        <div class="navigation-container">
            <label for="navigation">
                <img src="images/icon/menu.png" alt="nav" width="32" height="32">
            </label>
        </div>
        <div class="wrapper">
            <div class="container" id="earnings">
                <div class="reports">
                    <div class="title">
                        <h2>EARNINGS FOR THE DAY</h2>
                    </div>
                    <div class="content">
                        <p id="earnDay">&#8369;0</p>
                    </div>
                    <div class="img-container">
                        <img src="images/icon/earnings.png" alt="">
                    </div>
                </div>
                <div class="reports">
                    <div class="title">
                        <h2>EARNINGS FOR THE MONTH</h2>
                    </div>
                    <div class="content">
                        <p id="earnMonth">&#8369;0</p>
                    </div>
                    <div class="img-container">
                        <img src="images/icon/earnings.png" alt="">
                    </div>
                </div>
                <!-- Optional -->
                <!-- <div class="reports">
                    <div class="title">
                        <h2>PERFORMANCE</h2>
                    </div>
                    <div class="content">
                        <p class="rate">Rating: 5.0</p>
                        <p class="rate">Acceptance rate: 95%</p>
                        <p class="rate">Cancellation rate: 5%</p>
                    </div>
                    <div class="img-container">
                        <img src="images/icon/rating.png" alt="">
                    </div>
                </div> -->
            </div>
            <div class="transaction">
                <div class="reports">
                    <div class="title">
                        <h2>ORDERS</h2>
                    </div>
                    <div class="content">
                        <p id="pending">Pending orders: 0</p>
                        <p id="ongoing">Ongoing orders: 0</p>
                    </div>
                </div>
                <div class="reports">
                    <div class="title">
                        <h2>BOOKS MADE TODAY</h2>
                    </div>
                    <div class="content">
                        <p id='books'>0</p>
                    </div>
                    <div class="img-container">
                        <img src="images/icon/booking.png" alt="">
                    </div>
                </div>
            </div>
    </main>
    <script>
        function scrollHorizontally(e) {
            e = window.event || e;
            var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
            document.getElementById('earnings').scrollLeft -= (delta * 150); // Multiplied by 40
            e.preventDefault();
        }

        document.getElementById('earnings').addEventListener('mousewheel', scrollHorizontally, false);
    </script>
    <?php
        navigation();
    ?>
</body>

</html>