<?php
require_once('PHPMailer/PHPMailerAutoload.php');
require_once('lib.php');
require_once('defines.php');

$user = 'justkidding';

if (isset($_GET['organ']) && isset($_GET['file'])) {
  if (checkOrgan($_GET['organ']) && checkReadPerms($user, $_GET['organ']) && checkFilename($_GET['file'])) {
    $mail = new PHPMailer;

    $mail->setFrom('test@test.com', 'Apvel');

    foreach($email[$_GET['organ']] as $to) {
        $mail->addAddress($to);
    }
    $to = REPORTDIR . SUBUNPUBLISHED . $_GET['organ'] . "/" . $_GET['file'];
    pandocToPDF($to, $to);
    if (is_file($to . ".pdf")){
      $mail->addAttachment($to . ".pdf");
    }
    $mail->addAttachment($to);
    $mail->Subject = 'Protokoll: ' . $_GET['organ'] . ' ' .  $_GET['file'];

    // read email template
    $path = REPORTDIR . $_GET['organ'] . '.email';

    if (is_file($path)) {
        $file = fopen($path, "r") or die("File error");
	$text = fread($file, filesize($path));
	fclose($file);
	$mail->Body = $text;
    }
    $mail->Body = ""
    if(!$mail->send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
	echo 'Message has been sent';
    }
  }
}

?>
