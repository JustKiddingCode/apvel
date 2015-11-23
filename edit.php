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


$group = getOrgans();
$smarty->assign('groups', $group);




//post /get?
if(isset($_GET['file'])){
  if (in_array($_GET['organ'], $group)){ //input validation
    $organ = $_GET['organ'];
    //show unpublished reports
    $folder = REPORTDIR . SUBUNPUBLISHED . $organ . '/' ;
    $handle = opendir($folder);
    while (false !== ($entry = readdir($handle))) {
	if ($entry == $_GET['file']) {
	  $file = fopen($folder.$entry, "r") or die("File error");
	  $text = fread($file, filesize($folder.$entry));
	  fclose($file);
	  $smarty->assign('text', $text);


	  $smarty->assign('organ', $organ);
	  $smarty->assign('file', $_GET['file']);
        }
    }

  }
}

if(isset($_POST['text'])) { //save changes
  if (in_array($_POST['organ'], $group)){ //input validation
    $organ = $_POST['organ'];
        //show unpublished reports
    $folder = REPORTDIR . SUBUNPUBLISHED . $organ . '/' ;
    $handle = opendir($folder);
    while (false !== ($entry = readdir($handle))) {
	if ($entry == $_POST['file']) {
	  $file = fopen($folder.$entry, "w") or die("File error");
	  fclose($file);
	  $smarty->assign('text', $_POST['text']);
	  $smarty->assign('organ', $organ);
	  $smarty->assign('file', $_POST['file']);
        }
    }

  }
}


$smarty->display('edit.tpl');



?>
