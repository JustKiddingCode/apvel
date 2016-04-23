<?php
session_start();

require_once('smartydef.php');

require 'lib.php';
require 'defines.php';



$dir = REPORTDIR . SUBPUBLISHED;
if (isset($_POST['search'])) {
    $smarty->assign('result', exec("grep -rn --include=*.md " . escapeshellarg($_POST['search']) . " ". $dir));
  
  
}

$smarty->display('search.tpl');
?>
