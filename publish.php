<?php
session_start();

// put full path to Smarty.class.php
require_once 'smartydef.php';
require 'defines.php';
require 'lib.php';

function remove_intern_tags($text){
	return preg_replace(INTERN_REGEX, "", $text);
}


$smarty->assign('this', 'publish.php');

if(isset($_GET['file']) && isset($_GET['organ'])) {
    if (checkOrgan($_GET['organ']) && 
        checkFilename($_GET['file']) &&
	checkAdminPerms($_GET['organ'])
	) {
        $organ = $_GET['organ'];
        $folder = REPORTDIR . SUBUNPUBLISHED . $organ . '/' ;
        $path = $folder.$_GET['file'];
        if (is_file($path)) {
            $text = readFromFile($organ, $_GET['file']);

            //remove [intern][/intern]
            $text = remove_intern_tags($text);

            if (isset($_GET['rly'])) {
                pandocToHTML($path, REPORTDIR . SUBPUBLISHED.  $_GET['organ'] . "/" . $_GET['file'].".html");
                pandocToPDF($path, REPORTDIR . SUBPUBLISHED.  $_GET['organ'] . "/" . $_GET['file'] . ".pdf");
        
	

                //resolution collection
                $conclusions = array();
                preg_match_all(";\[beschluss\](.*?)\[/beschluss\];s", $text, $conclusions);
                foreach($conclusions[0] as $key => $con) {
                    $str = substr($con, 11, -12);
                    file_put_contents(REPORTDIR . SUBPUBLISHED . $_GET['organ'] . ".resolutions.txt", $_GET['file'] . ": ".$str . "\n", FILE_APPEND);
                }

		// remove "[beschluss]" tags
		str_replace("[beschluss]","",$text);
		str_replace("[/beschluss]", "", $text);
		


                file_put_contents($path, $text); //removes intern tags

                //move markdown file
                rename($path, REPORTDIR . SUBPUBLISHED.  $_GET['organ'] . "/" . $_GET['file']);

                //write email
		$text = file_get_contents(REPORTDIR . $_GET['organ'] . ".email") . $text;
		
		$to = $emailPub[$_GET['organ']];
		$from = $emailFrom[_GET['organ']];
		$sub = "Protokoll veröffentlicht: ". $_GET['organ'] . ' ' . $_GET['file'];
		$attach = array(
			REPORTDIR . SUBPUBLISHED . $_GET['organ'] . "/" . $_GET['file'], 
			REPORTDIR . SUBPUBLISHED . $_GET['organ'] . "/" . $_GET['file'] . ".pdf");

		rlyWriteEmail($from,"APVEL",$to,$sub,$text, $attach);
                header('Location: index.php');
                exit();
            } else {
                $tmp = tempnam("cache", $_GET['file']);
                 $filename = explode("/", $tmp);
                $filename = $filename[count($filename) -1];
                pandocToHTML($path, "cache/".$filename.".html");
            }

            $smarty->assign('tmp', $filename);
            $smarty->assign('text', $text);
            $smarty->assign('organ', $_GET['organ']);
            $smarty->assign('file', $_GET['file']);
        }
    }
}


$smarty->display('publish.tpl');

?>
