$(document).ready(function(){

/*-- Index Buttons --*/

/* loads the content for the admin tab*/
$("#adminButton").click(function(){
	/*alert( "Handler for .click() called." );*/
	$("#contentColumn").load('http://www.trustinblack.com/harmonyhospital/pagecomponents/adminInclude.php');
});

$("#patientButton").click(function(){
	/*alert( "Handler for .click() called." );*/
	$("#contentColumn").load('http://www.trustinblack.com/harmonyhospital/pagecomponents/patientInclude.php');
});

/* loads the content for the doctor tab*/
$("#employmentButton").click(function(){
	/*(alert( "Handler for .click() called." );*/
	$("#contentColumn").load('http://www.trustinblack.com/harmonyhospital/pagecomponents/employmentInclude.php');
});

/* loads the content for the nurses tab*/
$("#nurseButton").click(function(){
	/*(alert( "Handler for .click() called." );*/
	$("#contentColumn").load('http://www.trustinblack.com/harmonyhospital/pagecomponents/nurseInclude.php');
});

/* loads the content for the Resources tab*/
$("#resourceButton").click(function(){
	/*(alert( "Handler for .click() called." );*/
	$("#contentColumn").load('http://www.trustinblack.com/harmonyhospital/pagecomponents/resourceInclude.php');
});



});