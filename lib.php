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
  sort($groups);
  return $groups;
}

function endsWith($haystack,$needle,$case=true) {
        if($case){return (strcmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);}
        return (strcasecmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);
}
?>
