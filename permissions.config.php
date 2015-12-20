<?php
$fskIntern = array("justkidding");

$organs = array("fsk" => "Fachschaftenkonferenz",
		"stupa" => "Studierenparlament",
		"fsmi-fsr" => "FSMI Fachschaftsrat");


$emailUN = array("fsk" => array("info@konstantinzangerle.de"));
$emailPub = array("fsk" => array("info@konstantinzangerle.de"));

function checkWritePerms($organ) {
    if ($organ == "fsk") {
      if (strpos($_SESSION['groups'],$organ)) {
        return true;
      }
    }
    return false;
}
function checkReadPerms($organ) {
    if ($organ == "fsk") {
      if (strpos($_SESSION['groups'],$organ) || strpos($_SESSION['groups'],"stupa")) {
        return true;
      }
    }
    return false;
}

?>
