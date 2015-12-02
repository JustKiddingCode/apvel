<?php
require('defines.php');
require('lib.php');

if( isset ($_POST["organ"]) && isset ($_POST["date"])){
  if (filter_var($_POST['date'], FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>DATEREGEX)))) {
    $date = explode("/",$_POST['date']);
    if (! checkOrgan($_POST["organ"])){ //sanitize _POST
      die("Invalid Organ!");
    }
    $filename = $date[0] . "-" . $date[1] . "-" . $date[2] . ".md";
    $filenamePub = REPORTDIR . SUBPUBLISHED . $_POST['organ'] . "/" . $date[0] . "-" . $date[1] . "-" . $date[2] . ".md";

    if(is_file(REPORTDIR . SUBUNPUBLISHED . $_POST['organ'] . "/" . $filename)){ // locate to edit.php
      header('Location: edit.php?file='.$filename . "&organ=" . $_POST['organ']);
      exit();
    }
    if(is_file(REPORTDIR . SUBPUBLISHED . $_POST['organ'] . "/". $filename)){
      die("Already published");
    }

    //  Copy Template file and open editor
    copy(REPORTDIR . $_POST['organ'] . ".template.md", REPORTDIR . SUBUNPUBLISHED . $_POST['organ'] . "/" . $filename);
    header('Location: edit.php?file='.$filename . "&organ=" . $_POST['organ']);
    exit();
  }
}



?>
