<?php

    function get_navigation()
    {
        
        echo "<div class='wrapper-menu'>
        <input type='checkbox' id='menu'>
        <div class='container-menu'>
            <nav>
                <ul>";
                    if(!isset($_SESSION['sessioncustomername'])){
                        echo "<li><a href='login.php'>LOGIN</a></li>
                        <li><a href='signup.php'>SIGN UP</a></li>";
                    }else {
                        echo "<li>
                        <select name='usersetting' id='' onchange='selectedSetting(this.value)'>
                        <option value=$_SESSION[sessioncustomername] selected hidden disabled>$_SESSION[sessioncustomername]</option>
                        <option value='manage'>Manage My Account</option>
                        <option value='profile'>My Profile</option>
                        <option value='address'>Address Book</option>
                        <option value='voucher'>Vouchers</option>
                        <option value='order'>My Order</option>
                        <option value=''>Track My Order</option>
                        <option value='review'>My Reviews</option>
                        <option value='wishlist'>My Wishlist</option>
                        <option value='cancellation'>My Cancellations</option>
                        <option value='logout'>Log out</option>
                        </select>
                        </li>";
                    }
        echo"</ul>
                    <ul>
                    <li><a href='index.php'>HOME</a></li>
                    <li><a href=''>ESSENTIALS</a></li>
                    <li><a href=''>HOT DEALS</a></li>
                    <li><a href=''>CONTACT US</a></li>
                    <li><a href=''>ABOUT US</a></li>
                </ul>
                <ul>
                    <h3>CATEGORIES</h3>
                    ";
                require_once('connection.php');
                $connection = new Connection();
                $con = $connection->get_connection();

                if (mysqli_connect_errno($con)) {
                    die('An error occurred: ' . mysqli_connect_error());
                }else {
                    $query = "SELECT DISTINCT productcategory, producttype FROM itemcategory";
                    $count = 0;
                    $category = [];

                    if ($result = mysqli_query($con, $query)) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                if (!in_array($row['productcategory'], $category)) {
                                   $category[$count++] = $row['productcategory'];
                                    echo "<li>
                                    <label for='$row[productcategory]'>$row[productcategory] <sup onclick=\"getProdByCategoryOn('$row[productcategory]')\">View All</sup></label>
                                    <div class='wrapper-type'>
                                        <input type='checkbox' class='category' id='$row[productcategory]'>
                                        <div class='container-type'>
                                            <nav>
                                                <ul>";

                                                $query = "SELECT producttype FROM itemcategory WHERE productcategory = '$row[productcategory]'";

                                                if ($result2 = mysqli_query($con, $query)) {
                                                    if (mysqli_num_rows($result2) > 0) {
                                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                                            echo "<li id='$row2[producttype]' onclick=\"getProductByCategory('$row[productcategory]','$row2[producttype]')\">$row2[producttype]</li>";
                                                        }
                                                    }
                                                }
                                                echo "</ul>
                                            </nav>
                                        </div>
                                    </div>
                                    </li>";
                                }
                            }
                        }
                    }

                    mysqli_close($con);
                }
                echo "</ul>
                <ul>
                   <h3>CONTACT US</h3>
                   <div class='contact'>
                        <img src='images/Icon/facebook.png' alt='' width='32'>
                        <img src='images/Icon/twitter.png' alt='' width='32'>
                        <img src='images/Icon/gmail-logo.png' alt='' width='32'>
                        <img src='images/Icon/instagram.png' alt='' width='32'>
                   </div>
                </ul>
            </nav>
        </div>
    </div>";
    }

?>