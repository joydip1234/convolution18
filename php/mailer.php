<?php
function sendMail($to,$sub,$msg){
    $msg = wordwrap($msg,70);
    $headers =  'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: Convolution 2018<noreply@convolutionjuee.com>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    mail($to,$sub,$msg,$headers);
}