<?php
    session_start();

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
    <link rel="stylesheet" href="css/branch.css">
    <!-- mapbox -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css' type='text/css' />
    <script src="script/utilities.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
    <script src="script/map.js"></script>
</head>
<body onload="showBranch()">
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
            <h1>EDIT DETAILS</h1>
            <form action="php/add_branch.php" method="POST">
                <div class='container'>
                    <div class="information">
                        <input type="text" name="branch_name" required>
                        <span>Branch Name</span>
                    </div>
                    <div class="information">
                        <input id="addressField" type="text" name="branch_address" required>
                        <span>Branch Address</span>
                        <img src="images/icon/location.png" alt="" width="32" height="32" onclick="viewMap()">
                    </div>
                    <input type="hidden" id="longitude" name="longitude">
                    <input type="hidden" id="latitude" name="latitude">
                    <div class="button">
                        <input type="submit" value="+ ADD BRANCH" name="submit" class = "submit-button">
                    </div>
                </div>
            </form>
            <div class='container'>
                <div class=table-container>
                    <h3>Branch List</h3>
                    <table>
                        <thead>
                            <thead>
                                <th>Branch Name</th>
                                <th>Address</th>
                                <th>Date Added</th>
                            </thead>
                        </thead>
                        <tbody id="tableBody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </main>
    <footer id="footer">
        <div id="footer-wrapper">
            <P>Copyright &copy; 2021 CartMart</P>
        </div>
    </footer>
    <div class="map-wrapper" id="mapWrapper">
        <img src="images/icon/cancel.png" width="32" height="32" alt="" id="closeMap" onclick="closeMap();">
        <div class="map-container">
            <div id="map"></div>
            <pre id="coordinates" class="coordinates"></pre>
        </div>
    </div>
</body>
</html>