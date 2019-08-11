  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCiLPQDBGg9Dia618vSoyMkLgod-P16TeM",
    authDomain: "pua-school.firebaseapp.com",
    databaseURL: "https://pua-school.firebaseio.com",
    projectId: "pua-school",
    storageBucket: "pua-school.appspot.com",
    messagingSenderId: "41063227899"
  };
  firebase.initializeApp(config);


// Initialize Cloud Firestore through Firebase
var db = firebase.firestore();
var bus = angular.module("bus", ["firebase"]);

bus.controller("busCtrl", ["$scope",

  function($scope) 
  {

	$scope.businfo = function() 
	{
		db.collection("bus").doc("bus11").set({
		'driver name': $scope.id,
		'location': "12",
		'supervisor': "mona"
		});

		.then(function(docRef) {
		console.log("Document written with ID: ", docRef.id);
		})
		.catch(function(error) {
		console.error("Error adding document: ", error);
		});

	}	
]);

 
