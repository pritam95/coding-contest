
// Update the count down every 1 second
var x = setInterval(function() 
{
  // Find the distance between now an the count down date
  var distance =parseInt(<?php 
    echo $_SESSION[$_COOKIE["user"]."time"];?>)- Math.floor(Date.now() / 1000);;
   //alert( Math.floor(Date.now() / 1000));
  // Time calculations for days, hours, minutes and seconds
  var hours = Math.floor(distance/3600);
 var minutes = Math.floor((distance-hours*3600)/60);
 var seconds = Math.floor(distance-hours*3600-minutes*60);

  // Display the result in the element with id="demo"
  document.getElementById("timer").innerHTML =hours+"h "+minutes+"m "+seconds+"s ";

  // If the count down is finished, write some text 
  if (parseInt(distance) < 0) 
  {
    clearInterval(x);
     document.getElementById("timer").innerHTML="TIMEOUT";
     document.getElementById("logout").submit(); // Submitting form
  }
}, 1000);