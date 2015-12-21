<?php
session_start();

// put full path to Smarty.class.php
require('smarty3/Smarty.class.php');
require('defines.php');
require('lib.php');
require_once('permissions.config.php');

$smarty = new Smarty();


$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/configs');



$organs = $organs;
$smarty->assign('organs', $organs);

if (isset($_SESSION['user']) ) {
 $user = $_SESSION['user'];
}

$smarty->assign("user", $user);


//post/get?
if (isset($_POST['withdraw']) && isset($_POST['organ'])){
  if (checkOrgan($_POST['organ']) and checkWritePerms($_POST['organ'])) {
    $organ = $_POST['organ'];
    $mdfile = substr($_POST['report'], 0, -5);
    if (checkFileName($mdfile))
	$mdpath = REPORTDIR.SUBPUBLISHED.$_POST['organ']."/" . $mdfile;
	$htmlpath = $mdpath.".html";
	$pdfpath = $mdpath.".pdf";

	rename($mdpath, REPORTDIR . SUBUNPUBLISHED.  $_POST['organ'] . "/" . $mdfile);
	unlink($htmlpath);
	unlink($pdfpath);

	//write Email:
	$sub = "Protokoll zurueckgezogen : " . $_POST["organ"] . $_POST['report'];
	rlyWriteEmail('test@test.com', 'APVEL', $emailUN[$_POST['organ']], $sub,"Begruendung folgt gleich" ,array());
  }
}

function readDirIntoArray($folder, $endsFilter, & $arr) {
    $handle = opendir($folder);
    $arr = [];
    while (false !== ($entry = readdir($handle))) {
	if (endsWith($entry, $endsFilter)) {
	    array_push($arr, $entry);
        }
    }
}
if(isset($_POST['organ'])){
  if (checkOrgan($_POST['organ'])){ //input validation

    //show unpublished reports?
    $searchGroup = $_POST['organ'];
    $smarty->assign("read", checkReadPerms($_POST['organ']));
    $smarty->assign("write", checkWritePerms($_POST['organ']));
    $smarty->assign("admin", checkAdminPerms($_POST['organ']));

    //show unpublished reports
    $folderPub = REPORTDIR . SUBPUBLISHED. $_POST['organ'] . '/';
    $folderUnPub = REPORTDIR . SUBUNPUBLISHED. $_POST['organ'] . '/';
    if (! is_dir($folderPub)) die("Wrong folder structure: " . $folderPub);
    if (! is_dir($folderUnPub)) die("Wrong folder structure: " . $folderUnPub);

    $unpublishedReports = [];
    readDirIntoArray($folderPub, ".md.html", $publishedReports);
    readDirIntoArray($folderUnPub, ".md", $unpublishedReports);

    sort($unpublishedReports);
    sort($publishedReports);
    
    $smarty->assign('organ', $searchGroup);
    $smarty->assign('unPubRep', $unpublishedReports);
    $smarty->assign('pubRep', $publishedReports);

  }
}

$smarty->display('index.tpl');



?>
