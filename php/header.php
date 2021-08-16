<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId=254968876131539&autoLogAppEvents=1" nonce="ZlZhmLPD"></script>

<div class="wrapper">
    <div class="wrapper-header">
        <div class="shared-social">
            <ul>
                <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fcartmart.epizy.com%2F&amp;src=sdkpreparse"><img src="images/Icon/facebook.png" alt="" width="16"></a></li>
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
                <input type="text" id="searchProduct" placeholder="Search">
                <div class="search-icon">
                    <img src="images/Icon/loupe.png" alt="" width="20">
                </div>
                <div class="search-result" id="search-result">
                    
                </div>
                <script type="text/javascript">
                    var elem = document.getElementById('searchProduct');
                    elem.addEventListener("keyup", function(){
                        if (this.value.trim().length != 0) {
                            searchProduct(this.value.trim());
                        }else if(this.value.length == 0){
                            closeSearchProduct();
                        }
                    });
                </script>
            </div>
        </div>
        <div id="account-wrapper">
            <!-- <?php
                    if (isset($_SESSION['sessioncustomerid'])) {
                        echo "<div id=profile-container>";
                        echo "<img src='images/user_profile/cyrus.jpg' id='profile' alt=''>";
                        echo "</div>";
                    }
                    ?> -->
            <div id="dropdown">
                <?php
                if (isset($_SESSION['sessioncustomername'])) {
                    echo "<select name='usersetting' id='' onchange='selectedSetting(this.value)'>";
                    echo "<option value=$_SESSION[sessioncustomername] selected hidden disabled>$_SESSION[sessioncustomername]</option>";
                    echo "<option value='manage'>Manage My Account</option>";
                    echo "<option value='track'>Track My Order</option>";
                    echo "<option value='logout'>Log out</option>";
                    echo "</select>";
                } else {
                    if (basename($_SERVER['PHP_SELF']) == 'login.php') {
                        echo "<a href='signup.php'>Create an account</a>";
                    }else if (basename($_SERVER['PHP_SELF']) == 'signup.php') {
                        echo "<a href='login.php'>Log in</a>";
                    }else if (basename($_SERVER['PHP_SELF']) == 'index.php'){
                        echo "<a href='login.php'>Log in</a>";
                    }else {
                        echo "<a href='login.php'>Log in</a>";
                    }
                    
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
        <div id="navigation-bar" style="margin-left: 550px;">
            <nav>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                    <li><a href="contact_us.php">CONTACT US</a></li>
                    <li><a href="about_us.php">ABOUT US</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>