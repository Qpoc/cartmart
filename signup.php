<?php
session_start();

if (isset($_SESSION['sessionusername']) && isset($_SESSION['sessionpassword'])) {
    header("location:index.php");
}

require_once('php/createDB.php');
require_once('php/navigation.php');

$database = new CreateDB();

if (isset($_SESSION['buynow'])) {
    unset($_SESSION['buynow']);
    unset($_SESSION['branchid']);
}

if (isset($_SESSION['descriptionquantity'])) {
    unset($_SESSION['descriptionquantity']);
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
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Mapbox -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css' type='text/css' />
    <script src="script/product.js"></script>
    <script src="script/map.js"></script>
    <title>CartMart - Sign up</title>
</head>

<body>
    <header>
        <div class="wrapper">
            <div class="wrapper-header">
                <div class="shared-social">
                    <ul>
                        <li><a href="http://www.facebook.com"><img src="images/Icon/facebook.png" alt="" width="16"></a></li>
                        <li><a href="http://www.instagram.com"><img src="images/Icon/instagram.png" alt="" width="16"></a></li>
                        <li><a href="http://www.facebook.com"><img src="images/Icon/twitter.png" alt="" width="16"></a></li>
                        <li><a href="http://www.facebook.com"><img src="images/Icon/gmail-logo.png" alt="" width="16"></a></li>
                    </ul>
                </div>
                <div class="info">
                    <div id="website-number">
                        <h5>415-6585</h5>
                    </div>
                    <div id="separator">
                        <img src="images/Icon/Line.png" alt="" height="16">
                    </div>
                    <div id="website-email">
                        <h5>mysupermarket@gmail.com</h5>
                    </div>
                </div>
            </div>
            <div class="wrapper-header-2">
                <label for="menu">
                    <img src="images/Icon/menu.png" id="menu-icon" alt="" width="32">
                </label>
                <div id="branding">
                    <div id="logo">
                        <img src="images/Icon/eco-bag.png" alt="" width="48">
                    </div>
                    <div id="brand-name">
                        <h1>CartMart</h1>
                    </div>
                </div>
                <div id="search-bar">
                    <div class="field-wrapper">
                        <form action="" id="search">
                            <input type="text" placeholder="Search">
                        </form>
                        <div class="search-icon">
                            <img src="images/Icon/loupe.png" alt="" width="20">
                        </div>
                    </div>
                </div>
                <div id="account-wrapper">
                    <?php
                    if (isset($_SESSION['sessioncustomerid'])) {
                        echo "<div id=profile-container>";
                        echo "<img src='images/user_profile/cyrus.jpg' id='profile' alt=''>";
                        echo "</div>";
                    }
                    ?>
                    <div id="dropdown">
                        <?php
                        if (isset($_SESSION['sessioncustomername'])) {
                            echo "<select name='usersetting' id='' onchange='selectedSetting(this.value)'>";
                            echo "<option value=$_SESSION[sessioncustomername] selected hidden disabled>$_SESSION[sessioncustomername]</option>";
                            echo "<option value='manage'>Manage My Account</option>";
                            echo "<option value='logout'>Log out</option>";
                            echo "</select>";
                        } else {
                            echo "<a href='login.php'>Log in</a>";
                        }
                        ?>
                    </div>
                    <div id="cart">
                        <div id="cart-image">
                            <label for="cartclicked" id="cart-icon">
                                <img src="images/Icon/add-to-basket.png" alt="" width="32">
                            </label>
                            <input type="checkbox" id="cartclicked">
                            <div class='cart-wrapper'>
                                <div class='cart-container'>
                                    <div class='cart-item-wrapper' id="cart-item-wrapper">

                                    </div>
                                    <div class='button-container' id="button-container">
                                        <?php
                                        if (!isset($_SESSION['sessioncartquantity'])) {
                                            echo "<h5 id='empty-cart-text'>Only registered users can add to cart. Please Sign in or create an account</h5>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cart-number">
                            <?php
                            echo "<h6 id='cart-quantity'>0</h6>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper-header-3">
                <div id="category-wrapper">
                    <div class="category-container">
                        <div class='category-title'>
                            <label for="category-drop">
                                <h3>CATEGORIES</h3>
                            </label>
                        </div>
                        <input type="checkbox" id="category-drop">
                        <div class='categories'>
                            <div class='ind-category'>
                                <?php

                                require_once('php/connection.php');
                                $connection = new Connection();
                                $con = $connection->get_connection();

                                if (mysqli_connect_errno($con)) {
                                    die("An error occurred: " . mysqli_connect_error());
                                } else {
                                    $query = "SELECT DISTINCT productcategory, producttype FROM itemcategory";
                                    $count = 0;
                                    $category = [];

                                    if ($result = mysqli_query($con, $query)) {
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {

                                                if (!in_array($row['productcategory'], $category)) {
                                                    $category[$count++] = $row['productcategory'];

                                                    $query = "SELECT producttype FROM itemcategory WHERE productcategory = '$row[productcategory]'";

                                                    if ($result2 = mysqli_query($con, $query)) {
                                                        if (mysqli_num_rows($result2) > 0) {
                                                            echo "<div class='category-button'>
                                                        <label for='showType'>
                                                            <h5>$row[productcategory] <sup onclick=\"getProdByCategoryOn('$row[productcategory]')\">View All</sup></h5>
                                                        </label>
                                                        <input type='checkbox' class='show-type' id='showType'>
                                                        <div class='category-type'>
                                                        <ul>";
                                                            while ($row2 = mysqli_fetch_assoc($result2)) {

                                                                echo "<li id='$row2[producttype]' onclick=\"getProductByCategory('$row[productcategory]','$row2[producttype]')\">$row2[producttype]</li>";
                                                            }

                                                            echo "</ul>
                                                        </div>
                                                        </div>";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    mysqli_close($con);
                                }


                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="navigation-bar">
                    <nav>
                        <ul>
                            <li><a href="index.php">HOME</a></li>
                            <li><a href="">ESSENTIALS</a></li>
                            <li><a href="">HOT DEALS</a></li>
                            <li><a href="">CONTACT US</a></li>
                            <li><a href="">ABOUT US</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <main>
        <form action="php/process_signup.php" method="POST">
            <div class="wrapper">
                <div class="wrapper-login">
                    <div class="box">
                        <div class="personal-info">
                            <h2>Personal information</h2>
                            <div class="userinfo">
                                <input type='text' name='firstname' value='' required />
                                <span>First name</span>
                            </div>
                            <div class="userinfo">
                                <input type='text' name='lastname' value='' required />
                                <span>Last name</span>
                            </div>
                            <div class="userinfo">
                                <input id="addressField" type='text' name='address' value='' required />
                                <span>Address</span>
                                <img src="images/Icon/location.png" alt="" width="32" height="32" onclick="viewMap()">
                            </div>
                            <div class="userinfo">
                                <input type='text' name='mobilenumber' value='' required />
                                <span>Mobile number</span>
                            </div>
                        </div>
                        <div class="personal-info">
                            <h2>Sign in information</h2>
                            <div class="userinfo">
                                <input type='email' name='email' value='' required />
                                <span>Email address</span>
                            </div>
                            <div class="userinfo">
                                <input type='text' name='username' value='' required />
                                <span>Username</span>
                            </div>
                            <div class="userinfo">
                                <input type='password' name='password' value='' required />
                                <span>Password</span>
                            </div>
                            <input type="hidden" id="longitude" name="longitude">
                            <input type="hidden" id="latitude" name="latitude">
                        </div>
                    </div>
                    <div class="box-2">
                        <div class="buttons">
                            <input type="checkbox" id="agree" required>
                            <label for="agree">
                                <p>I have read, understood and agree to the Terms of Use and Privacy Policy of the website and I consent to the collection, use, processing and sharing of my personal data by SM MARKETS and its service group for the purposes and terms described in the SM Markets’ Privacy Policy.</p>
                            </label>
                        </div>
                    </div>
                    <div class="buttonReg">
                        <a href="redirect_url.php"><button type="submit">REGISTER</button></a>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <footer>
        <div id="footer-wrapper">
            <P>Copyright &copy; 2021 CartMart</P>
        </div>
    </footer>
    <?php
    get_navigation();
    ?>
    <div class="map-wrapper" id="mapWrapper">
        <img src="images/Icon/cancel.png" width="32" alt="" id="closeMap" onclick="closeMap();">
        <div class="map-container">
            <div id="map"></div>
            <pre id="coordinates" class="coordinates"></pre>
        </div>
    </div>
</body>

</html>