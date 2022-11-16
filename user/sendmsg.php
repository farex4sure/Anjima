<?php
session_start();
include "config.php";



if($_SERVER['REQUEST_METHOD']=="POST"){

$interactwith=$_SESSION['interactwith'];

$owner=$_SESSION['loggedin_user'];

    $receiver=$interactwith;
    $sender=$owner;
    $message=$_POST['msg'];
    $date=time();
    $query=mysqli_query($conn,"INSERT INTO chat (id, mto, mfrom, mcont, date)VALUES('', '$receiver', '$sender', '$message', '$date')");
    if($query===true){
        echo "Message sent ";
    }else{
        echo "not sent!";
    }
}                                




?>