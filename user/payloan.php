<?php
session_start();
include "config.php";
$err="";
if(!isset($_SESSION['loggedin_user'])){
    header("location:vendor_signin.php");
}
$id=base64_decode($_GET["pay"]);
    $task = "SELECT * FROM d_loans WHERE id='$id'";
    $result2 = $conn->query($task);
    if ($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
            $vendor = $row2["vendor"];
            $collect = $row2["amt_collected"];
            $remaining = $row2["amt_remaining"];
            $paid = $row2["amt_paid"];
        }
    }
$details = "SELECT * FROM users WHERE phone='".$_SESSION['loggedin_user']."'";
    $result = $conn->query($details);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $name = $row["fullname"];
            $email = $row["email"];
            $tpin = $row["tpin"];
            $pic = $row["pic"];
        }
    }

$detals = "SELECT * FROM vendors WHERE phone='$vendor'";
    $result = $conn->query($detals);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $vname = $row["fullname"];
            $vpic = $row["pic"];
        }
    }

$ubal = "SELECT * FROM wallet WHERE owner='".$_SESSION['loggedin_user']."'";
    $result = $conn->query($ubal);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $userbal = $row["balance"];
        }
    }

$vbal = "SELECT * FROM wallet WHERE owner='$vendor'";
    $result = $conn->query($vbal);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $vendorbal = $row["balance"];
        }
    }
