//var map;
var startPoint = {lat: 30.0444, lng: 31.2357};//default start load map in Egypt
var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 5,
    center: startPoint,
    mapTypeId: 'terrain'
});
var points = [startPoint];
var pointsMaker = [];
var bermudaTriangle,infowindow,place,bounds,places;


$( document ).ready(function() {
    var mapsearch = new google.maps.places.SearchBox(document.getElementById('mapsearch'));
    //add places_changed for search
    google.maps.event.addListener(mapsearch,'places_changed',function(){
        console.log("enter");
        places = mapsearch.getPlaces();
        bounds  = new google.maps.LatLngBounds();
        for(var i=0 ; place = places[i] ; i++){
            bounds.extend(place.geometry.location);
            //bounds.setPosition(place.geometry.location);
        }
        map.fitBounds(bounds);
        map.setZoom(10);
    });
    getPolygon(); //get all polygons for loading
    function getPolygon() {
        $.ajax({
            url: '/map/polygons',
            type: "POST",
            data: {},
            success: function (response) {
                for(var j=0; j< response.polygons.length; j++){
                    var polygonCoords = [];
                    var polygons = response.polygons[j].wkt;
                    polygons = polygons.replace("POLYGON((", "");
                    polygons = polygons.replace("))", "");

                    var polygons_markers = polygons.split(",");
                    //console.log(polygons_markers);
                    for(var i=0; i< polygons_markers.length; i++){

                        var polygon_mark = polygons_markers[i].split(" ");

                        var mark = {lat: parseFloat(polygon_mark[1]) , lng: parseFloat(polygon_mark[0])};

                        polygonCoords.push(mark);
                    }

                    bermudaTriangle = new google.maps.Polygon({
                        paths: polygonCoords,
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: '#'+(Math.random()*0xFFFFFF<<0).toString(16),
                        fillOpacity: 0.35,
                        indexID: "My Title Text"+j
                    });
                    bermudaTriangle.setMap(map);

                    //google.maps.event.addListener(bermudaTriangle,'click', function(event) {
                    //    //alert(bermudaTriangle.indexID);
                    //    infowindow = new google.maps.InfoWindow({
                    //        content: "my Dream"
                    //    });
                    //    infowindow.content = bermudaTriangle.indexID;
                    //    infowindow.setPosition(event.latLng);
                    //    infowindow.open(map);
                    //    setTimeout(function () { infowindow.close(); }, 5000);
                    //});

                }//end j for loop
            },//end success
            error: function (e) {
                console.log(e);
            }
        });
    }
});

// map location center
function mapLocation(point){
    return new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: point
    });
}

//draw position
for(var i=0;i<points.length ;i++){
    map = mapLocation(points[i]);
}

//add marker once click on map
google.maps.event.addListener(map, 'click', function(event) {
    //console.log("lat: " + event.latLng.lat() + ", lng: "+event.latLng.lng());
    var point = {lng: event.latLng.lat(), lat: event.latLng.lng()};
    pointsMaker.push(point);
    placeMarker(event.latLng);
});

//draw mark with long , lat
function placeMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
}
// add polygon click event
function insertPoints(){
    var polygonArea = $('#polygonArea').val();
    if(pointsMaker.length > 2){
        pointsMaker.push(pointsMaker[0]);
        var all_points = 'POLYGON((' + pointsMaker[0].lat + ' ' + pointsMaker[0].lng;
        for (var i = 1, len = pointsMaker.length; i < len; i++) {
            all_points += ','+pointsMaker[i].lat+' '+pointsMaker[i].lng
        }
        all_points += '))';
        console.log(all_points);
        $.ajax({
            url: 'map/zone/store',
            type: "POST",
            data: {polygon: all_points,area: polygonArea},
            success: function (response) {
                console.log(response);
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
}
