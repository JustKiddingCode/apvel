<?php
$fskIntern = array("justkidding");

$organs = array("fsk" => "Fachschaftenkonferenz",
		"stupa" => "Studierenparlament",
		"fsmi-fsr" => "FSMI Fachschaftsrat");


$read = array("fsk" => $fskIntern, "stupa" => array());

$write = array("fsk" => $fskIntern);

$emailUN = array("fsk" => array("info@konstantinzangerle.de"));
$emailPub = array("fsk" => array("info@konstantinzangerle.de"));

function checkWritePerms($user, $organ) {
    global $write;
    if ($organ == "fsk") {
      if (strpos($_SESSION['groups'],$organ)) {
        return true;
      }
    }
    return false;
}
function checkReadPerms($user, $organ) {
    global $read;
    
    if ($organ == "fsk") {
      if (strpos($_SESSION['groups'],$organ) || strpos($_SESSION['groups'],"stupa")) {
        return true;
      }
    }
    return in_array($user, $read[$organ]);
}

?>
