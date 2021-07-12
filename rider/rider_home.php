<?php
    session_start();

    require_once('php/navigation.php');

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
    <script src="script/utilities.js"></script>
    <title>CartMart</title>
</head>

<body>
    <main>
        <div class="wrapper">
            <div class="container" id="earnings">
                <div class="reports">
                    <div class="title">
                        <h2>EARNINGS FOR THE DAY</h2>
                    </div>
                    <div class="content">
                        <p>&#8369;40.00</p>
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
                        <p>&#8369;40.00</p>
                    </div>
                    <div class="img-container">
                        <img src="images/icon/earnings.png" alt="">
                    </div>
                </div>
                <div class="reports">
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
                </div>
            </div>
            <div class="transaction">
                <div class="reports">
                    <div class="title">
                        <h2>ORDERS</h2>
                    </div>
                    <div class="content">
                        <p>Pending orders: 105 - <a href="rider_order_list.php">Details</a></p>
                        <p>Ongoing orders: 5/5 - <a href="accepted_cust.php">Details</a></p>
                    </div>
                </div>
                <div class="reports">
                    <div class="title">
                        <h2>BOOKS MADE TODAY</h2>
                    </div>
                    <div class="content">
                        <p>10</p>
                    </div>
                    <div class="img-container">
                        <img src="images/icon/booking.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php
            navigation();
        ?>
    </footer>
    <script>
        function scrollHorizontally(e) {
            e = window.event || e;
            var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
            document.getElementById('earnings').scrollLeft -= (delta * 150); // Multiplied by 40
            e.preventDefault();
        }

        document.getElementById('earnings').addEventListener('mousewheel', scrollHorizontally, false);

    </script>
    <script>
        var navigation = document.getElementsByTagName("h3");

        for (let index = 0; index < navigation.length; index++) {
            navigation[index].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                var image = document.getElementsByName("imgnav");
                var currentImg = document.getElementsByClassName("imgactive");

                current[0].className = "";
                currentImg[0].className = "";
                image[index].className = "imgactive"
                console.log("OUTPUT : index", index);
                this.className = "active";
            });
        }
    </script>
</body>

</html>