<?php
session_start();
ob_start();
include "config.php";
$err="";
if(!isset($_SESSION['loggedin_vendor'])){
    header("location:vendor_signin.php");
}
$qrsender=base64_decode($_GET['u']);
$_SESSION['qrsender']=$qrsender;
$mybalance = "SELECT * FROM wallet WHERE owner='".$_SESSION['loggedin_vendor']."'";
            $result = $conn->query($mybalance);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $bal = $row["balance"];
                }
            }

$mbalance = "SELECT * FROM wallet WHERE owner='$qrsender'";
            $result = $conn->query($mbalance);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $mbalance = $row["balance"];
                }
            }

$lbalance = "SELECT * FROM a_wallet WHERE owner='$qrsender'";
            $result = $conn->query($lbalance);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $lbalance = $row["balance"];
                }
            }

$details = "SELECT * FROM users WHERE phone='$qrsender'";
            $results = $conn->query($details);
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                    $tpin = $row["tpin"];
                    $pic = $row["pic"];
                    $name = $row["fullname"];
                }
            }

$loans = "SELECT * FROM collected_loans WHERE phone='$qrsender'";
            $resultsss = $conn->query($loans);
            if ($resultsss->num_rows > 0) {
                while($rowss = $resultsss->fetch_assoc()) {
                    $lamt = $rowss["amt"];
                }
            }

$query = "SELECT * FROM collected_loans WHERE phone='$qrsender'";
    $resultss = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($resultss);

