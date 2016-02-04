<?php
require_once('DokuWiki/PassHash.class.php');
require('smarty3/Smarty.class.php');
require('lib.php');

$smarty = new Smarty();


$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/configs');




session_start();
if (isset($_GET['logout'])) {
  session_unset();
}
if(isset($_SESSION['user'])) { 
    $smarty->assign('loggedIn', true);

} else if(isset($_POST['user']) and isset($_POST['password'])) {
  $handle = fopen("DokuWiki/users.auth.php", "r");
  if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if(startsWith($line, $_POST['user'])) {
          // do the auth
          $lineExplode = explode(":", $line);
          $cHash = new PassHash();
          if ($cHash->verify_hash($_POST['password'],$lineExplode[1] )) {
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['groups'] = explode(",",$lineExplode[4]);
            $smarty->assign('loggedIn', true);
	    header("Location: index.php");
	    exit();
          } else {
            error_log("Login attempt with wrong credentials for user: " . $_POST['user']);
          }
        }
    }

    fclose($handle);
  } else {
    // error opening the file.
  } 
}

$smarty->display('auth.tpl');
?>
