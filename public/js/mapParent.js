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
	var busId = [];
	var options = 
	{
		zoom:8,
		center:{lat:31.21454,lng:29.94568}
	}

	var map = new google.maps.Map(document.getElementById('map'), options);
	
<<<<<<< HEAD
 	console.log("{{session('id')}}");
	firestore.collection("parents").doc("{{session('id')}}").get().then(function(doc1) 
	{
		
		doc1.data().children.forEach(function(child){
				
				firestore.collection("students").doc(child.id).get().then(function(querySnapshot) 
				{
					querySnapshot.forEach(function(doc) 
					{
						busId.push(doc.data().busnumber)
						console.log(busId);
/*
=======
	firestore.collection("students").get().then(function(querySnapshot) 
		{
			querySnapshot.forEach(function(doc1) 
			{
				firestore.collection("parents").get().then(function(querySnapshot)
				{
					querySnapshot.forEach(function(doc)
					{
>>>>>>> e1c6c7f9e257f29efa3891e0a9e0ccb5f1a24f72
						var children = [
						{
							Child: ( doc.id, "=>", doc.data().children )
						}
						];
<<<<<<< HEAD
						<?php echo session ('id');?>
						children.forEach(output);

						function output(item, index, array)
						{
							for(prop in item.Child) {
								console.log(prop);
							}
						}*/
					});
				});
			});
	});
=======
				<?php echo session('id');?>
				    
				children.forEach(output);

				function output(item, index, array)
				{
					for(prop in item.Child) 
					{
						console.log(prop);
					}
				}
				
			  });
			  });
		});
		});
>>>>>>> e1c6c7f9e257f29efa3891e0a9e0ccb5f1a24f72
	
	
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