<?php

$organs = array("fsk" => "Fachschaftenkonferenz",
		"stupa" => "Studierenparlament",
		"fsmi-fsr" => "FSMI Fachschaftsrat");


$emailUN = array("fsk" => array("test@test.com"));
$emailPub = array("fsk" => array("test@test.com"));

function checkAdminPerms($organ) {
    if ($organ == "fsk") {
      if (in_array("fsk-praesidium", $_SESSION['groups'])) { 
	    return true;
      }
    }	    
    return false;
}

// you get the idea
function checkWritePerms($organ) {

    return false;
}
function checkReadPerms($organ) {
    return false;
}

?>
