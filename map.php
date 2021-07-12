<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Display navigation directions</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 50%;
        }
    </style>
</head>

<body>
    <script
        src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
        type="text/css">


    <script
        src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
        type="text/css">
    <!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
    <script src='https://unpkg.com/@turf/turf@6.3.0/turf.min.js'></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <div id="map"></div>
    <div id="distance" class="distance-container">

    </div>

    <script>

        const successCallback = (position) => {

            mapboxgl.accessToken = 'pk.eyJ1Ijoia3Vwb2MiLCJhIjoiY2txdTlzaWxmMDJrNjJ3dDk2OXkwN3gxNCJ9.S5PnZaGfMfKwlF7OXiht4w';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [position.coords.longitude, position.coords.latitude],
                zoom: 15
            });

            map.on('load', function () {
                var directions = new MapboxDirections({
                    accessToken: mapboxgl.accessToken,
                    unit: "metric",
                    profile: "mapbox/driving",
                    alternatives: false,
                    geometries: "geojson",
                    controls: { instructions: false },
                    flyTo: false
                });
                map.addControl(directions, 'top-left');

                directions.setOrigin([position.coords.longitude, position.coords.latitude]);
                directions.setDestination([121.03541, 14.64222]);
                console.log(directions.getOrigin().geometry.coordinates[0]);

                directions.on('route', function(e) {
                    
                });
                

            });

            var line = turf.lineString([[position.coords.longitude, position.coords.latitude], [121.03541, 14.64222]]);
            var length = turf.length(line, { units: 'miles' });

        };

        const errorCallBack = (error) => {
            console.log(error);
        }

        const watchId = navigator.geolocation.getCurrentPosition(successCallback, errorCallBack, {
            enableHighAccuracy: true,
            timeout: 5000
        });


    </script>

</body>

</html>