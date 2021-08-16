<?php
    session_start();

    require_once('php/navigation.php');

    if (!isset($_SESSION['rideremail'])) {
        header("location:../admin/admin_login.php");
    }

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
    <link rel="stylesheet" href="css/navigation.css">
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
        <div class="navigation-container">
            <label for="navigation">
                <img src="images/icon/menu.png" alt="nav" width="32" height="32">
            </label>
        </div>
        <div class="wrapper">
            <div class="transaction" id="transactionContainer">
            
            </div>
        </div>
    </main>
    <?php
        navigation();
    ?>
</body>

</html>