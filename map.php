<?php
include_once './func/konfigurasi.php';
?>
<!-- Navigation -->
 <!-- Main -->
 <!-- AIzaSyB2zNkS5ev4MDQLRiTGxXOWJwVtFpwPEbI -->
 
<!DOCTYPE html>
<html>
  <head>
	<style>
      #map-canvas {
        width: 100%;
        height: 500px;
		padding : 10px;
		margin : 0;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2zNkS5ev4MDQLRiTGxXOWJwVtFpwPEbI&callback=initMap"></script>
    <script>
    var marker;
      function initialize() {
		  
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
			center: new google.maps.LatLng(-5.039440,112.132323),
                zoom: 5,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }     
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var infoWindow = new google.maps.InfoWindow;      
        var bounds = new google.maps.LatLngBounds();
 
 
        function bindInfoWindow(marker, map, infoWindow, html) {
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }
 
          function addMarker(lat, lng, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
			var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'; 
            var marker = new google.maps.Marker({
                map: map,
                position: pt,
				icon: image
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
          }
 
          <?php
            $query = mysql_query("select * from tb_propinsi where kd_prop in (11,12,13)");
          while ($data = mysql_fetch_array($query)) {
            $lat = $data['lat'];
            $lon = $data['lng'];
            $nama = $data['nm_prop'];
            echo ("addMarker($lat, $lon, '<b>$nama</b>');\n");                        
          }
          ?>
        }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
   <div class="span10">
		<div class="hero-unit">
			<div id="map-canvas"></div>
		</div>
    </div>

  </body>
</html>