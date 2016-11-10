var sec = 0;
var min = 0;
var hour = 0;

function stopwatch(swState) {

  if (swState == "start") { 
      document.getElementById('startStop').innerHTML = "Pause Interview"; 
      document.getElementById('startStop').value = "stop";  
  } else if (swState == "stop") { 
      document.getElementById ('startStop').innerHTML = "Start Interview";
      document.getElementById('startStop').value = "start";  
  }

  if (document.getElementById('startStop').value == "start") {
      window.clearTimeout(tout);
      return true;
  }

  sec++;

  if (sec == 60) {
   sec = 0;
   min = min + 1; }
  else {
   min = min; }
  if (min == 60) {
   min = 0; 
   hour += 1; }

  if (sec<=9) { 
        sec = "0" + sec; 
      }
   
  document.getElementById('swOutput').value = ((hour<=9) ? "0"+hour : hour) + " : " + ((min<=9) ? "0" + min : min) + " : " + sec;

  tout = window.setTimeout("stopwatch()", 1000);

}


function resetSW() {
  sec = -1;
  min = 0;
  hour = 0;
  if (document.getElementById ('startStop').value == "stop") {
  document.getElementById ('startStop').value = "start";
  document.getElementById ('startStop').innerHTML = "Start Interview";
   }
  document.getElementById('swOutput').value = "00 : 00 : 00";
  window.clearTimeout(tout);
 }