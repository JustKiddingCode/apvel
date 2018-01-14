<?php
session_start();

// put full path to Smarty.class.php
require 'smarty3/Smarty.class.php';
require 'defines.php';
require 'lib.php';
require_once 'permissions.config.php';

$smarty = new Smarty();


$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/configs');



$smarty->assign('organs', $organs);
$smarty->assign('this', 'invite.php');


if (isset($_SESSION['user']) ) {
    $user = $_SESSION['user'];
}

$smarty->assign("user", $user);



if(isset($_GET['organ'])) {
    if (checkOrgan($_GET['organ'])) { //input validation
        $smarty->assign("read", checkReadPerms($_GET['organ']));
        $smarty->assign("write", checkWritePerms($_GET['organ']));
        $smarty->assign("admin", checkAdminPerms($_GET['organ']));
        $smarty->assign("organ", $_GET['organ']);    
        
        $file = REPORTDIR . "/" . $_GET['organ'] . ".invitations.txt";
        //only admin is allowed to invite
        if (checkAdminPerms($_GET['organ']) && isset($_POST['mailtext'])) {
            // append to report dir / $organ.invitation
            $add = $_POST['mailtext'] . "\n====End of Invitation====\n";
            $add .= file_get_contents($file);
            file_put_contents($file, $add);

            rlyWriteEMail($emailFrom[$_GET['organ']], "APVEL Protokollsystem", $emailInvite[$_GET['organ']], "Einladung zur nächsten Sitzung  " . $organs[$_GET['organ']], $_POST['mailtext'], array());
        }
        // get text
        $lastInvite = "";
        $handle = fopen($file, "r");
        foreach(file($file) as $line) {
            if ($line != "====End of Invitation====\n") {
                $lastInvite .= $line;
            } else {
                break;
            }
        }
        $smarty->assign("lastInvite", $lastInvite);
    }
}

$smarty->display('invite.tpl');



?>
