var timer;

      function refreshWritePermission(file,organ){
	getWritePermission(file,organ);
	document.getElementById("publish").style.visibility = "hidden";
	document.getElementById("sendmailbutton").style.visibility = "hidden";
	timer = setInterval(function() { getWritePermission(file,organ) },180000);
      }

      function getWritePermission(file,organ) {
        var myAjax = new XMLHttpRequest();
	myAjax.onreadystatechange = function() {
	  if (myAjax.readyState == 4) {
	    if (myAjax.status == 200) {
	      Response = myAjax.responseXML.documentElement.firstChild.data;
	      if(Response == "Another user is editing this file") {
		window.alert(Response);
	      }
	      document.getElementById("locktext").innerHTML = Response + " will refresh automatically";
	      document.getElementById("submitbutton").style.visibility = "visible";
	    }
          }
	}
	myAjax.open("GET", "getLock.php?organ=" + organ + "&file=" + file, true);
	myAjax.send();
      }

