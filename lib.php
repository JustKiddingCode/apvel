<?php
require_once('permissions.config.php');


function endsWith($haystack,$needle,$case=true) {
        if($case){return (strcmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);}
        return (strcasecmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);
}

function checkFilename($filename){
    $regex = ',[0-9][0-9][0-9][0-9]-[0-1][0-9]-[0-2][0-9]\.md,';
    return filter_var($filename, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regex)));
}

function checkOrgan($organ) {
    global $organs;
    return array_key_exists($organ, $organs);
}

function checkWritePerms($user, $organ) {
    global $write;
    return in_array($user, $write[$organ]);
}
function checkReadPerms($user, $organ) {
    global $read;
    return in_array($user, $read[$organ]);
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

function pandocToHTML($src, $to){
    $cmd = "pandoc ". $src . " -f markdown -t html -s -o " . $to;
    exec($cmd);
}

function pandocToPDF($src, $to){
    $cmd = "pandoc ". $src . " -f markdown -o " . $to . ".pdf";
    exec($cmd);
}


?>
