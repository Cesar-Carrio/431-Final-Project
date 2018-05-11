<?php

$to      = trim( preg_replace("/\t|\R/",' ',$_POST['Email']));
$subject = 'New Password For Average Joes League Account!';
//need to implement this with a dictionary so i can send them back a temp password
$message = 'password';
$headers = 'From: webmaster@localhost.com' . "\r\n" .
    'Reply-To: webmaster@localhost.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers)){
    header("Location: ../index.php?forgotPwd=success");
}
else{
    header("Location: ../index.php?forgotPwd=failed");
}
//could not complete functionality completely.