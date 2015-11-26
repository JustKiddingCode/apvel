<?php
require('defines.php');
require('permissions.config.php');

header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';


if (array_key_exists($_GET['organ'], $organs)) {
  $organ = $_GET['organ'];
}
//check if a lock file exists
$regex = ',[0-9][0-9][0-9][0-9]-[0-1][0-9]-[0-2][0-9]\.md,';
if (filter_var($_GET['file'], FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regex)))) {
    $filename =REPORTDIR . SUBUNPUBLISHED . $organ . "/" . $_GET['file'] . ".lock";
    if(is_file($filename)) {
      	  $file = fopen($filename, "r") or die("File error");
	  $text = fread($file, filesize($filename));
	  fclose($file);
	  $parts = explode(",", $text);
	  if ($parts[0] == $_GET['user']){
	    $file = fopen($filename, "w") or die("File error");
	    $logdate = time() + 15* 60;
	    $str = $_GET['user']. "," . $logdate;
	    fwrite($file,$str);
	    echo '<response>Get lock file until '. date('H-i',$logdate) .' </response>';
	  } else {
	    if ($parts[1] <= time()) {
	      $file = fopen($filename, "w") or die("File error");
	      $logdate = time() + 15* 60;
	      $str = $_GET['user']. "," . $logdate;
	      fwrite($file,$str);
	      echo '<response>Get lock file until '. date('H-i',$logdate) .' </response>';
	    } else {
	      echo "<response>". $parts[0] ." has a lock file until ".date('H:i',$parts[1])."</response>";
	    }
	  }
	  fclose($file);
    } else {
      	  $file = fopen($filename, "w") or die("File error");
      	  $logdate = time() + 15 * 60;
      	  $str = $_GET['user']. "," . $logdate;
	  fwrite($file, $str);
	  echo '<response>Get lock file until '. date('H:i',$logdate) .' </response>';
	  fclose($file);
    }


}



?>
