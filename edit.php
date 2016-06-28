<?php
session_start();
require 'defines.php';
require 'lib.php';
require_once 'smartydef.php';

$handle = opendir(REPORTDIR);


$smarty->assign('groups', $organs);
$smarty->assign('this', 'edit.php');


if(isset($_GET['organ']) && checkOrgan($_GET['organ'])){ 
        $smarty->assign("read", checkReadPerms($_GET['organ']));
        $smarty->assign("write", checkWritePerms($_GET['organ']));
        $smarty->assign("admin", checkAdminPerms($_GET['organ']));
}

//post /get?
if(! isset($_POST['text']) && isset($_GET['file']) && isset($_GET['organ'])) { // read file
    if (checkOrgan($_GET['organ'])) {
        if (checkFilename($_GET['file']) && checkReadPerms($_GET['organ'])) { //input validation: get organ
            $text = readFromFile($_GET['organ'], $_GET['file']);
            $smarty->assign('text', $text);
            $smarty->assign('organ', $_GET['organ']);
            $smarty->assign('file', $_GET['file']);
        } else if ($_GET['file'] == 'template' && checkReadPerms($_GET['organ'])) {
            $smarty->assign('text', readTemplate($_GET['organ']));
            $smarty->assign('organ', $_GET['organ']);
            $smarty->assign('file', $_GET['file']);
        } else if ($_GET['file'] == 'email' && checkReadPerms($_GET['organ'])) {
            $smarty->assign('text', readEmailTemplate($_GET['organ']));
            $smarty->assign('organ', $_GET['organ']);
            $smarty->assign('file', $_GET['file']);    
        } else if ($_GET['file'] == 'resolutions.txt' && checkReadPerms($_GET['organ'])) {
            $smarty->assign('text', readResolutions($_GET['organ']));
            $smarty->assign('organ', $_GET['organ']);
            $smarty->assign('file', $_GET['file']);    
        } 
    }
}

if(isset($_POST['text']) and isset($_GET['organ']) and isset($_GET['file'])) { //save changes
    if (checkOrgan($_GET['organ']) and checkWritePerms($_GET['organ'])) {
        if(checkFilename($_GET['file']) and checkLock($_SESSION['user'], $_GET['organ'], $_GET['file'])) {
            writeIntoFile($_POST['text'], $_GET['organ'], $_GET['file']);
            $smarty->assign('text', $_POST['text']);
            $smarty->assign('organ', $_GET['organ']);
            $smarty->assign('file', $_GET['file']);
            deleteLock($_GET['organ'], $_GET['file']);
        } else if(checkAdminPerms($_GET['organ'])) {
            if ($_GET['file'] == "template") {
                writeTemplate($_POST['text'], $_POST['organ']);
                $smarty->assign('text', $_POST['text']);
                $smarty->assign('organ', $_GET['organ']);
                $smarty->assign('file', $_GET['file']);
                deleteLock($_GET['organ'], $_GET['file']);
            } else if ($_GET['file'] == "email") {
                writeEmailTemplate($_POST['text'], $_GET['organ']);
                $smarty->assign('text', $_POST['text']);
                $smarty->assign('organ', $_GET['organ']);
                $smarty->assign('file', $_GET['file']);
                deleteLock($_GET['organ'], $_GET['file']);    
            } else if ($_GET['file'] == "resolutions.txt") {
                writeResolutions($_POST['text'], $_GET['organ']);
                $smarty->assign('text', $_POST['text']);
                $smarty->assign('organ', $_GET['organ']);
                $smarty->assign('file', $_GET['file']);
                deleteLock($_GET['organ'], $_GET['file']);    
            }
        } else {
            die('Fehler');
        }
    }
}


$smarty->display('edit.tpl');



?>
