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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?
key=AIzaSyAZq__OhCLFQdWHBjzs9fZaBxKOMxGpoOQ
&sensor=false
&libraries=places"></script>
<div>
    <div  style="text-align: left">
        <input  placeholder="add new area" type="text" id="polygonArea">
        <button onclick="insertPoints()" id="#submit_polygon" type="submit">Add Polygon</button>
    </div>
    <div style="text-align: right">
        <input type="text" size="50" id="mapsearch">
    </div>
    <div id="map"></div>
</div>

</body>
<script type="text/javascript" src="{{ asset('/js/map.js') }}"></script>

</html>