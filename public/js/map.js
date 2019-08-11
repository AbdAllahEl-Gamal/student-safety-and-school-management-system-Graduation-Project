var config = {
	apiKey: "AIzaSyCiLPQDBGg9Dia618vSoyMkLgod-P16TeM",
	authDomain: "pua-school.firebaseapp.com",
	databaseURL: "https://pua-school.firebaseio.com",
	projectId: "pua-school"
};
firebase.initializeApp(config);
var firestore = firebase.firestore();

function initMap()
{

	var marker = [];
	var options = 
	{
		zoom:8,
		center:{lat:31.21454,lng:29.94568}
	}

	var map = new google.maps.Map(document.getElementById('map'), options);

	firestore.collection("bus").get().then(function(querySnapshot) 
		{
			var j=0;
			querySnapshot.forEach(function(doc) 
			{

				var markers = [
				{
					coords:{lat:(doc.id, "=>", doc.data().lat),lng:(doc.id, "=>", doc.data().long)},
					content:(doc.id, "=>", doc.id)
				}
				];

				for(var i = 0;i < markers.length;i++)
				{
					addMarker(markers[i],j);
				}

				function addMarker(props,k)
				{
						marker[k] = new google.maps.Marker({
						position:props.coords,
						map:map,
						icon: "js/Bus.png"
					});

					if(props.content)
					{
						var infoWindow = new google.maps.InfoWindow({
							content:props.content
						});
						marker[k].addListener('click', function()
						{
							infoWindow.open(map, marker[k]);
						});
					}
				}
				j++;
			});
		});

	setInterval(function()
	{
		firestore.collection("bus").get().then(function(querySnapshot) 
		{
			var q=0;
			querySnapshot.forEach(function(doc) 
			{
				var markers = [
				{
					coords:{lat:(doc.id, "=>", doc.data().lat),lng:(doc.id, "=>", doc.data().long)},
					content:(doc.id, "=>", doc.id)
				}
				];

				for(var i = 0;i < markers.length;i++)
				{
					addMarker(markers[i],q);
				}

				function addMarker(props,w)
				{
					marker[w].setPosition(props.coords);
				}
				q++;
			});
		});
		
	}, 5000);
}