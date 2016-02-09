<?php
session_start();

require_once('lib.php');
require_once('defines.php');



if (isset($_GET['organ']) && isset($_GET['file'])) {
  if (checkOrgan($_GET['organ']) && checkReadPerms($_GET['organ']) && checkFilename($_GET['file'])) {
    $to = REPORTDIR . SUBUNPUBLISHED . $_GET['organ'] . "/" . $_GET['file'];
    pandocToPDF($to, $to);
    echo writeEmail($_GET['organ'], $_GET['file'], SUBUNPUBLISHED, array($to. ".pdf"));
  }
}

?>
