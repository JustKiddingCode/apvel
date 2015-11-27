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

function checkFilename($filename){
    $regex = ',[0-9][0-9][0-9][0-9]-[0-1][0-9]-[0-2][0-9]\.md,';
    return filter_var($filename, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regex)));
}

function checkOrgan($organ) {
    return array_key_exists($organ, getOrgans());
}

function checkWritePerms($user, $organ) {
    return in_array($user, $write[$organ]);
}

function writeIntoFile($text, $organ, $file) {
    $path = REPORTDIR . SUBUNPUBLISHED . $organ . '/' . $file ;
    if (is_file($path)) {
        $file = fopen($folder.$entry, "w") or die("File error");
	fwrite($file, $text);
	fclose($file);
    }
}

/* Read from file */
function readFromFile($organ, $file) {
    $path = REPORTDIR . SUBUNPUBLISHED . $organ . '/' . $file ;
    if (is_file($path)) {
        $file = fopen($path, "r") or die("File error");
	$text = fread($file, filesize($path));
	fclose($file);
    }
}

?>