if(isset($_POST['submit'])){
    $amt_paid=$_POST['amt_paid'];
    $pin1=$_POST['pin1'];
    $pin2=$_POST['pin2'];
    $pin3=$_POST['pin3'];
    $pin4=$_POST['pin4'];
    $pin=$pin1.$pin2.$pin3.$pin4;
    $date=time();
    $refid="T".date("Y_M_D_His_").rand(01111,99999);
    $desc="I pay my loan";

    if($pin !== $tpin){
        $err='
        <div id="alert-border-1" class="flex p-4 mb-2 bg-teal-100 border-t-4 border-teal-500 dark:bg-teal-200" role="alert">
            <svg class="flex-shrink-0 w-5 h-5 text-teal-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd">
                </path>
            </svg>
                <div class="ml-3 text-sm font-medium text-teal-700">
                    Incorrect Pin.
                </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-teal-100 dark:bg-teal-200 text-teal-500 rounded-lg focus:ring-2 focus:ring-teal-400 p-1.5 hover:bg-teal-200 dark:hover:bg-teal-300 inline-flex h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd">
                    </path>
                </svg>
            </button>
        </div>
        ';
    }elseif($amt_paid > $userbal){
        $err='
        <div id="alert-border-1" class="flex p-4 mb-2 bg-teal-100 border-t-4 border-teal-500 dark:bg-teal-200" role="alert">
            <svg class="flex-shrink-0 w-5 h-5 text-teal-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd">
                </path>
            </svg>
                <div class="ml-3 text-sm font-medium text-teal-700">
                    Insufficient balance.
                </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-teal-100 dark:bg-teal-200 text-teal-500 rounded-lg focus:ring-2 focus:ring-teal-400 p-1.5 hover:bg-teal-200 dark:hover:bg-teal-300 inline-flex h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd">
                    </path>
                </svg>
            </button>
        </div>
        ';
    }elseif($amt_paid > $remaining){
        $err='
        <div id="alert-border-1" class="flex p-4 mb-2 bg-teal-100 border-t-4 border-teal-500 dark:bg-teal-200" role="alert">
            <svg class="flex-shrink-0 w-5 h-5 text-teal-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd">
                </path>
            </svg>
                <div class="ml-3 text-sm font-medium text-teal-700">
                    Your remaining credit is not upto '.$amt_paid.'.
                </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-teal-100 dark:bg-teal-200 text-teal-500 rounded-lg focus:ring-2 focus:ring-teal-400 p-1.5 hover:bg-teal-200 dark:hover:bg-teal-300 inline-flex h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd">
                    </path>
                </svg>
            </button>
        </div>
        ';
    }else{
        $vupdate=$amt_paid+$vendorbal;
        $uupdate=$userbal-$amt_paid;
        $insert=mysqli_query($conn, "INSERT INTO transfer(id,tto,tfrom,tdesc,tamt,ref_id,date)
        VALUES('','$vendor','".$_SESSION['loggedin_user']."','$desc','$amt_paid','$refid','$date')");

        $newamtremain=$remaining-$amt_paid;
        $newamtpaid=$amt_paid+$paid;

        $update=mysqli_query($conn, "UPDATE d_loans SET amt_paid='$newamtpaid', amt_remaining='$newamtremain' WHERE id='$id'");
        $update1=mysqli_query($conn, "UPDATE wallet SET balance='$vupdate' WHERE owner='$vendor'");
        $update2=mysqli_query($conn, "UPDATE wallet SET balance='$uupdate' WHERE owner='".$_SESSION['loggedin_user']."'");

        if($insert === true && $update === true && $update1 === true && $update2 === true){
            $err='
        <div id="alert-border-1" class="flex p-4 mb-2 bg-teal-100 border-t-4 border-teal-500 dark:bg-teal-200" role="alert">
            <svg class="flex-shrink-0 w-5 h-5 text-teal-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd">
                </path>
            </svg>
                <div class="ml-3 text-sm font-medium text-teal-700">
                    You have paid '.$amt_paid.' from your debt.
                </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-teal-100 dark:bg-teal-200 text-teal-500 rounded-lg focus:ring-2 focus:ring-teal-400 p-1.5 hover:bg-teal-200 dark:hover:bg-teal-300 inline-flex h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd">
                    </path>
                </svg>
            </button>
        </div>
        ';
            ?>
            <!--<script type="text/javascript">
                window.location.href="payloan.php?pay=<?php echo ($_GET["pay"])?>";
            </script>-->
            <?php
        }else{
            $err='
        <div id="alert-border-1" class="flex p-4 mb-2 bg-teal-100 border-t-4 border-teal-500 dark:bg-teal-200" role="alert">
            <svg class="flex-shrink-0 w-5 h-5 text-teal-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd">
                </path>
            </svg>
                <div class="ml-3 text-sm font-medium text-teal-700">
                    Error.
                </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-teal-100 dark:bg-teal-200 text-teal-500 rounded-lg focus:ring-2 focus:ring-teal-400 p-1.5 hover:bg-teal-200 dark:hover:bg-teal-300 inline-flex h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd">
                    </path>
                </svg>
            </button>
        </div>
        ';
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <script src="js/jquery.min.js"></script> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Anjima | Personal Details</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
    <div class='flex h-screen flex-col bg-teal-100' style="background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);">
<!-- HEADER STARTS HERE -->
<header class='flex justify-center p-3  mb-4 md:px-8 bg-gray-300 bg-opacity-25'>
    <div class='flex items-center w-full max-w-6xl'>
        <div class='flex items-center gap-2 mr-auto'>
            <div class='flex items-center gap-4'>
                <a href="debtors.php"><i class="fa fa-arrow-left"></i></a>
                <h3 class='w-full text-sm md:text-lg font-semibold text-gray-600'>Loan</h3>
            </div>
        </div>
    </div>
</header>
<!-- HEADER ENDS HERE -->

<!-- MAIN STARTS HERE -->
<main class='flex justify-center mb-auto h-full overflow-auto'>
    <div class='h-full w-full max-w-6xl  px-3 md:px-5 lg:px-8'>
        <div class='flex justify-center w-full rounded-lg py-1 md:mb-6 md:mt-4'>
            <div class='w-32 md:w-44'>
                <img class='' src="../images/anj.png" alt="">
            </div>
        </div>
        <div class="flex justify-center w-full rounded-lg py-1 mt-4 md:mb-6 md:mt-4">
            <div class='w-32 h-32 md:w-44 md:h-44'>
                <img class='object-fit rounded-full w-full h-full' src="../vendors/vendor/<?php echo $vpic ?>" alt="">
            </div>
        </div>
        <div class="flex justify-center w-full rounded-lg py-1 md:mb-6 md:mt-4">
            <h3 class='w-full text-center text-3xl md:text-4xl font-semibold text-gray-600'><?php echo $vname ?></h3>
        </div>
        <?php echo $err ?>
        <div class='flex flex-col mt-5'>
                <div class="p-1 font-light    border-gray-200 der-gray-700 gray-900">
                    <div class="grid grid-cols-2 bg-white rounded-lg bg-opacity-50 my-4 w-full h-full md:grid-cols-3 sm:grid-col-2  justify-items-center  md:py-8">
                        <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                            <div class="flex flex-col gap-2">
                                <span class="font-medium block border-b-2 border-teal-600" >Amount Borrowed</span>
                             <span class="font-medium block text-center" >&#8358 <?php echo number_format($collect) ?></span>
                            </div>
                         </a>
                         <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                            <div class="flex flex-col gap-2">
                                <span class="font-medium block border-b-2 border-teal-600" >Amount Paid</span>
                             <span class="font-medium block text-center" >&#8358 <?php echo number_format($paid) ?></span>
                            </div>
                         </a>
                        <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                            <div class="flex flex-col gap-2">
                                <span class="font-medium block border-b-2 border-teal-600" >Amount Remaining</span>
                                <span class="font-medium block text-center " >&#8358 <?php echo number_format($remaining) ?></span>
                            </div>
                         </a>
                        <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                           <div class="flex flex-col gap-2">
                          </div>
                        </a>
                    </div>  
                  </div>
              </div>
            <div class="flex w-full justify-center my-4">
                <a href="interaction.php?interactwith=<?php echo base64_encode($vendor) ?>" class="flex flex-col px-4 items-center text-teal-600 justify-center  gap-1   ">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </a>
                <a href="interaction.php?interactwith=<?php echo base64_encode($vendor) ?>" class="flex flex-col items-center text-teal-600 justify-center  gap-1   ">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>                </a>
                </a>
            </div>
            <?php
            if($remaining <= 0){
                ?>
                <p class="w-full text-center font-bold text-teal-600 text-xl">You have successfully finish paying your credit</p>
                <?php
            }else{
            ?>
              <div class="flex w-full justify-center items-center">
                 <button type="button" data-modal-toggle="popup-modal" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm  items-center justify-center sm:w-auto px-5 py-2.5 text-center">
                    Pay
                 </button>
              </div>
            <?php
            }
            ?>
                <!-- MODAL SECTION STARTS HERE -->
                        <form action="payloan.php?pay=<?php echo ($_GET["pay"])?>" method="post" id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                            <div class="relative w-full h-full max-w-md p-4 md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                    </button>
                                    <div class="p-6 text-center">
                                            <span class="mb-5 text-lg font-normal text-gray-500">You are about to send money to Farooq Hassan </span> 
                                            <input type="tel" name="amt_paid" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Amount">
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 ">Enter Your Pin</h3>
                                        <div class="flex justify-around w-full mb-6">
                                            <input type="password" name="pin1" class="text-center shadow-sm bg-gray-50 border border-gray-300 text-teal-600 text-sm focus:ring-teal-500 focus:border-teal-500 block w-10 p-2.5" maxlength="1" placeholder="*" required="">
                                            <input type="password" name="pin2" class="text-center shadow-sm bg-gray-50 border border-gray-300 text-teal-600 text-sm focus:ring-teal-500 focus:border-teal-500 block w-10 p-2.5" maxlength="1" placeholder="*" required="">
                                            <input type="password" name="pin3" class="text-center shadow-sm bg-gray-50 border border-gray-300 text-teal-600 text-sm focus:ring-teal-500 focus:border-teal-500 block w-10 p-2.5" maxlength="1" placeholder="*" required="">
                                            <input type="password" name="pin4" class="text-center shadow-sm bg-gray-50 border border-gray-300 text-teal-600 text-sm focus:ring-teal-500 focus:border-teal-500 block w-10 p-2.5" maxlength="1" placeholder="*" required="">
                                        </div>
                                        <button type="submit" name="submit" class="justify-center w-1/2 text-white bg-teal-600 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                <!-- MODAL SECTION ENDS HERE -->
        </div>
    </div>
</main>
<!-- MAIN ENDS HERE -->



    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
        <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
</body>
</html>