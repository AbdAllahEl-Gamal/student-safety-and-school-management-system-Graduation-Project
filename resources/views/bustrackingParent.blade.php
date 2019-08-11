<html>
<head>
<?php include 'import/Imports.php'; ?>
<title>Map</title>
<style>
       #map {
        height: 500px;
        width: 800px;
       }
    </style>

</head>
<body background="assets/img/backgrounds/1.jpg">
@include('import/navbarParent')

<center>
  <div id="map"></div>
</center>

<script>
  var markers = {};
	var options = 
	{
		zoom:12,
		center:{lat:31.21454,lng:29.94568}
	}
	
	function initMap() {
	  var map = new google.maps.Map(document.getElementById('map'), options);

	  fetch("{{url('api/bus')}}", {
      'credentials': 'include'
    }).then(function(response) {
      if (response.ok) {
        return response.json();
      }
    }).then(function(body) {
      for (var bus of body.data) {
        body.data.map(function(bus) {
          return {
            id: bus.id,
            line: bus.line,
            driverName: bus.driverName,
            supervisorName: bus.supervisorName,
            supervisorPhone: bus.supervisorPhone,
            coords: {
              lat: bus.lat,
              lng: bus.long
            }
          };
        }).forEach(function(bus) {
          markers[bus.id] = new google.maps.Marker({
						position: new google.maps.LatLng( bus.coords.lat, bus.coords.long ),
						map: map,
						icon: "js/Bus.png"
  			  });
  			  
  			  var infoWindow = new google.maps.InfoWindow({
						content: "Bus Number: "+bus.id+"<br>"+"Bus line: "+bus.line+"<br>"+"Driver name: "+bus.driverName+"<br>"+"Supervisor Name: "+bus.supervisorName+"<br>"+"Supervisor Phone: "+bus.supervisorPhone
				  });
				  
					markers[bus.id].addListener('click', function()
					{
						infoWindow.open(map, markers[bus.id]);
					});
        });
      }
    });
    
    function updateMarkers() {
      fetch("{{url('api/bus')}}", {
        'credentials': 'include'
      }).then(function(response) {
        if (response.ok) {
          return response.json();
        }
      }).then(function(body) {
        for (var bus of body.data) {
          var x = bus.lat;
          var y = bus.long;
          var z = new google.maps.LatLng( x, y );
          markers[bus.id].setPosition(z);
        }
        
        setTimeout(updateMarkers, 2500);
      });
    }
    
    updateMarkers();
	}

  
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmMhaEu6vK5r2QFUMXilBv5N89OPn8f4k&callback=initMap">
</script>
</body>
</html>
