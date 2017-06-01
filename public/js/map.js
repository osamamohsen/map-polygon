var map;
var startPoint = {lat: 30.0444, lng: 31.2357};
var points = [startPoint];
var pointsMaker = [];
//draw position
for(var i=0;i<points.length ;i++){
    map = mapLocation(points[i]);
}

//draw marker
if(points.length > 1){
    for(var i=0;i<points.length ;i++) {
        new google.maps.Marker({
            position: points[i],
            map: map
        });
    }
}

//add click listener map
google.maps.event.addListener(map, 'click', function(event) {
    console.log("lat: " + event.latLng.lat() + ", lng: "+event.latLng.lng());
    var point = {lat: event.latLng.lat(), lng: event.latLng.lng()};
    pointsMaker.push(point);
    placeMarker(event.latLng);
});

//draw mark
function placeMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
}

// map location center
function mapLocation(point){
    return new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: point
    });
}

function insertPoints(){
    if(pointsMaker.length > 2){
        //pointsMaker.push(pointsMaker[0]);
        $.ajax({
            url: 'map/zone/store',
            type: "POST",
            data: {points: pointsMaker},
            success: function (response) {
                console.log(response);
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
}