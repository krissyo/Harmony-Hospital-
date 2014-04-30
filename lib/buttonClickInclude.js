$(document).ready(function(){

/* loads the content for the admin tab*/
$("#adminButton").click(function(){
	/*alert( "Handler for .click() called." );*/
	$("#contentColumn").load('http://www.trustinblack.com/harmonyhospital/pagecomponents/adminInclude.php');
});

/* loads the content for the doctor tab*/
$("#doctorButton").click(function(){
	/*(alert( "Handler for .click() called." );*/
	$("#contentColumn").load('http://www.trustinblack.com/harmonyhospital/pagecomponents/doctorInclude.php');
});

/* loads the content for the nurses tab*/
$("#nurseButton").click(function(){
	/*(alert( "Handler for .click() called." );*/
	$("#contentColumn").load('http://www.trustinblack.com/harmonyhospital/pagecomponents/nurseInclude.php');
});

});