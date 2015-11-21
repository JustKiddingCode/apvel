<?php
require('defines.php');
$cmd = "pandoc ". REPORTDIR . $_GET['organ'] . "/" . SUBPUBLISHED. $_GET['file'] . " -f markdown -t html -s -o test.html";
exec($cmd);

header('Location: test.html');
?>
