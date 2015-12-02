<?php
require_once('permissions.config.php');
require_once('PHPMailer/PHPMailerAutoload.php');

function endsWith($haystack,$needle,$case=true) {
        if($case){return (strcmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);}
        return (strcasecmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);
}

function checkFilename($filename){
    $regex = ',[0-9][0-9][0-9][0-9]-[0-1][0-9]-[0-2][0-9]\.md,';
    return filter_var($filename, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regex)));
}

function checkOrgan($organ) {
    global $organs;
    return array_key_exists($organ, $organs);
}

function checkWritePerms($user, $organ) {
    global $write;
    return in_array($user, $write[$organ]);
}
function checkReadPerms($user, $organ) {
    global $read;
    return in_array($user, $read[$organ]);
}


function writeIntoFile($text, $organ, $file) {
    $path = REPORTDIR . SUBUNPUBLISHED . $organ . '/' . $file ;
    if (is_file($path)) {
        $file = fopen($path, "w") or die("File error");
	fwrite($file, $text);
	fclose($file);
    }
}

/* Read from file */
function readFromFile($organ, $file) {
    $path = REPORTDIR . SUBUNPUBLISHED . $organ . '/' . $file ;
    if (is_file($path)) {
        $file = fopen($path, "r") or die("File error");
	$text = fread($file, filesize($path));
	fclose($file);
    }
    return $text;
}

function pandocToHTML($src, $to){
    $cmd = "pandoc ". $src . " -f markdown -t html -s -o " . $to;
    exec($cmd);
}

function pandocToPDF($src, $to){
    $cmd = "pandoc ". $src . " -f markdown -o " . $to . ".pdf";
    exec($cmd);
}

function rlyWriteEmail($fromMail, $fromName, $tos, $subject, $text, $attachments) {
  $mail = new PHPMailer;
  $mail->setFrom($fromMail, $fromName);
  foreach($tos as $to) {
        $mail->addAddress($to);
  }
  $mail->Subject = $subject;
  $mail->Body = $text;

  foreach($attachments as $a) {
      if (is_file($a)){
	$mail->addAttachment($a);
      }
    }


  if(!$mail->send()) {
      return "Message could not be sent. \n Mailer Error: " . $mail->ErrorInfo;
  } else {
    return 'Message has been sent';
  }
}

function writeEmail($organ, $file,$state = SUBUNPUBLISHED, $attach = array()) {
    global $emailUN;
    global $emailPub;

    if ($subject == '') {
      if ($state == SUBUNPUBLISHED) {
	$to = $emailUN[$organ];
	$subject = 'Vorläufiges Protokoll: ' . $organ . ' ' .  $file;
      } else {
	$to = $emailPub[$organ];
	$subject = 'Protokoll veröffentlicht: ' . $organ . ' ' .  $file;
      }
    }
    // read email template
    $path = REPORTDIR . $organ . '.email';


    $text = "No email template provided for this organ";
    if (is_file($path)) {
        $file = fopen($path, "r") or die("File error");
	$text = fread($file, filesize($path));
	fclose($file);
    }

    return rlyWriteEmail('test@test.com', 'APVEL', $to, $subject, $text, $attach);

}

function checkLock($user, $organ, $file) {
  $filename =REPORTDIR . SUBUNPUBLISHED . $organ . "/" . $file . ".lock";
  if (is_file($filename)) {
    $file = fopen($filename, "r") or die("File error");
    $text = fread($file, filesize($filename));
    fclose($file);
    $parts = explode(",", $text);
    if ($parts[0] == $user){
      return true;
    } else {
      if ($parts[1] > time()) {
	return false;
      }
    }
  }
  return true;
}

function createLock($user, $organ, $file, $timeoffset = 900) {
  $time = time() + $timeoffset;
  $filename =REPORTDIR . SUBUNPUBLISHED . $organ . "/" . $file . ".lock";
  $file = fopen($filename, "w") or die("File error");
  $str = $user. "," . $time;
  fwrite($file,$str);
}

function deleteLock($organ, $file) {
  $filename =REPORTDIR . SUBUNPUBLISHED . $organ . "/" . $file . ".lock";
  if (is_file($filename)){
    unlink($filename);
  }
}


?>
