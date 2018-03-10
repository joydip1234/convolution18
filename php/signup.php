<?php
//ini_set('display_startup_errors',1);
//ini_set('display_errors',1);
//error_reporting(-1);
ob_end_clean();
header("Connection: close");
ignore_user_abort(true); // just to be safe
ob_start();
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Website for Convolution 2018"/>
        <meta name="keywords"
              content="event, fest, convolution, 2018, jadavpur university, electrical engineering, 18, 2k18"/>
        <title>Convolution 2018</title>

        <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="../css/mailsent.css"/>

    </head>
    <body>
<?php

require_once 'functions.php';
require_once "gmailer.php";

$name = "";
$email = "";
$contact = "";
$pass = "";
$inst = "";
$dept = "";
$class = "";
//print_r($_POST);
//var_dump($_POST);
if (isset($_REQUEST['signup_name'])) $name = sanitizeString($_REQUEST['signup_name']);
if ($name === "") die('1');
if (isset($_REQUEST['signup_email'])) $email = sanitizeString($_REQUEST['signup_email']);
if ($email === "") die('2');
if (isset($_REQUEST['signup_contact'])) $contact = sanitizeString($_REQUEST['signup_contact']);
if ($contact === "") die('3');
if (isset($_REQUEST['signup_password'])) $pass = sanitizeString($_REQUEST['signup_password']);
if ($pass === "") die('4');
if (isset($_REQUEST['class'])) $class = sanitizeString($_REQUEST['class']);
if ($class === "") die('5');
if (isset($_REQUEST['signup_dept'])) $dept = sanitizeString($_REQUEST['signup_dept']);
if ($dept === "") die('6');
if (isset($_REQUEST['signup_institute'])) $inst = sanitizeString($_REQUEST['signup_institute']);
if ($inst === "") die('7');
//echo "<br>x$email";
$mailres = sql("SELECT * FROM `users` WHERE `email`='$email'");
if ($mailres->num_rows > 0) {
    if ($mailres->fetch_assoc()['confirmation'] == '0')
        die("<div style='text-align: center;font-size: 2em'>User with the same e-mail Already exists.<hr><a href='../'>Click here to get back to the site.</a></div>");
    else
        sql("DELETE FROM `users` WHERE `email`='$email'");
}

$con = randomString(16);
$result = sql("INSERT INTO `users` 
        (`id`, `email`, `name`,`contact`,`pass`,`class`,`dept`,`inst`,`confirmation`) 
VALUES (NULL,   '$email','$name','$contact','$pass','$class','$dept','$inst','$con')");
$encodedmail = urlencode($email);

//TODO: Remove /test !!IMPORTANT

//$body = "Click <b></b><a href='http://www.convolutionjuee.com/php/confirm/index.php?id=$encodedmail&con=$con'>here</a></b> to confirm your email address.<br>For any question, query or issues, contact <b>Sudipto Banik (Website Management)- <i>+91 9051073567</i></b>";

//$_COOKIE['convo_mail']=$email;
//$_COOKIE['not_confirmed']=1;

setcookie('convo_mail', $email, time() + (86400 * 30), "/");
//setcookie('not_confirmed', '0', time() + (86400 * 30), "/");

echo "<div id='sentContainer'>Thanks for registering on Convolution 2018.<br><br>Now You will be able to register to specific events after logging in directly from Home Page by clicking on respective register button<br><br> If having issues registering to events please contact <b>Sudipto Banik (Website Management)- <i>+91 9051073567</i> <br><br><a id='sentButton' href='../'>Click here to return to Home Page</a></div>";
//header("Location: ../");
ob_end_flush();
flush();
//sendGMail($email, "Confirmation Email", $body);

