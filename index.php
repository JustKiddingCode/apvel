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



$groups = getOrgans();
$smarty->assign('groups', $groups);


//post/get?

if(isset($_POST['group'])){
  if (in_array($_POST['group'], $groups)){ //input validation
    $searchGroup = $_POST['group'];
    //show unpublished reports
    $folder = REPORTDIR . SUBUNPUBLISHED. $searchGroup . '/';
    if (! is_dir($folder)) die("Wrong folder structure: " . $folder);
    $handle = opendir($folder);
    $unpublishedReports = [];
    while (false !== ($entry = readdir($handle))) {
	if ($entry != "." and $entry != ".." ) {
	  if (is_file($folder.$entry)){
	    array_push($unpublishedReports, $entry);
	  }
        }
    }
    $folder = REPORTDIR . SUBPUBLISHED . $searchGroup . '/' ;
    $handle = opendir($folder);
    $publishedReports = [];
    while (false !== ($entry = readdir($handle))) {
	if ($entry != "." and $entry != ".."  and endsWith($entry, ".md.html")) {
	  if (is_file($folder.$entry)){
	    array_push($publishedReports, $entry);
	  }
        }
    }
    $smarty->assign('organ', $searchGroup);
    $smarty->assign('unPubRep', $unpublishedReports);
    $smarty->assign('pubRep', $publishedReports);

  }
}

$smarty->display('index.tpl');



?>
