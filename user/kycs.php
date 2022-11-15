
<?php

session_start();
include "config.php";
if(!isset($_SESSION['loggedin_user'])){
    header("location:signin.php");
}

// check if user has already done their kyc
$loggedin_user=$_SESSION['loggedin_user'];
include "config.php";
$checkuser=mysqli_query($conn, "SELECT * FROM users WHERE phone='$loggedin_user'");

 while($row = $checkuser->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row["fullname"];
                    $email = $row["email"];
                    $tpin = $row["tpin"];
                    $pic = $row["pic"];
                    $st = $row["st"];

                 if($st=="1"){

                     header("location:dashboard.php");

                     ?>

                    <script>
                    window.location.href='dashboard.php';
                    </script>
                     <?php

                 }



                }



?>
