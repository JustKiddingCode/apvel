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


$group = ["-"];
while (false !== ($entry = readdir($handle))) {
	if ($entry != "." and $entry != "..") {
	  if (is_dir(REPORTDIR . $entry)){
	    array_push($group, $entry);
	  }
        }
}
$smarty->assign('groups', $group);




//post /get?


if(isset($_GET['file'])){
  if (in_array($_GET['organ'], $group)){ //input validation
    $organ = $_GET['organ'];
    //show unpublished reports
    $folder = REPORTDIR . $organ . '/' . SUBUNPUBLISHED;
    $handle = opendir($folder);
    while (false !== ($entry = readdir($handle))) {
	if ($entry == $_GET['file']) {
	  $file = fopen($folder.$entry, "r") or die("File error");
	  $text = fread($file, filesize($folder.$entry));
	  fclose($file);
	  $text = str_replace("\n", "\\n", $text);
	  $smarty->assign('text', $text);
        }
    }
    $smarty->assign('unPubRep', $unpublishedReports);

  }
}




$smarty->display('edit.tpl');



?>
