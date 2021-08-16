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
    <link rel="stylesheet" href="css/sales.css">
    <link rel="stylesheet" href="css/responsive/navigation-burger.css">
    <script src="script/utilities.js"></script>
    <script src="script/onload.js"></script>
    <script src="script/product.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
</head>

<body onload="loadSalesDetails()">
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
            <h1>SALES DETAILS</h1>
            <div class='navigation'>
                <nav>
                    <li><a href="sales.php" class="active">Product with Sales</a></li>
                    <li><a href="nonsales.php">Product with No Sales</a></li>
                </nav>
            </div>
            <div class=table-container id="tableContainer">
                <h3>Sales List</h3>
                <table>
                    <thead>
                        <thead>
                            <th>Branch Name</th>
                            <th>Product Name</th>
                            <th>Number of Sales</th>
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
    <table>
        <thead>
            <th>Username</th>
            <th>Password</th>
            <th>Mobile Number</th>
            <th>Tool</th>
        </thead>
        <tbody id="userDetails">
            
        </tbody>
    </table>
</div>
<div class="user-wrapper" id="cartWrapper">
    <div class="close-container">
        <img src="../images/Icon/cancel.png" alt="" width="32" onclick="hideUserDetails()">
    </div>
    <table>
        <thead>
            <th>Photo</th>
            <th>Name</th>
        </thead>
        <tbody id="cartDetails">
            
        </tbody>
    </table>
</div>
</body>

</html>