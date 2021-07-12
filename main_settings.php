<?php
    session_start();

    require_once('php/navigation.php');

    if (!isset($_SESSION['sessioncustomerid'])) {
        header("location:index.php");
    }

    if (isset($_SESSION['buynow'])) {
        unset($_SESSION['buynow']);
        unset($_SESSION['branchid']);
    }

    if (isset($_SESSION['category'])) {
        unset($_SESSION['category']);
    }

    if (isset($_SESSION['descriptionquantity'])) {
        unset($_SESSION['descriptionquantity']);
    }

    if (isset($_POST['transactionid'])) {
        $_SESSION['transactionid'] = $_POST['transactionid'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link media="all" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="images/Icon/eco-bag.png">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/main_settings.css">
    <title>CartMart - My Account</title>
    <script src="script/userSettings.js"></script>
    <script src="script/product.js"></script>
</head>
<?php
    if (isset($_SESSION['sessioncustomerid'])) {
        echo "<body onload =\"loadCartUserInfo('manage')\">";
    }else {
        echo "<body>";
    }
?>
    <header id="header">
        <?php
            require_once('php/header.php');
        ?>
    </header>
    <main id="main">
        <div class="main-wrapper">
            <div class="account-navigation">
                <div class="name">
                    <h4 id="name">Hi</h4>
                </div>
                <div class="navigate">
                    <h3><a href="main_settings.php">Manage My Account</a></h3>
                    <ul>
                        <li><a href="profile.php">My Profile</a></li>
                        <li><a href="address.php">Address Book</a></li>
                        <li><a href="voucher.php">Vouchers</a></li>
                    </ul>
                </div>
                <div class="navigate">
                    <h3><a href="my_orders.php">My Orders</a></h3>
                    <ul>
                        <li><a href="list_track_order.php">Track My Order</a></li>
                        <li><a href="review.php">My Reviews</a></li>
                        <li><a href="wishlist.php">My Wishlist</a></li>
                        <li><a href="cancellation.php">My Cancellations</a></li>
                    </ul>
                </div>
                <div class="navigate">
                    <h3><a href="admin/admin_reg.php">Do you want to be a part of us? Let us know :)</a></h3>
                </div>
            </div>
            <div class="main-container">
                <h2>Manage My Account</h2>
                <div class="information-container">
                    <div class="information">
                        <h4>Personal Profile | <sup><a href="profile.php">EDIT</a></sup></h4>
                        <p id="editName"></p>
                        <p id="email"></p>
                    </div>
                    <div class="information">
                        <h4>Address Book | <sup><a href="address.php">EDIT</a></sup></h4>
                        <p>DEFAULT SHIPPING ADDRESS</p>
                        <p id="bookName"></p>
                        <p id="bookAddress"></p>
                        <p id="bookCellNum"></p>
                    </div>
                </div>
                <div class="recent-container">
                    <div class="recent">
                        <h3>Recent Activities</h3>
                        <table>
                            <thead>
                                <th>Order ID</th>
                                <th>Placed On</th>
                                <th>Items</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                <tr>
                                   <td data-label="Order ID">6356985847</td>
                                   <td data-label="Date">June 28, 2021</td>
                                   <td data-label="Items"> 
                                        <div class="product-container">
                                            <img src="images/products/60d4a7df815aa4.75843459.jpg" alt="">
                                        </div>
                                        <p>Vita Coco Milk</p>
                                   </td>
                                   <td data-label="Total">&#8369; 350.25</td>
                                </tr>
                                <tr>
                                   <td data-label="Order ID">6356985847</td>
                                   <td data-label="Date">June 28, 2021</td>
                                   <td data-label="Items"> 
                                        <div class="product-container">
                                            <img src="images/products/60d4a7df815aa4.75843459.jpg" alt="">
                                        </div>
                                        <p>Vita Coco Milk</p>
                                   </td>
                                   <td data-label="Total">&#8369; 350.25</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer id="footer">
        <div id="footer-wrapper">
            <P>Copyright &copy; 2021 CartMart</P>
        </div>
    </footer>
<?php
    get_navigation();
?>
</body>
</html>