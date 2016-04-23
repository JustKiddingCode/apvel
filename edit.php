<?php
session_start();
require 'defines.php';
require 'lib.php';
require_once 'smartydef.php';

$handle = opendir(REPORTDIR);


$smarty->assign('groups', $organs);



//post /get?
if(isset($_GET['file']) && isset($_GET['organ'])) { // read file
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

if(isset($_POST['text']) and isset($_POST['organ']) and isset($_POST['file'])) { //save changes
    if (checkOrgan($_POST['organ']) and checkWritePerms($_POST['organ'])) {
        if(checkFilename($_POST['file']) and checkLock($_SESSION['user'], $_POST['organ'], $_POST['file'])) {
            writeIntoFile($_POST['text'], $_POST['organ'], $_POST['file']);
            $smarty->assign('text', $_POST['text']);
            $smarty->assign('organ', $_POST['organ']);
            $smarty->assign('file', $_POST['file']);
            deleteLock($_POST['organ'], $_POST['file']);
        } else if(checkAdminPerms($_POST['organ'])) {
            if ($_POST['file'] == "template") {
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
            } else if ($_POST['file'] == "resolutions.txt") {
                writeResolutions($_POST['text'], $_POST['organ']);
                $smarty->assign('text', $_POST['text']);
                $smarty->assign('organ', $_POST['organ']);
                $smarty->assign('file', $_POST['file']);
                deleteLock($_POST['organ'], $_POST['file']);    
            }
        } else {
            die('Fehler');
        }
    }
}


$smarty->display('edit.tpl');



?>
