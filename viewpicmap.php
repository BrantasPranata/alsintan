<html>
<head>
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2zNkS5ev4MDQLRiTGxXOWJwVtFpwPEbI&callback=initMap">
</script>
<script>
var myCenter=new google.maps.LatLng(<?php echo $_GET['lat'];?>,<?php echo $_GET['long'];?>);
var marker;
function initialize()
{
	var mapProp = {
	  center:myCenter,
	  zoom:16,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };
	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	marker=new google.maps.Marker({
	  position:myCenter,
	  animation:google.maps.Animation.BOUNCE
	  });
	marker.setMap(map);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

</head>
<body>
<table style="width:500px;height:500px;">
<tr><td align=center>
<h3>
Foto dan Lokasi Rencana Panen
</h3></td>
</tr>
<tr><td align=center>
<br>
<img src="<?php echo $_GET['foto'];?>" alt="Foto lokasi panen" style="width:500px;height:500px;">
<br></td>
</tr>
<tr><td align=center>
<div id="googleMap" style="width:500px;height:380px;"></div>
</td>
</tr>
</table>
</body>
</html>