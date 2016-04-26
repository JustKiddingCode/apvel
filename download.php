<?php
session_start();
require_once "defines.php";
require_once "lib.php";
require_once "permissions.config.php";

if (isset($_GET['organ']) && isset($_GET['file'])) {
	if (checkOrgan($_GET['organ']) && checkReadPerms($_GET['organ']) && checkFilename($_GET['file'])){
		$path = REPORTDIR . SUBUNPUBLISHED . $_GET['organ'] . "/" . $_GET['file'];
		$pathPDF = $path . ".pdf";
		pandocToPDF($path, $pathPDF);

		// We'll be outputting a PDF
		header('Content-type: application/pdf');

		// It will be called downloaded.pdf
		header('Content-Disposition: attachment; filename="' . $_GET['file'] . '.pdf"');

		// The PDF source is in original.pdf
		readfile($pathPDF);
	}

}
?>
