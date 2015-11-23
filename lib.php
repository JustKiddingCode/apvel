<?php
function getOrgans() {
  $groups = ["-"];
  $handle = opendir(REPORTDIR . SUBPUBLISHED);
  while (false !== ($entry = readdir($handle))) {
	  if ($entry != "." and $entry != "..") {
	    if (is_dir(REPORTDIR . SUBPUBLISHED . $entry)){
	      array_push($groups, $entry);
	    }
	  }
  }
  return $groups;
}
?>
