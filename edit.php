<?php

// put full path to Smarty.class.php
require('smarty3/Smarty.class.php');
require('defines.php');
require('lib.php');


$user = "justkidding";

$smarty = new Smarty();

$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/configs');

$handle = opendir(REPORTDIR);


$smarty->assign('groups', $organs);

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
  if (checkFilename($_POST['file']) and checkOrgan($_POST['organ']) and checkWritePerms($user, $_POST['organ']) and checkLock($user, $_POST['organ'], $_POST['file'])){
    writeIntoFile($_POST['text'], $_POST['organ'], $_POST['file']);
    $smarty->assign('text', $_POST['text']);
    $smarty->assign('organ', $_POST['organ']);
    $smarty->assign('file', $_POST['file']);
  } else {
    die('Fehler');
  }
}


$smarty->display('edit.tpl');



?>
