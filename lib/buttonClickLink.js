$(document).ready(function(){

/* ----------Index.php Linking Buttons ----------*/

/* //// employment links //// */
$("#annualLeaveButton").click(function(){
	window.open('http://www.trustinblack.com/harmonyhospital/annualleave.php');
});

$("#sickLeaveButton").click(function(){
	window.open('http://www.trustinblack.com/harmonyhospital/sickleave.php');
});

/* //// Patient links //// */
$("#admitNewPatientButton").click(function(){
	window.open('http://www.trustinblack.com/harmonyhospital/newpatient.php');
});

$("#searchPatientButton").click(function(){
	window.open('http://www.trustinblack.com/harmonyhospital/search.php');
});

/* //// Resource Links //// */
$("#bedMgmntButton").click(function(){
	window.open('http://www.trustinblack.com/harmonyhospital/bedmanagement.php');
});

$("#resourceAvailButton").click(function(){
	window.open('http://www.trustinblack.com/harmonyhospital/resources_availability.php');
});

$("#addResournceButton").click(function(){
	window.open('http://www.trustinblack.com/harmonyhospital/addresources.php');
});


/* ---------- Bedmanagement.php Buttons ----------*/

/* //// links to resource availability form //// */
$("#resourcesAvailButton").click(function(){
	window.location='http://www.trustinblack.com/harmonyhospital/resource_availability.php';
});

/* //// links to add resource form //// */
$("#resourcesAddButton").click(function(){
	window.location='http://www.trustinblack.com/harmonyhospital/addresources.php';
});

});




