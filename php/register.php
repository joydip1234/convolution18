<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 05-02-2017
 * Time: 17:25
 */

ob_end_clean();
header("Connection: close");
ignore_user_abort(true); // just to be safe
ob_start();
require_once "functions.php";
require_once "gmailer.php";
$event = '';
if (isset($_REQUEST['event'])) $event = sanitizeString($_REQUEST['event']);
if ($event == '') die('0');
$x = checkConvoAuth('');
if ($x == 1) {
    $email = $_COOKIE['convo_mail'];
    if (sql("SELECT * FROM `registration` WHERE `email`='$email' AND `event`='$event'")->num_rows == 0) {
        sql("INSERT INTO `registration` (`id`,`email`,`event`) VALUES (NULL,'$email','$event')");
//    echo "INSERT INTO `registration` (`id`,`email`,`event`) VALUES (NULL,'$email','$event')";
        ob_end_flush();
        flush();
        echo '1';
    }else echo '2';
    
}else if($x==0)echo "10";
else echo -1;