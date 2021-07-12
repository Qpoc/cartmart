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
    <link rel="stylesheet" href="css/rider_order_list.css">
    <script src="script/utilities.js"></script>
    <script src="script/accept.js"></script>
    <title>CartMart</title>
</head>

<body onload="loadCustomerOrders()">
    <main>
        <div class="wrapper" id="transactionContainer">
            <div class="transaction" id="orderContainer">
                <div class="header">
                    <input type="button" value="ACCEPT ALL">
                    <select name="" id="">
                        <option value="" selected hidden>Filter by: </option>
                        <option value="branch">Branch</option>
                        <option value="location">Location</option>
                    </select>
                    <p>Accepted: 0/5 > <a href="accepted_cust.php">view accepted order</a></p>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php
            navigation();
        ?>
    </footer>
    <script type="text/javascript">
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