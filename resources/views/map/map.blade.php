<!DOCTYPE html>
<html>
<head>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
<h1>Google Map</h1>
<h3>My Google Maps Demo</h3>
<script type="text/javascript" src="{{ asset('/js/library/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/library/maps.js') }}?key=AIzaSyAZq__OhCLFQdWHBjzs9fZaBxKOMxGpoOQ&sensor=false"></script>
<button onclick="insertPoints()" id="#submit_polygon" type="submit">Add Polygon</button>
<div id="map"></div>
</body>
<script type="text/javascript" src="{{ asset('/js/map.js') }}"></script>

</html>