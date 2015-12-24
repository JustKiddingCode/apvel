<?php
session_start();
require('defines.php');
require('lib.php');

header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';


//check if a lock file exists
if (checkOrgan($_GET['organ'])) {
	if (checkFilename($_GET['file']) or $_GET['file'] == "template" or $_GET['file'] == "email" or $_GET['file'] == "resolutions"){    
		if (checkLock($_SESSION['user'], $_GET['organ'], $_GET['file'])) {
			createLock($_SESSION['user'], $_GET['organ'], $_GET['file']);
			echo '<response>Get lock file until '. date('H-i',time() + 15 * 60) .' </response>';
		} else {
			echo "<response>Another user is editing this file</response>"; 
		}

	}
}



?>