if(isset($_POST['submit'])){
    $wallet=$_POST['wallet'];
    $amount=$_POST['amount'];
    $desc=$_POST['desc'];
    
    $pin1=$_POST['pin1'];
    $pin2=$_POST['pin2'];
    $pin3=$_POST['pin3'];
    $pin4=$_POST['pin4'];
    $pin=$pin1.$pin2.$pin3.$pin4;
    if($wallet == "mw"){
        $balance=$mbalance;
    }
    else{
        $balance=$lbalance;
    }
    if($amount > $balance){
        $err='
        <div role="alert">
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Error
            </div>
            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                <p>Insufficent Fund.</p>
            </div>
        </div>
        ';
    }else{
        if($pin !== $tpin){
        $err='
        <div role="alert">
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Error
            </div>
            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                <p>Incorrect Pin.</p>
            </div>
        </div>
        ';
        }else{
            if($wallet == "mw"){
                $newbal=$mbalance-$amount;
                $mybal=$bal+$amount;
                $update = "UPDATE wallet SET balance = '$newbal' WHERE owner='$qrsender'";
                $updated = mysqli_query($conn,$update);
                $refid="T".date("Y_M_D_His_").rand(01111,99999);
                $date=time();
                $insert="INSERT INTO transfer (id,tto,tfrom,tdesc,tamt,ref_id,date)VALUES('','".$_SESSION['loggedin_vendor']."','$qrsender','$desc','$amount','$refid','$date')";
                $inserted = mysqli_query($conn,$insert);

                $updates = "UPDATE wallet SET balance = '$mybal' WHERE owner='".$_SESSION['loggedin_vendor']."'";
                $updateds = mysqli_query($conn,$updates);

                if($inserted === true && $updateds === true && $loan === true){
                    $qrsender=$_SESSION['qrsender'];
                    $amount=$_SESSION['amount2'];
                    header("location:received.php");
                }else{
                    $err='
                    <div role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            Error
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>Not received.</p>
                        </div>
                    </div>
                    ';
                }
            }else{
                $newbal=$lbalance-$amount;
                $mybal=$bal+$amount;
                $update = "UPDATE a_wallet SET balance = '$newbal' WHERE owner='$qrsender'";
                $updated = mysqli_query($conn,$update);
                $refid="T".date("Y_M_D_His_").rand(01111,99999);
                $date=time();
                $insert="INSERT INTO transfer (id,tto,tfrom,tdesc,tamt,ref_id,date)VALUES('','".$_SESSION['loggedin_vendor']."','$qrsender','$desc','$amount','$refid','$date')";
                $inserted = mysqli_query($conn,$insert);

                if($count > 0){
                    $ramt=$lamt+$amount;
                    $l_update =mysqli_query($conn, "UPDATE collected_loans SET amt = '$ramt' WHERE phone='$qrsender'");
                }else{
                    $loan = mysqli_query($conn, "INSERT INTO collected_loans (id,phone,amt,date)VALUES('','$qrsender','$amount','$date')");
                }

                $updates = "UPDATE wallet SET balance = '$mybal' WHERE owner='".$_SESSION['loggedin_vendor']."'";
                $updateds = mysqli_query($conn,$updates);
                
                $loanacc= "INSERT INTO loans (id,phone,amt_used,amt_remaining,amt_paid,dt)VALUES('','$qrsender','$amount','','','$date')";
                $loan=mysqli_query($conn,$loanacc);

                if($inserted === true && $updateds === true){
                    $qrsender=$_SESSION['qrsender'];
                    $amount=$_SESSION['amount2'];
                    header("location:received.php");
                }else{
                    $err='
                    <div role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            Error
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>Not received.</p>
                        </div>
                    </div>
                    ';
                }
            }
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
    <title>Anjima | Vendor Withdraw</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
    <div class='flex h-screen flex-col bg-gray-100' style='background-image: url("data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z")'>

        <!-- HEADER STARTS HERE -->
        <header class='flex justify-center p-3 shadow mb-4 md:px-8 bg-gray-300 bg-opacity-25'>
            <div class='flex items-center w-full max-w-6xl'>
                <div class='flex items-center gap-2 mr-auto'>
                    <div class='flex items-center gap-4'>
                        <a href="dashboard.php"><i class="fa fa-arrow-left"></i></a>
                        <h3 class='w-full text-sm md:text-lg font-semibold text-gray-600'>Receive Money</h3>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER ENDS HERE -->

        <!-- MAIN STARTS HERE -->
        <main class='flex justify-center mb-auto h-full overflow-auto'>
            <div class='h-full w-full max-w-6xl shadow px-3 md:px-5 lg:px-8'>
                <div class='flex justify-center w-full rounded-lg py-1 md:mb-6 md:mt-4'>
                    <div class='w-32 md:w-44'>
                        <img class='' src="../images/anj.png" alt="">
                    </div>
                </div>
                <div class="flex justify-center w-full rounded-lg py-1 mt-4 md:mb-6 md:mt-4">
                    <div class='w-32 h-32 md:w-44 md:h-44'>
                        <img class='object-fit rounded-full w-full h-full' src="../user/images/<?php echo $pic ?>" alt="">
                    </div>
                </div>
                <div class="flex justify-center w-full rounded-lg py-1 md:mb-6 md:mt-4">
                    <h3 class='w-full text-center text-3xl md:text-4xl font-semibold text-gray-600'><?php echo $name ?></h3>
                </div>
                <div class='flex flex-col mt-5'>
                <?php echo $err ?>
                    <form action="scan.php?u=<?php echo $_GET['u']; ?>" method="post">
                        <div class="mb-6">
                            <label for="wallet" class="w-full mb-2 text-sm md:text-lg font-semibold text-gray-600">Select Wallet</label>
                            <select name="wallet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg                                                    focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" required>
                            <option>--Select Wallet--</option>
                            <option value="mw"> Main wallet </option>
                            <option value="lw"> Loan wallet </option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="amount" class="w-full mb-2 text-sm md:text-lg font-semibold text-gray-600">Amount (&#8358)</label>
                            <input type="text" name="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg                                                    focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5"placeholder="Amount" required>
                        </div>
                        <div class="mb-6">
                            <label for="Description" class="w-full mb-2 text-sm md:text-lg font-semibold text-gray-600">Description</label>
                            <textarea type="text" name="desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg                                                    focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5"placeholder="Description" required></textarea>
                        </div>
                        <button type="button" data-modal-toggle="popup-modal" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Next
                        </button>
                        <!-- MODAL SECTION STARTS HERE -->
                                <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                    <div class="relative w-full h-full max-w-md p-4 md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Enter Your Pin</h3>
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
                                </div>
                        <!-- MODAL SECTION ENDS HERE -->
                    </form>
                </div>
            </div>
        </main>
        <!-- MAIN ENDS HERE -->
        
        <!-- FOOTER STARTS HERE -->
        <footer class='flex w-full justify-center p-3 px-0 border-t border-1 bg-gray-300 bg-opacity-25'>
            <div class='flex justify-around w-full max-w-5xl'>
                <span class='text-teal-600 text-lg md:text-3xl'>
                    <a href="#"><i class='fa fa-home'></i></a>
                </span>
                <span class='text-teal-600 text-lg md:text-3xl'>
                    <a href="#"><i class='fa fa-bank'></i></a>
                </span>
                <span class='text-teal-600 text-lg md:text-3xl'>
                    <a href="#"><i class='fa fa-message'></i></a>
                </span>
                <span class='text-teal-600 text-lg md:text-3xl'>
                    <a href="#"><i class='fa fa-bars'></i></a>
                </span>
            </div>
        </footer>
        <!-- FOOOTER ENDS HERE -->
    </div>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
        <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
</body>
</html>