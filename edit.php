<?php

// put full path to Smarty.class.php
require('smarty3/Smarty.class.php');
require('defines.php');
require('lib.php');


$smarty = new Smarty();

$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/configs');

$handle = opendir(REPORTDIR);


$smarty->assign('groups', $organs);

/*
Writes the text into the unpublished report.
*/
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

//post /get?
if(isset($_GET['file']) && isset($_GET['organ'])){ // read file
  if (checkOrgan($_GET['organ']) && checkFilename($_GET['file'])){ //input validation: get organ
    $text = readFromFile($_GET['organ'], $_GET['file']);
    $smarty->assign('text', $text);
    $smarty->assign('organ', $_GET['organ']);
    $smarty->assign('file', $_GET['file']);
  }
}


if(isset($_POST['text']) and isset($_POST['organ']) and isset($_POST['file'])) { //save changes
  if (checkFilename($_POST['file']) and checkOrgan($_POST['organ']) and checkWritePerms($user, $_POST['organ'])){
    writeIntoFile($_POST['text'], $_POST['organ'], $_POST['file']);
    $smarty->assign('text', $_POST['text']);
    $smarty->assign('organ', $_POST['organ']);
    $smarty->assign('file', $_POST['file']);
  }
}


$smarty->display('edit.tpl');



?>
