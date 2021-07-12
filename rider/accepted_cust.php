<?php
    session_start();

    require_once('php/navigation.php');
    require_once('php/connection.php');

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
    <link rel="stylesheet" href="css/accepted_cust.css">
    <script src="script/accept.js"></script>
    <script src="script/utilities.js"></script>
    <title>CartMart</title>
</head>
<?php
    $connection = new Connection();
    $con = $connection->get_connection();
    $count = $connection->count_acc_order();

    if ($count > 0) {
        echo "<body onload=\"loadAcceptedOrders()\">";
    }else if ($count <= 0) {
        echo "<body>";
    }

?>
<body>
    <main>
        <div class="wrapper" id="acceptedCustContainer">
            <div class="header">
                <h4>List of your accepted customers</h4>
                <input type="button" value="VIEW ALL ORDERS">
            </div>
        </div>
    </main>
    <footer>
        <?php
            navigation();
        ?>
    </footer>
    <div class="wrapper-chat" id="chatBox">
        
    </div>
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