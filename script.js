      function getWritePermission(file,organ) {
        var myAjax = new XMLHttpRequest();
	myAjax.onreadystatechange = function() {
	  if (myAjax.readyState == 4) {
	    if (myAjax.status == 200) {
	      Response = myAjax.responseXML.documentElement.firstChild.data;
	      document.getElementById("locktext").innerHTML = Response;
	      document.getElementById("submitbutton").style.visibility = "visible";
	    }
          }
	}
	myAjax.open("GET", "getLock.php?organ=" + organ + "&file=" + file + "&user=justkidding", true);
	myAjax.send();
      }

