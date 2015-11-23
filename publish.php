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


if(isset($_GET['file'])){
  if (in_array($_GET['organ'], getOrgans())){ //input validation
    $organ = $_GET['organ'];
    //show unpublished reports
    $folder = REPORTDIR . SUBUNPUBLISHED . $organ . '/' ;
    $handle = opendir($folder);
    while (false !== ($entry = readdir($handle))) {
	if ($entry == $_GET['file']) {
	  $file = fopen($folder.$entry, "r") or die("File error");
	  $text = fread($file, filesize($folder.$entry));
	  fclose($file);

	  //remove [intern][/intern]
	  $regex = ";\[intern\](.*?)\[/intern\];s";
	  $text = preg_replace($regex, "", $text);

	  if (isset($_GET['rly'])){
	    $cmd = "pandoc ". REPORTDIR . SUBUNPUBLISHED.  $_GET['organ'] . "/" . $_GET['file'] . " -f markdown -t html -s -o " . REPORTDIR . SUBPUBLISHED . $_GET['organ'] . "/" . $_GET['file'] . ".html";
	    exec($cmd);
	    $cmd = "pandoc ". REPORTDIR . SUBUNPUBLISHED.  $_GET['organ'] . "/" . $_GET['file'] . " -f markdown -o " . REPORTDIR . SUBPUBLISHED . $_GET['organ'] . "/" . $_GET['file'] . ".pdf";
	    exec($cmd);


	    //move markdown file
	    rename(REPORTDIR . SUBUNPUBLISHED.  $_GET['organ'] . "/" . $_GET['file'], REPORTDIR . SUBPUBLISHED.  $_GET['organ'] . "/" . $_GET['file']);

	    header('Location: index.php');
	    exit();
	  } else {
	    $tmp = tempnam("cache",$_GET['file']); //check this
            $filename = explode("/",$tmp);
	    $filename = $filename[count($filename) -1];
	    $cmd = "pandoc ". REPORTDIR . SUBUNPUBLISHED.  $_GET['organ'] . "/" . $_GET['file'] . " -f markdown -t html -s -o cache/" . $filename . ".html";
	    exec($cmd);
	  }




	  $smarty->assign('tmp', $filename);
	  $smarty->assign('text', $text);
	  $smarty->assign('organ', $organ);
	  $smarty->assign('file', $entry);
        }
    }
  }
}

$smarty->display('publish.tpl');

?>
