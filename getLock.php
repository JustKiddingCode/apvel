<?php
require('defines.php');
require('permissions.config.php');
require('lib.php');

header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';


//check if a lock file exists
if (checkFilename($_GET['file']) && checkOrgan($_GET['organ'])) {
    if (checkLock($_GET['user'], $_GET['organ'], $_GET['file'])) {
      createLock($_GET['user'], $_GET['organ'], $_GET['file']);
      echo '<response>Get lock file until '. date('H-i',time() + 15 * 60) .' </response>';
    } else {
      echo "<response>Another user is editing this file</response>"; 
    }


}



?>
