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
                    }else {
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
                            }else {
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