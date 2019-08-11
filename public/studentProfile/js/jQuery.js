var config = {
	apiKey: "AIzaSyCiLPQDBGg9Dia618vSoyMkLgod-P16TeM",
	authDomain: "pua-school.firebaseapp.com",
	databaseURL: "https://pua-school.firebaseio.com",
	projectId: "pua-school",
	storageBucket: "pua-school.appspot.com",
	messagingSenderId: "41063227899"
};
firebase.initializeApp(config);

var firestore = firebase.firestore();

$("#Empform").submit(function() 
{
	   var EmpName = $("#Empname").val();
	   var EmpPos = $("#Emppos").val();
	   var EmpPn = $("#Emppn").val();
	   var EmpEmail = $("#Empemail").val();
	   var EmpPass = $("#Emppass").val();
       firestore.collection("employees").doc(EmpPn).set({
       name: EmpName,
	   position: EmpPos,
	   email: EmpEmail,
	   password: EmpPass
       });
	   });
	   
$("#Parform").submit(function() 
{
	   var ParName = $("#Parname").val();
	   var ParPn = $("#Parpn").val();
	   var ParEmail = $("#Paremail").val();
	   var ParPass = $("#Parpass").val();
       firestore.collection("parents").doc(ParPn).set({
       name: ParName,
	   email: ParEmail,
	   password: ParPass
       });
	   });

$("#Stuform").submit(function() 
{
	   var StufName = $("#Stufname").val();
	   var StuName = $("#Stuname").val();
	   var StuParPn = $("#Stuparpn").val();
	   var StuClass = $("#Stuclass").val();
	   var StuBusSup = $("#Stubussup").val();
       firestore.collection("students").doc(StufName+StuParPn).set({
	   name: StuName,
	   class: StuClass,
	   bussupervisor: StuBusSup
       });
	   firestore.collection("parents").doc(StuParPn).collection("children").doc(StufName+StuParPn).set({
	   name: StuName,
	   class: StuClass
       });
	   });