<?php
session_start();

require_once('php/navigation.php');

if (!isset($_SESSION['sessionusername']) && !isset($_SESSION['sessionpassword'])) {
    header("location:login.php");
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

if (isset($_POST['transactionid']) && isset($_POST['email'])) {
    $_SESSION['transactionid'] = $_POST['transactionid'];
    $_SESSION['myrideremail'] = $_POST['email'];
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
    <link rel="stylesheet" href="css/track_order.css">
    <link rel="stylesheet" href="css/searchbar.css">
    <script src="script/search.js"></script>
    <title>CartMart - My Account</title>
    <script src="script/userSettings.js"></script>
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
    <script src="script/map.js"></script>

    <!-- mapbox -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">


    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css">
    <!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
    <script src='https://unpkg.com/@turf/turf@6.3.0/turf.min.js'></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>
<?php
if (isset($_SESSION['sessioncustomerid'])) {
    echo "<body onload =\"onLoadCart()\">";
} else {
    echo "<body>";
}
?>
<header id="header">
    <?php
    require_once('php/header.php');
    ?>
</header>
<main id="main">
    <div id="map"></div>
    <div id="duration" class="duration-container">
        
    </div>
    <div id="distance" class="distance-container">

    </div>
    <div class="status-container">
        <div class="wrapper" id="updateContainer">
            <div class="mycontainer">
                <img id="imgStatus" src="images/Icon/searching.gif" alt="">
            </div>
            <div class="trackText">
                <h3 id="status">Looking for available driver</h3>
            </div>
            <div class="chat">
                <img id="chatRider" src="images/Icon/message.png" alt="Chat your rider" onclick="showChatBox()" width="32" height="32">
            </div>
        </div>
    </div>
</main>
<footer id="footer">
    <div id="footer-wrapper">
        <P>Copyright &copy; 2021 CartMart</P>
    </div>
</footer>
<div class="wrapper-chat" id="chatBox">
    <div class="back">
        <img src="images/Icon/back.png" alt="" onclick="hideChatBox()" width="32" height="32">
    </div>
    <div class="container" id="message-container">
        <div class="customer">
            <p>Welcome to CartMart! Feel Free to contact our driver if you have any concerns</p>
        </div>
    </div>
    <div class="textfield" id="textfieldContainer">
        <textarea name="" id="message"></textarea>
        <img id="sendIcon" src="images/Icon/send.png" alt=''>
    </div>
</div>

<?php
echo "<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoia3Vwb2MiLCJhIjoiY2txdTlzaWxmMDJrNjJ3dDk2OXkwN3gxNCJ9.S5PnZaGfMfKwlF7OXiht4w';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [120.9842, 14.5995],
        zoom: 15
    });
        var count = 0;
        var updateStatus = setInterval(function() {
            var xhr = new XMLHttpRequest();
            var param = 'transactionid=' + '$_SESSION[transactionid]';
            xhr.open('POST','php/product/update_status.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    if(this.responseText != '' && this.responseText != null){
                        var data = JSON.parse(this.responseText);
                        var status = data[0].transactstatus;
                        
                        var sendIcon = document.getElementById('sendIcon');
                        sendIcon.onclick = function(){
                            sendMessage(data[0].transactionID, data[0].email);
                        }

                        var longitude = parseFloat(data[0].custlong);
                        var latitude = parseFloat(data[0].custlat);
                        var deslongitude = parseFloat(data[0].brlong);
                        var deslatitude = parseFloat(data[0].brlat);
                
                        if(status == 'accepted'){
                            if(document.getElementById('imgStatus').src != 'images/Icon/wait.gif'){
                                document.getElementById('imgStatus').src = 'images/Icon/wait.gif';
                            }
                            
                            document.getElementById('map').style.display = 'block';
                            updateLocation(longitude, latitude,deslongitude,deslatitude);
                            updateETA(longitude, latitude,deslongitude,deslatitude);
                            
                            document.getElementById('chatRider').style.display = 'block';
                            document.getElementById('status').innerHTML = 'We found you a driver, please wait for a moment.';
                        }else if (status == 'On the way to mall'){
                            if(document.getElementById('imgStatus').src != 'images/Icon/delivery.gif'){
                                document.getElementById('imgStatus').src = 'images/Icon/delivery.gif';
                            }

                            document.getElementById('map').style.display = 'block';
                            updateLocation(longitude, latitude,deslongitude,deslatitude);
                            updateETA(longitude, latitude,deslongitude,deslatitude);

                            document.getElementById('chatRider').style.display = 'block';  
                            document.getElementById('status').innerHTML = 'Your driver is on the way to the Mall';
                        }else if (status == 'Gathering') {
                            if(document.getElementById('imgStatus').src != 'images/Icon/shopping.gif'){
                                document.getElementById('imgStatus').src = 'images/Icon/shopping.gif';
                            }

                            document.getElementById('map').style.display = 'block';
                            updateLocation(longitude, latitude,deslongitude,deslatitude);
                            updateETA(longitude, latitude,deslongitude,deslatitude);

                            document.getElementById('chatRider').style.display = 'block';
                            document.getElementById('status').innerHTML = 'Gathering your order';
                        }else if (status == 'On the way to your home') {          
                            if(document.getElementById('imgStatus').src != 'images/Icon/housedeliver.gif'){
                                document.getElementById('imgStatus').src = 'images/Icon/housedeliver.gif';
                            }

                            document.getElementById('map').style.display = 'block';
                            updateLocation(longitude, latitude,deslongitude,deslatitude);
                            updateETA(longitude, latitude,deslongitude,deslatitude);

                            document.getElementById('chatRider').style.display = 'block';
                            document.getElementById('status').innerHTML = 'On the way to your home';               
                        }else if (status == 'Delivered') {
                            if(document.getElementById('imgStatus').src != 'images/Icon/delivered.gif'){
                                document.getElementById('imgStatus').src = 'images/Icon/delivered.gif';
                            }

                            document.getElementById('map').style.display = 'none';
                            document.getElementById('distance').style.display = 'none';
                            document.getElementById('duration').style.display = 'none';
                            document.getElementById('chatRider').style.display = 'none';
                            document.getElementById('status').innerHTML = 'Your ordered has been delivered. Enjoy :)';
                        }
                    }
                }
            }

            xhr.send(param);

        }, 3000);
        
        var offset = 0;
        var container = document.getElementById('message-container');
        var id = setInterval(function () {
            retrieveMessage();
        }, 2000)

        function retrieveMessage(){";
if (isset($_SESSION['transactionid'])) {
    echo "var xhr = new XMLHttpRequest();
                var param = 'offset=' + offset + '&transactionid=' + '$_SESSION[transactionid]';
                xhr.open('POST', 'php/retrieve_msg.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status == 200) {
                        if (this.responseText != '' && this.responseText != null) {
                            var data = JSON.parse(this.responseText);
                            var output = \"<div class='customer'>\" +
                                \"<p>\" + data[0].txtmessage + \"</p>\" +
                            \"</div>\";

                            offset += 1;

                            container.scrollTop = container.scrollHeight;

                            document.getElementById('message-container').innerHTML += output;
                        }
                    }
                }

                xhr.send(param);";
}
echo "}
    
    function updateLocation(longitude, latitude, destlongitude, destlatitude){  

        map.on('idle', function () {
            map.resize()
        })
  
        var directions = new MapboxDirections({
            accessToken: mapboxgl.accessToken,
            unit: 'metric',
            alternatives: false,
            geometries: 'geojson',
            controls: {
                instructions: false,
                profileSwitcher: false,
                inputs: false
            },
            flyTo: false
        });
        map.addControl(directions, 'top-left');
        
        directions.setOrigin([longitude, latitude]);
        directions.setDestination([destlongitude, destlatitude]);

        directions.on('route', function(e) {

        });

        directions.on('route', function(e) {
            
            var line = turf.lineString([
                [directions.getOrigin().geometry.coordinates[1], directions.getOrigin().geometry.coordinates[0]],
                [directions.getDestination().geometry.coordinates[1], directions.getDestination().geometry.coordinates[0]]
            ]);

            var length = turf.length(line, {
                units: 'miles'
            });

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://www.mapquestapi.com/geocoding/v1/reverse?key=Gy8tRUNXA9SR9rMIwqecXoAsSjGF2bi6&location=' + directions.getOrigin().geometry.coordinates[1] + ',' + directions.getOrigin().geometry.coordinates[0] + '&includeRoadMetadata=true&includeNearestIntersection=true', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    // alert(this.responseText);
                    var data = JSON.parse(this.responseText);
                    // alert(data.results[0].locations[0].street);
                    // document.getElementById('personaddress').value = data.results[0].locations[0].street
                }
            }
            xhr.send();

            document.getElementById('distance').innerHTML = '<h4>Distance: ' + parseFloat(length * 1.60934).toFixed(2) + ' km</h4>';
        })
    
        
    }

    function updateETA(longitude, latitude, destlongitude, destlatitude){
        var xhr = new XMLHttpRequest();
            
            xhr.open('GET', 'https://us1.locationiq.com/v1/matrix/driving/' + longitude + ',' + latitude + ';' + destlongitude + ',' + destlatitude + '?key=pk.d88d529910dc274215d4880e78558a0e', true);
            xhr.onload = function () {
                if (this.status == 200) {
                    
                    var data = JSON.parse(this.responseText);
                    var durations = 0.0;
                    for (let i = 0; i < data.durations.length; i++) {
                        for (let j = 0; j < data.durations[0].length; j++) {
                            durations += data.durations[i][j];
                        }
                    }
                    document.getElementById('duration').innerHTML = '<h3>ETA: ' + (durations/60).toFixed(0) + ' Minutes<sup><i> (Note: Excluding Gathering of Products)</i></sup></h3>';
                }
            }
            xhr.send();
    }
    </script>";
?>
<?php
get_navigation();
?>
</body>

</html>