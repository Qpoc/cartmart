<?php
    session_start();

    require_once('php/navigation.php');

    if (isset($_POST['transactionid']) && isset($_POST['customerid'])) {
        $_SESSION['transactionid'] = $_POST['transactionid'];
        $_SESSION['customerid'] = $_POST['customerid'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order_list.css">
    <script src="script/utilities.js"></script>
    <script src="script/accept.js"></script>
    <title>CartMart</title>
</head>
<?php
    if (isset($_SESSION['transactionid']) && isset($_SESSION['customerid'])) {
        echo "<body onload=\"loadOrderList('$_SESSION[transactionid]', '$_SESSION[customerid]')\">";
    }else if (!isset($_SESSION['transactionid']) && !isset($_SESSION['customerid'])){
        echo "<body>";
    }
?>
    <main>
        <div class="wrapper">
            <div class="transaction" id="transactionContainer">
            
            </div>
        </div>
    </main>
    <footer>
        <?php
            navigation();
        ?>
    </footer>
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