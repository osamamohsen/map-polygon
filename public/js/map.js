//var map;
var startPoint = {lat: 30.0444, lng: 31.2357};//default start load map in Egypt
var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 5,
    center: startPoint,
    mapTypeId: 'terrain'
});
var points = [startPoint];
var pointsMaker = [];


$( document ).ready(function() {
    getPolygon(); //get all polygons
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
                    //console.log(polygons);

                    var polygons_markers = polygons.split(",");
                    console.log(polygons_markers);
                    //console.log("==");
                    for(var i=0; i< polygons_markers.length; i++){
                        //console.log(polygons_markers[i]);
                        //polygons_markers[i] =  polygons_markers[i].replace('"', '');
                        var polygon_mark = polygons_markers[i].split(" ");
                        //console.log("---");
                        //console.log(polygon_mark[0]);
                        //console.log(polygon_mark[1]);
                        //console.log("---================---");
                        var mark = {lat: parseFloat(polygon_mark[0]) , lng: parseFloat(polygon_mark[1])};
                        //console.log(mark);
                        polygonCoords.push(mark);
                    }

                    console.log(polygonCoords);

                    // Construct the polygon.
                    var bermudaTriangle = new google.maps.Polygon({
                        paths: polygonCoords,
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: '#FF0000',
                        fillOpacity: 0.35
                    });
                    bermudaTriangle.setMap(map);
                }


                //alert(response.polygons[0].wkt);

            },
            error: function (e) {
                console.log(e);
            }
        });
    }
});

// map location center
function mapLocation(point){
    return new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
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
    var point = {lat: event.latLng.lat(), lng: event.latLng.lng()};
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
            data: {points: all_points},
            success: function (response) {
                console.log(response);
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
}
