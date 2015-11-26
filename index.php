<?php

// put full path to Smarty.class.php
require('smarty3/Smarty.class.php');
require('defines.php');
require('lib.php');
require('permissions.config.php');

$smarty = new Smarty();


$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/configs');



$organs = $organs;
$smarty->assign('organs', $organs);


//TODO: Real Authentification
$user = "justkidding";
$smarty->assign("user", $user);




//post/get?
if (isset($_POST['withdraw'])){
  if (array_key_exists($_POST['organ'], $organs)){ //input validation
    $organ = $_POST['organ'];
    if(in_array($user, $write[$organ])) { // permission check
      $_POST['report']; // should be YYYY-MM-DD.md.html
      $regex = ',[0-9][0-9][0-9][0-9]-[0-1][0-9]-[0-2][0-9]\.md\.html,';
      if (filter_var($_POST['report'], FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regex)))) {
        $parts = explode(".", $_POST['report']);
	$mdfile = REPORTDIR.SUBPUBLISHED.$organ."/".$parts[0].".".$parts[1];
	$htmlfile = $mdfile.".html";
	$pdffile = $mdfile.".pdf";

	rename($mdfile, REPORTDIR . SUBUNPUBLISHED.  $organ . "/" . $parts[0].".".$parts[1]);
	unlink($htmlfile);
	unlink($pdffile);
      }
    }
  }
}
if(isset($_POST['organ'])){
  if (array_key_exists($_POST['organ'], $organs)){ //input validation
    //show unpublished reports?
    $searchGroup = $_POST['organ'];
    $smarty->assign("showUnpublishedReports", in_array($user, $read[$searchGroup]));
    $smarty->assign("writeOnOrgan", $write[$searchGroup]);


    //show unpublished reports
    $folder = REPORTDIR . SUBUNPUBLISHED. $searchGroup . '/';
    if (! is_dir($folder)) die("Wrong folder structure: " . $folder);
    $handle = opendir($folder);
    $unpublishedReports = [];
    while (false !== ($entry = readdir($handle))) {
	if ($entry != "." and $entry != ".." and endsWith($entry, ".md")) {
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
    $smarty->assign('currentOrganR', $read[$searchGroup]);

    $smarty->assign('unPubRep', $unpublishedReports);
    $smarty->assign('pubRep', $publishedReports);

  }
}

$smarty->display('index.tpl');



?>
