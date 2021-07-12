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
    <link rel="stylesheet" href="css/profile.css">
    <title>CartMart - My Account</title>
    <script src="script/userSettings.js"></script>
    <script src="script/product.js"></script>
</head>
<?php
    if (isset($_SESSION['sessioncustomerid'])) {
        echo "<body onload =\"loadCartUserInfo('profile')\">";
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
                        <li><a href="cancellation.php">My Cancellations</a></li>
                    </ul>
                </div>
                <div class="navigate">
                    <h3><a href="">Do you want to be a part of us? Let us know :)</a></h3>
                </div>
            </div>
            <div class="main-container">
                <h2>My Profile</h2>
                <div class="information-container">
                    <div class="information">
                        <h4>Profile Picture <sup>1 mb limit</sup></h4>
                        <div class="profile-pic">
                            <img id="profilePic" src="images/user_profile/default.png" onclick="document.getElementById('profileImage').click();"></img>
                            <form method="POST" action="php/user_settings/update_profile.php" enctype="multipart/form-data">
                                <input type="file" name="image" id="profileImage" onchange="showPreviewImage(event)">
                                <input type="submit" value="EDIT CHANGES">
                            </form>
                        </div>
                    </div>
                    <div class="information">
                        <h4>Full Name</h4>
                        <p id="profileName"></p>
                    </div>
                    <div class="information">
                        <h4>Email Address</h4>
                        <p id="addressEmail">cypatungan@gmail.com</p>
                    </div>
                    <div class="information">
                        <h4>Mobile Number</h4>
                        <p id="cellNum">cypatungan@gmail.com</p>
                    </div>
                    <div class="information">
                        <form action="php/user_settings/add_birthday_gender.php" method="POST">
                            <h4>Birthday</h4>
                            <input id="birthday" name="birthday" placeholder="Select your Birthday" class="textbox-n" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" required />
                            <h4>Gender</h4>
                            <select name="gender" id="gender" required>
                                <option value="" selected hidden>Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <div class="btnsubmit">
                                <input type="submit" value="ADD">
                            </div>
                        </form>
                    </div>
                    <div class="information">
                        <div class="button">
                            <input id="editProfile" type="button" value="EDIT PROFILE">
                            <input type="button" value="CHANGE PASSWORD">
                        </div>
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
            <div class="title">
                <h3>Edit Profile</h3>
                <img src="images/Icon/cancel.png" id="close" alt="" width="32">
            </div>
            <form action="php/user_settings/update_user_info.php" method="POST" enctype="application/x-www-form-urlencoded">
                <div class="editInfo">
                    <input type="text" name="editFName" id="editFNameField" required>
                    <span id="editFName">First Name</span>
                </div>
                <div class="editInfo">
                    <input type="text" name="editLName" id="editLNameField" required>
                    <span id="editLName">Last Name</span>
                </div>
                <div class="editInfo">
                    <input type="email" name="editEmail" id="editEmailField" required>
                    <span id="editEmail">Email Address</span>
                </div>
                <div class="editInfo">
                    <input type="text" name="editCellNum" id="editCellNumField" required>
                    <span id="editCellNum">Mobile Number</span>
                </div>
                <div class="button">
                    <input type="submit" value="SUBMIT">
                </div>
            </form>
        </div>
    </div>
<?php
    get_navigation();
?>
<script type="text/javascript">

var edit = document.getElementById('editProfile');
var close = document.getElementById('close');

close.addEventListener("click", function() {
    document.getElementById('description-wrapper').style.display = 'none';
    document.getElementById('main').style.filter = 'blur(0)';
})

edit.addEventListener("click", function() {

    var xhr = new XMLHttpRequest();
    xhr.open('POST','php/user_settings/get_user_info.php', true);

    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                document.getElementById('editFNameField').value = data[0].customerfname;
                document.getElementById('editLNameField').value = data[0].customerlname;
                document.getElementById('editEmailField').value = data[0].emailaddress;
                document.getElementById('editCellNumField').value = data[0].mobilenumber;
            }
        }
    }

    xhr.send();
    
    document.getElementById('description-wrapper').style.display = 'block';
    document.getElementById('main').style.filter = 'blur(2px)';
})


</script>
</body>
</html>