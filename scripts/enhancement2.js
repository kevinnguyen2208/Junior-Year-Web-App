//function timer(){
  //  time=5;
    //var x =setInterval(function(){
      //var minutes= Math.floor(time/60);
      //var seconds=Math.floor(time%60);
      //document.getElementById("applyit").innerHTML= "Time left : " + minutes +":" + seconds ;
      //if(time<0){
        //  clearInterval(x);
          //document.getElementById("applyit").innerHTML= "Please Try Again!";
          //document.getElementById("submit").hidden=true;
          //alert("The session has exired, please reload the page to try again!")
      //}
      //time= time -1;
    //}
    //,1000);
//}

//var myVar;
//function myFunction() {
  //  myVar = setTimeout(showPage, 2000);
//}
function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}

