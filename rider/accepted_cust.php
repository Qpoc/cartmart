<?php
    session_start();

    if (!isset($_SESSION['rideremail'])) {
        header("location:../admin/admin_login.php");
    }

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
    <link rel="stylesheet" href="css/navigation.css">
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
        <div class="navigation-container">
            <label for="navigation">
                <img src="images/icon/menu.png" alt="nav" width="32" height="32">
            </label>
        </div>
        <div class="wrapper" id="acceptedCustContainer">
            <div class="header">
                <h4>List of your accepted customers</h4>
            </div>
        </div>
    </main>
    <div class="wrapper-chat" id="chatBox">
        
    </div>
    <?php
        navigation();
    ?>
</body>

</html>