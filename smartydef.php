<?php
require 'smarty3/Smarty.class.php';

$smarty = new Smarty();


$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/configs');



if (isset($_SESSION['user']) ) {
    $smarty->assign("user", $_SESSION['user']);
}

?>
