<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$from = "farex@stemlab.com.ng";
$to = "faruqhassan176@gmail.com";
$subject = "Join SabiVoters Challenge";
$message = "Hello Davido, \n

Enter this code to verify your email address
\n

32636236263



SabiVoters 2022
";
$headers = "From:" . $from;
if(mail($to,$subject,$message, $headers)) {
    echo "The email message was sent.";
} else {
    echo "The email message was not sent.";
}
?>