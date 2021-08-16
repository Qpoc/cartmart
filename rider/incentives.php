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
    <link rel="stylesheet" href="css/incentives.css">
    <link rel="stylesheet" href="css/navigation.css">
    <script src="script/utilities.js"></script>
    <script src="script/onload.js"></script>
    <title>CartMart</title>
</head>

<body onload="">
    <main>
        <div class="navigation-container">
            <label for="navigation">
                <img src="images/icon/menu.png" alt="nav" width="32" height="32">
            </label>
        </div>
        <div class="wrapper">
            <div class="header">
                <h2>Total Incentives: &#8369;0</h2>
            </div>
            <div class="container" id="earnings">
                <div class="reports">
                    <div class="title">
                        <h2>TOTAL CHALLENGES THIS WEEK</h2>
                    </div>
                    <div class="content">
                        <p id="earnDay">0</p>
                    </div>
                    <div class="img-container">
                        <img src="images/icon/earnings.png" alt="">
                    </div>
                </div>
                <div class="reports">
                    <div class="title">
                        <h2>COMPLETED CHALLENGES</h2>
                    </div>
                    <div class="content">
                        <p id="earnMonth">0</p>
                    </div>
                    <div class="img-container">
                        <img src="images/icon/earnings.png" alt="">
                    </div>
                </div>
            </div>
            <div class="transaction">
                <div class="reports">
                    <div class="title">
                        <h2>MAKE 10 DELIVERIES TODAY</h2>
                    </div>
                    <div class="content">
                        <p id="pending">PROGRESS: 0</p>
                    </div>
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