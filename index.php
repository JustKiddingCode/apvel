<?php

// put full path to Smarty.class.php
require('smarty3/Smarty.class.php');
require('defines.php');

$smarty = new Smarty();


$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/configs');

$handle = opendir(REPORTDIR);

//Get groups (fsk, aera, ...)
$group = ["-"];
while (false !== ($entry = readdir($handle))) {
	if ($entry != "." and $entry != "..") {
	  if (is_dir(REPORTDIR . $entry)){
	    array_push($group, $entry);
	  }
        }
}
$smarty->assign('groups', $group);


//post/get?

if(isset($_POST['group'])){
  if (in_array($_POST['group'], $group)){ //input validation
    $searchGroup = $_POST['group'];
    //show unpublished reports
    $folder = REPORTDIR . $searchGroup . '/' . SUBUNPUBLISHED;
    $handle = opendir($folder);
    $unpublishedReports = [];
    while (false !== ($entry = readdir($handle))) {
	if ($entry != "." and $entry != "..") {
	  if (is_file($folder.$entry)){
	    array_push($unpublishedReports, $entry);
	  }
        }
    }
    $folder = REPORTDIR . $searchGroup . '/' . SUBPUBLISHED;
    $handle = opendir($folder);
    $publishedReports = [];
    while (false !== ($entry = readdir($handle))) {
	if ($entry != "." and $entry != "..") {
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


if (false){
	    $cmd = "pandoc $folder$entry -f markdown -t html -s -o test.html";
	    exec($cmd);

}

$smarty->display('index.tpl');



?>
