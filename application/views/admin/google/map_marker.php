

 <script src="https://codeigniter.tutsmake.com/public/jquery.js"></script>
 <style>
.container{
  padding: 2%;
  text-align: center;
  } 
 #map_wrapper_div {
  height: 400px;
}
 #map_tuts {
    width: 100%;
    height: 100%;
}
</style>
<div class="container">
  <div class="row">
  <div class="col-12">
      <div id="map_wrapper_div">
    <div id="map_tuts"></div>
   </div>
  </div>
  </div>
</div>

  
<script>
$(function($) {
// Asynchronously Load the map API 
var script = document.createElement('script');
script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyC5RxWgDszUMJRfmfL73wEL2jiVqHOGxbA&callback=initMapsensor=false&callback=initialize";
document.body.appendChild(script);
});
 
function initialize() {
var map;
var bounds = new google.maps.LatLngBounds();
var mapOptions = {
     mapTypeId: 'roadmap'
};
   
// Display a map on the page
map = new google.maps.Map(document.getElementById("map_tuts"), mapOptions);
map.setTilt(45);
 
// Multiple Markers
var markers = JSON.parse(`<?php echo ($markers); ?>`);
console.log(markers);
  
 var infoWindowContent = JSON.parse(`<?php echo ($infowindow); ?>`);       
     
// Display multiple markers on a map
var infoWindow = new google.maps.InfoWindow(), marker, i;
 
// Loop through our array of markers &amp; place each one on the map  
for( i = 0; i < markers.length; i++ ) {
    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
    bounds.extend(position);
    marker = new google.maps.Marker({
        position: position,
        map: map,
        title: markers[i][0]
    });
     
    // Each marker to have an info window    
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            infoWindow.setContent(infoWindowContent[i][0]);
            infoWindow.open(map, marker);
        }
    })(marker, i));
 
    // Automatically center the map fitting all markers on the screen
    map.fitBounds(bounds);
}
 
// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
    this.setZoom(5);
    google.maps.event.removeListener(boundsListener);
});
 
}
</script>
