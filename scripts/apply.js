/**
 * Author: Le Bao Duy Nguyen 102449993
 * Target: Form Validation 
 * Purpose: This file is to validate the HTML form
 * Created: 25/04/2019
 * Last updated: 03/05/2019
 */

"use strict";

function insert(content){
    var container = "error";
      document.getElementById(container).style.display = "";
      document.getElementById(container).innerHTML = content;
  }
  
  function remove(){
    var  container = "error";
      document.getElementById(container).innerHTML = "";
      document.getElementById(container).style.display = "none";}
function validate(){
    var errMsg = ""; //show error message
    var result = true;
    /** var date = document.getElementById("dob").value;
    var date_format = /^\d\d\/\d\d\/\d\d\d\d$/;
    if(!date.match(date_format))
    {
        errMsg = "Please enter the correct date format!\n";
        result = false;
    }
    else{
       var age = -10;  
       const YEAR_IN_MILISECONDS = 365*24*60*60*1000;
       var now = new Date();
       var dmy = date.split("/");
       var dob = new Date(dmy[2],dmy[1],dmy[0],0,0,0,0);
       age = (now.valueOf() - dob.valueOf())/YEAR_IN_MILISECONDS;
       if(!(age>=15 && age<=80))  //validate required ages
       {
            errMsg = errMsg + "Applicant needs to be between 15 & 80 years of age to apply.\n";
            result = false;
       }
    }

    var postcode = document.getElementById("postcode").value.toString(); 
    var state = document.getElementById("state");
    var state_sel = state.options[state.selectedIndex].value.toString();
    
    switch(state_sel)     //validate state and postcode so they match
    {
        case "VIC": 
                    if((postcode[0] != "3" && postcode[0] != "8")){
                        errMsg = errMsg + "State and postcode must match!\n";
                        result = false;
                    }
                    break;

        case "NSW": 
                    if((postcode[0] != "1" && postcode[0] != "2")){
                        errMsg = errMsg+ "State and postcode must match!\n";
                        result = false;
                    }
                    break;

        case "QLD": 
                    if((postcode[0] != "4" && postcode[0] != "9")){
                        errMsg = errMsg + "State and postcode must match!\n";
                        result = false;
                    }
                    break;

        case "NT": 
                    if(postcode[0] != "0"){
                        errMsg = errMsg + "State and postcode must match!\n";
                        result = false;
                    }
                    break;
        case "WA": 
                    if(postcode[0] != "6"){
                        errMsg = errMsg + "State and postcode must match!\n";
                        result = false;
                    }
                    break;
        case "SA": 
                    if(postcode[0] != "5"){
                        errMsg = errMsg + "State and postcode must match!\n";
                        result = false;
                    }
                    break;
        case "TAS": 
                    if(postode[0] != "7"){
                        errMsg = errMsg + "State and postcode must match!\n";
                        result = false;
                    }
                    break;
        case "ACT": 
                    if(postcode[0] != "0"){
                        errMsg = errMsg + "State and postcode must match!\n";
                        result = false;
                    }
                    break;
       default: errMsg = errMsg + "Please select your state!";
                result = false;
                break;
    }

    var otherskill = document.getElementById("otherskill");
    var otherskilltext = document.getElementById("otherskilltext");
    
    if(otherskill.checked == true && otherskilltext.value == ""){ //validate skill text box
        errMsg = errMsg + "Please do not leave blank if you selected Other!\n";
        result = false;
    }


*/
    if(result == false)
        alert(errMsg);
    else saveDetails();

    return result;
}

function saveJobID(jobID){  //save jobID
    sessionStorage.jobID= jobID;
}

//function setGender(gender){
  //  if(gender == "male")
    //    document.getElementById("male").checked = true;
    //else if(gender == "female")
      //  document.getElementById("female").checked = true;
    //else if(gender == "other")
     //   document.getElementById("other").checked = true;
//}

function getGender(){
    var male = document.getElementById("male");
    var female = document.getElementById("female");
    var other = document.getElementById("other");

    if(male.checked==true)
        return "male";
    else if(female.checked==true)
        return "female";
    else return "other";
}


function saveDetails(){
    sessionStorage.firstname =  document.getElementById("firstname").value;
    sessionStorage.lastname = document.getElementById("lastname").value;
    sessionStorage.dob = document.getElementById("dob").value;
    sessionStorage.gender = getGender();
    sessionStorage.address = document.getElementById("address").value; 
    sessionStorage.suburb = document.getElementById("suburb").value; 
    sessionStorage.postcode = document.getElementById("postcode").value;
    sessionStorage.phone= document.getElementById("phone").value;
    sessionStorage.email = document.getElementById("email").value;
}

function fillForm(){
    if(sessionStorage.jobID!=null){
        var jobRefBox = document.getElementById("jobID");
        jobRefBox.value = sessionStorage.jobID;
        jobRefBox.readOnly = true;
    }
    document.getElementById("firstname").value  = sessionStorage.firstname;
    document.getElementById("lastname").value  = sessionStorage.lastname;
    document.getElementById("dob").value  = sessionStorage.dob;
    setGender(sessionStorage.gender);
    document.getElementById("address").value  = sessionStorage.address;
    document.getElementById("suburb").value = sessionStorage.suburb;
    document.getElementById("postcode").value  = sessionStorage.postcode;
    document.getElementById("phone").value  = sessionStorage.phone;
    document.getElementById("email").value  = sessionStorage.email;
}


function init(){
    if(document.getElementById("jobForm")!=null){
        var applyLink = document.getElementsByClassName("applyLink");
        for(var i=0;i<applyLink.length;i++){
            applyLink[i].onclick = function(){ saveJobID(this.id);}
        }
    }
    else if(document.getElementById("applyForm")!=null){
        var form = document.getElementById("apply");
        fillForm();
        form.onsubmit = validate;
        timer();
    }
    
   
}

window.onload = init;