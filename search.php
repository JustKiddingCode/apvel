<?php
require('lib.php');
require('defines.php');
require('smarty3/Smarty.class.php');


$smarty = new Smarty();


$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/configs');


$dir = REPORTDIR . SUBPUBLISHED;
if (isset($_POST['search'])) {
  $smarty->assign('result', exec("grep -rn --include=*.md " . escapeshellarg($_POST['search']) . " ". $dir));
  
  
}

$smarty->display('search.tpl');
?>