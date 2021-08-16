<?php
session_start();

if (!isset($_SESSION['adminname'])) {
    header("location:admin_login.php");
}


require_once('php/navigation.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" href="../images/Icon/eco-bag.png">
    <link rel="stylesheet" href="css/rider.css">
    <link rel="stylesheet" href="css/responsive/navigation-burger.css">
    <link rel="stylesheet" href="css/responsive/rider-responsive.css">
    <script src="script/utilities.js"></script>
    <script src="script/onload.js"></script>
    <script src="script/product.js"></script>
</head>

<body onload="loadRider()">
    <header>
        <div class="wrapper">
            <div class="container">
                <div class="branding">
                    <label for="show-nav">
                        <img src="../images/Icon/menu.png" alt="" width="32">
                    </label>
                    <img src="../images/Icon/eco-bag.png" width="64" alt="">
                    <h2>CartMart</h2>
                </div>
            </div>
        </div>
    </header>
    <main>
        <?php
        get_navigation();
        ?>
        <div class='wrapper'>
            <h1>RIDER DETAILS</h1>
            <div class='navigation'>
                <nav>
                    <li><a href="rider.php" class="active">Pending Rider</a></li>
                    <li><a href="accepted_rider.php">Rider</a></li>
                </nav>
            </div>
            <div class=table-container id="tableContainer">
                <h3>Rider List</h3>
                <table>
                    <thead>
                        <thead>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Mobile Number</th>
                            <th>Date Added</th>
                            <th>Tool</th>
                        </thead>
                    </thead>
                    <tbody id="tableBody">
                     
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer id="footer">
        <div id="footer-wrapper">
            <P>Copyright &copy; 2021 CartMart</P>
        </div>
    </footer>
<div class="user-wrapper" id="userWrapper">
    <div class="close-container">
        <img src="../images/Icon/cancel.png" alt="" width="32" onclick="hideUserDetails()">
    </div>
    <div class="img-container" id="imgContainer">
        <img id="validID" src="images/admin_ID/60e2b4d3e7b540.48510212.jpg" alt="">
    </div>
</div>
</body>

</html>