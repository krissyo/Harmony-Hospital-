$(document).ready(function(){

/*-- Index Buttons --*/

/* loads the content for the admin tab*/
$("#adminButton").mouseenter(function(){
    $(this).append("<a href='newpatient.php'>New Patient</a><br/>");
});
$("#adminButton").mouseleave(function(){
    $(this).html("<h1>ADMIN</h1>");
});

$("#patientButton").mouseenter(function(){
    $(this).append("<a href='newpatient.php'>New Patient</a><br/>");
});
$("#patientButton").mouseleave(function(){
    $(this).html("<h1>PATIENT</h1>");
});

$("#employmentButton").mouseenter(function(){
    $(this).append("<a href='annualleave.php'>Annual Leave</a><br/>");
    $(this).append("<a href='sickleave.php'>Sick Leave</a><br/>");
});
$("#employmentButton").mouseleave(function(){
    $(this).html("<h1>EMPLOYMENT</h1>");
});

$("#nurseButton").mouseenter(function(){
    $(this).append("<a href='newpatient.php'>Admin New Patient</a><br/>");
    $(this).append("<a href='update_patient_service.php'>Update Patient Details</a><br/>");
    $(this).append("<a href='nursenotes.php'>Nurses Notes</a><br/>");
    $(this).append("<a href='annualleave.php'>Annual Leave</a><br/>");
    $(this).append("<a href='bedmanagement.php'>Bed Management</a><br/>");
});
$("#nurseButton").mouseleave(function(){
    $(this).html("<h1>NURSE</h1>");
});
    
$("#doctorButton").mouseenter(function(){
    $(this).append("<a href='newpatient.php'>Admit New Patient</a><br/>");
    $(this).append("<a href='doctorsnotes.php'>Doctors Notes</a><br/>");
    $(this).append("<a href='bedmanagement.php'>Bed Management</a><br/>");
    $(this).append("<a href='annualleave.php'>Annual Leave</a><br/>");
});
$("#doctorButton").mouseleave(function(){
    $(this).html("<h1>DOCTOR</h1>");
});
     
$("#resourceButton").mouseenter(function(){
    $(this).append("<a href='bedmanagement.php'>Bed Management</a><br/>");
    $(this).append("<a href='resource_availability.php'>Resource Availablity</a><br/>");
    $(this).append("<a href='addresources.php'>Add Resources</a><br/>");
});
$("#resourceButton").mouseleave(function(){
    $(this).html("<h1>RESOURCES</h1>");
});


    

});