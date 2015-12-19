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
  if (checkOrgan($_GET['organ'])) {
    if (checkFilename($_GET['file']) && checkReadPerms($user, $_GET['organ'])){ //input validation: get organ
      $text = readFromFile($_GET['organ'], $_GET['file']);
      $smarty->assign('text', $text);
      $smarty->assign('organ', $_GET['organ']);
      $smarty->assign('file', $_GET['file']);
    } else if ($_GET['file'] == 'template' && checkReadPerms($user, $_GET['organ'])) {
      $smarty->assign('text', readTemplate($_GET['organ']));
      $smarty->assign('organ', $_GET['organ']);
      $smarty->assign('file', $_GET['file']);
    } else if ($_GET['file'] == 'email' && checkReadPerms($user, $_GET['organ'])) {
      $smarty->assign('text', readEmailTemplate($_GET['organ']));
      $smarty->assign('organ', $_GET['organ']);
      $smarty->assign('file', $_GET['file']);    
    }
  } 
}

if(isset($_POST['text']) and isset($_POST['organ']) and isset($_POST['file'])) { //save changes
  if (checkOrgan($_POST['organ']) and checkWritePerms($user, $_POST['organ']) and checkLock($user, $_POST['organ'], $_POST['file'])){
    if(checkFilename($_POST['file'])) {
      writeIntoFile($_POST['text'], $_POST['organ'], $_POST['file']);
      $smarty->assign('text', $_POST['text']);
      $smarty->assign('organ', $_POST['organ']);
      $smarty->assign('file', $_POST['file']);
      deleteLock($_POST['organ'], $_POST['file']);
    } else if ($_POST['file'] == "template") {
      writeTemplate($_POST['text'], $_POST['organ']);
      $smarty->assign('text', $_POST['text']);
      $smarty->assign('organ', $_POST['organ']);
      $smarty->assign('file', $_POST['file']);
      deleteLock($_POST['organ'], $_POST['file']);
    } else if ($_POST['file'] == "email") {
      writeEmailTemplate($_POST['text'], $_POST['organ']);
      $smarty->assign('text', $_POST['text']);
      $smarty->assign('organ', $_POST['organ']);
      $smarty->assign('file', $_POST['file']);
      deleteLock($_POST['organ'], $_POST['file']);    
    }
      
  } else {
    die('Fehler');
  }
}


$smarty->display('edit.tpl');



?>
