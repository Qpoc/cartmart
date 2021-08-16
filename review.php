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
    <link rel="stylesheet" href="css/review.css">
    <title>CartMart - My Account</title>
    <script src="script/userSettings.js"></script>
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
    <link rel="stylesheet" href="css/searchbar.css">
    <script src="script/search.js"></script>
</head>
<?php
    if (isset($_SESSION['sessioncustomerid'])) {
        echo "<body onload =\"loadCartUserInfo('review')\">";
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
                    <h4 id="name">Hi,</h4>
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
                    </ul>
                </div>
                <div class="navigate">
                    <h3><a href="admin/admin_reg.php">Do you want to be a part of us? Let us know :)</a></h3>
                </div>
            </div>
            <div class="main-container">
                <h2>My Past Purchases, Reviews & Comments</h2>
                <div class="recent-container">
                    <div class="recent" id="recent">
                        <div class="options" id="options">
                            <nav>
                                <ul>
                                    <li><p class="active">To be Reviewed</p></li>
                                    <li><p>History</p></li>
                                </ul>
                            </nav>
                            <script type="text/javascript">
                                var elem = document.getElementById('options').getElementsByTagName('p');
                                for (let index = 0; index < elem.length; index++) {
                                    elem[index].addEventListener('click', function(){
                                        document.getElementsByClassName('active')[0].className = "";
                                        this.className = "active";
                                        if (this.innerHTML.toLowerCase() == 'history') {
                                            getReviewHistory();
                                        }else if (this.innerHTML.toLowerCase() == 'to be reviewed'){
                                            getOrderToReview();
                                        }
                                    });
                                }
                            </script>
                        </div>
                        <table id="table">
                            
                            
                                
                            
                        </table>
                        <script type="text/javascript">
                            getOrderToReview();
                        </script>
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
    <div class="product-description" id="product-description">
        <div class="close">
            <img src="images/Icon/cancel.png" alt="" width="32" height="32" onclick="closeReview()">
        </div>
        <div class="wrapper" id="description-wrapper">
            <div class="img">
                <img id="productimg" src="" alt="product image">
                <p id="productname"></p>
            </div>
            <div class="rating">
                <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
                <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
                <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
                <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
                <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            </div>
            <div class="reviewContainer" id="reviewContainer">
                <script type="text/javascript">
                    var star = document.getElementsByClassName('fa fa-star-o fa-2x');
                    
                    for (var i = 0; i < star.length; i++) {
                        star[i].addEventListener('mouseover', function(){
                            
                            var starcmp = document.getElementsByTagName('i');

                            for (var y = 0; y < starcmp.length; y++) {
                                starcmp[y].className = "fa fa-star-o fa-2x";
                            }

                            this.className = "fa fa-star fa-2x";
                            
                            for (let index = 0; index < starcmp.length; index++) {
                                if (starcmp[index].className != this.className) {
                                    starcmp[index].className = "fa fa-star fa-2x";
                                }else{
                                    break;
                                }
                            }

                        });
                        star[i].addEventListener('click', function(){
                            this.className = "fa fa-star-o fa-2x";
                        });
                    }
                    

                </script>
            </div>
        </div>
    </div>
<?php
    get_navigation();
?>
</body>
</html>