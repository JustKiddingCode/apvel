<?php
session_start();

// put full path to Smarty.class.php
require 'defines.php';
require 'lib.php';
require_once 'permissions.config.php';
require_once 'smartydef.php'; // init $smarty var


function readDirIntoArray($folder, $endsFilter, & $arr) 
{
    $handle = opendir($folder);
    while (false !== ($entry = readdir($handle))) {
        if (endsWith($entry, $endsFilter)) {
            $arr[] =  $entry;
        }
    }
}

function getPublishedArray($folder, & $arr) 
{
    $tmp = array();
    readDirIntoArray($folder, ".md", $tmp);
    sort($tmp);
    $tmp = array_reverse($tmp);
    $arr = array();
    foreach($tmp as $file) {
        $add = array();
        $add[] = $file;
        if (file_exists($folder . $file . ".html")) {
            $add[] = $file . ".html";
        }
        if (file_exists($folder . $file . ".pdf")) {
            $add[] = $file . ".pdf";
        }
        $arr[] = $add;
    }
}



$smarty->assign('organs', $organs); // include from permissions.config.php


//post/get?
if (isset($_GET['organ']) && checkOrgan($_GET['organ'])){ 
    if (isset($_GET['withdraw'])) {
	    if (checkOrgan($_GET['organ']) and checkAdminPerms($_GET['organ'])) {
		$organ = $_GET['organ'];
		$mdfile = substr($_GET['report'], 0, -5);
		if (checkFileName($mdfile)) {
		    $mdpath = REPORTDIR.SUBPUBLISHED.$_GET['organ']."/" . $mdfile; 
		}
		$htmlpath = $mdpath.".html";
		$pdfpath = $mdpath.".pdf";

		rename($mdpath, REPORTDIR . SUBUNPUBLISHED.  $_GET['organ'] . "/" . $mdfile);
		unlink($htmlpath);
		unlink($pdfpath);

		//write Email:
		$sub = "Protokoll zurueckgezogen : " . $_GET["organ"] . $_GET['report'];
		rlyWriteEmail($emailFrom[$_GET['organ']], 'APVEL', $emailUN[$_GET['organ']], $sub, "Begruendung folgt gleich", array());
    	    }
     } else {
        //show unpublished reports?
        $smarty->assign("read", checkReadPerms($_GET['organ']));
        $smarty->assign("write", checkWritePerms($_GET['organ']));
        $smarty->assign("admin", checkAdminPerms($_GET['organ']));

        //show unpublished reports
        $folderPub = REPORTDIR . SUBPUBLISHED. $_GET['organ'] . '/';
        $folderUnPub = REPORTDIR . SUBUNPUBLISHED. $_GET['organ'] . '/';
        if (! is_dir($folderPub)) { die("Wrong folder structure: " . $folderPub); 
        }
        if (! is_dir($folderUnPub)) { die("Wrong folder structure: " . $folderUnPub); 
        }

        $unpublishedReports = array();
        $publishedReports = array();
        getPublishedArray($folderPub, $publishedReports);
        readDirIntoArray($folderUnPub, ".md", $unpublishedReports);

        sort($unpublishedReports);

   	if(isset($_GET['page'])) {
		$_GET['page'] = (int) $_GET['page'];
	} else {
		$_GET['page'] = 0;
	}
        $smarty->assign('organ', $_GET['organ']);
        $smarty->assign('unPubRep', $unpublishedReports);
	$smarty->assign('page', $_GET['page']);
        $smarty->assign('pubRep', $publishedReports);

    }
}

$smarty->display('index.tpl');



?>
