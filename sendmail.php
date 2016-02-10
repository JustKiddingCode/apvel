<?php
session_start();

require_once('lib.php');
require_once('defines.php');



if (isset($_GET['organ']) && isset($_GET['file'])) {
  if (checkOrgan($_GET['organ']) && checkReadPerms($_GET['organ']) && checkFilename($_GET['file'])) {
    $file = REPORTDIR . SUBUNPUBLISHED . $_GET['organ'] . "/" . $_GET['file'];
    pandocToPDF($file, $file);
    $text = file_get_contents(REPORTDIR . $_GET['organ']. ".email");
    $text .= file_get_contents($file);
    echo rlyWriteEmail("justkidding@asta-kit.de","APVEL", $emailUN[$_GET['organ']],"Unveröffentlichtes Protokoll" . $_GET['file'] ." " .  $_GET['organ'], $text, array($file . ".pdf", $file)); 
  }
}

?>
