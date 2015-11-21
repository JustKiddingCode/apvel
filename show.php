<?php
require('defines.php');
$cmd = "pandoc ". REPORTDIR . SUBPUBLISHED.  $_GET['organ'] . "/" . $_GET['file'] . " -f markdown -t html -s -o test.html";
exec($cmd);

header('Location: test.html');
?>
