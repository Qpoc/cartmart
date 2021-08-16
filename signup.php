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
    <link rel="stylesheet" href="css/searchbar.css">
    <script src="script/search.js"></script>
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
        <?php
            require_once('php/header.php');
        ?>
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
                            <p>By clicking submit you agree to the our <a href="terms_condition.php">Terms And Conditions</a></p>
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