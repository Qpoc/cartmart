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
    <link rel="stylesheet" href="css/review.css">
    <title>CartMart - My Account</title>
    <script src="script/userSettings.js"></script>
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
</head>
<?php
    if (isset($_SESSION['sessioncustomerid'])) {
        echo "<body onload='onLoadCart()'>";
    }else {
        echo "<body>";
    }
?>
    <header id="header">
        <?php
            require_once('php/header.php');
        ?>
    </header>
    <main>
        <div class="main-wrapper">
            <div class="account-navigation">
                <div class="name">
                    <h4>Hi, John Cyrus Patungan</h4>
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
                        <li><a href="">Track My Order</a></li>
                        <li><a href="review.php">My Reviews</a></li>
                        <li><a href="wishlist.php">My Wishlist</a></li>
                        <li><a href="cancellation.php">My Cancellations</a></li>
                    </ul>
                </div>
                <div class="navigate">
                    <h3><a href="">Do you want to be a part of us? Let us know :)</a></h3>
                </div>
            </div>
            <div class="main-container">
                <h2>My Past Purchases, Reviews & Comments</h2>
                <div class="recent-container">
                    <div class="recent">
                        <div class="options">
                            <select name="" id="">
                                <option value="5">To Be Reviewed</option>
                                <option value="5">History</option>
                            </select>
                        </div>
                        <table>
                            <thead>
                                <th>Purchased</th>
                                <th>Review</th>
                            </thead>
                            <tbody>
                                <tr>
                                   <td data-label="Items"> 
                                        <div class="product-container">
                                            <img src="images/products/60d4a7df815aa4.75843459.jpg" alt="">
                                        </div>
                                        <p>Vita Coco Milk</p>
                                   </td>
                                   <td data-label="Total"><input type="button" value="REVIEW"></td>
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
    <div class="product-description">
        <div class="wrapper" id="description-wrapper">
            
        </div>
    </div>
<?php
    get_navigation();
?>
</body>
</html>