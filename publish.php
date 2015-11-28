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

if(isset($_GET['file']) && isset($_GET['organ'])){
  if (checkOrgan($_GET['organ']) && checkFilename($_GET['file'])) {
    $organ = $_GET['organ'];
    $folder = REPORTDIR . SUBUNPUBLISHED . $organ . '/' ;
    $path = $folder.$_GET['file'];
    if (is_file($path)) {
        $text = readFromFile($organ, $_GET['file']);

	  //remove [intern][/intern]
	  $regex = ";\[intern\](.*?)\[/intern\];s";
	  $text = preg_replace($regex, "", $text);

	  if (isset($_GET['rly'])){
            pandocToHTML($path, $path.".html");
            pandocToPDF($path, $path.".pdf");

	    //move markdown file
	    rename($path, REPORTDIR . SUBPUBLISHED.  $_GET['organ'] . "/" . $_GET['file']);

	    header('Location: index.php');
	    exit();
	  } else {
	    $tmp = tempnam("cache",$_GET['file']);
            $filename = explode("/",$tmp);
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
}

$smarty->display('publish.tpl');

?>
