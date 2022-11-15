<?php
include "config.php";
session_start();
ob_start();
$err="";
if(!isset($_SESSION['loggedin_vendor'])){
    header("location:vendor_signin.php");
}
$qrsender=base64_decode($_GET['u']);

$details = "SELECT * FROM users WHERE phone='$qrsender'";
            $results = $conn->query($details);
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                    $tpin = $row["tpin"];
                }
            }
            
if(isset($_POST['submit'])){
    $amt=$_POST['amount'];
    $ddate=$_POST['d_date'];
    $desc=$_POST['desc'];
    $date=time();

    $pin1=$_POST['pin1'];
    $pin2=$_POST['pin2'];
    $pin3=$_POST['pin3'];
    $pin4=$_POST['pin4'];

    $pin=$pin1.$pin2.$pin3.$pin4;

    if($pin !== $tpin){
        $err='
        <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-emerald-500">
            <span class="text-xl inline-block mr-5 align-middle">
                <i class="fas fa-bell" />
            </span>
            <span class="inline-block align-middle mr-8">
                <b class="capitalize">Error!</b> Incorrect Pin!
            </span>
            <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
                <span>×</span>
            </button>
        </div>
        ';
    }else{
        $insert=mysqli_query($conn, "INSERT INTO d_loans (id,user,vendor,amt_collected,amt_paid,amt_remaining,deadline,date)
        VALUES
        ('','$qrsender','".$_SESSION['loggedin_vendor']."','$amt','0','$amt','$ddate','$date')");
        if($insert === true){
            $_SESSION['qrsender']=$qrsender;
            $_SESSION['amt']=$amt;
            $_SESSION['ddate']=$ddate;
            header("location:agreed.php");
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
    <div class='flex h-screen  flex-col bg-teal-100' style="background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);">
    <div class="p-2 bg-teal-600 mb-6 h-24">        
        <div class="flex flex-col">
            <a href="dashboard.php">
             <i class="fa fa-angle-left text-white px-2"></i>
            </a>
             <div class="py-2 px-1 w-full justify-center items-center ">
                 <p class="text-center font-bold text-2xl pb-4 text-white "><span class="">Agreement</span> </p>
             </div>
        </div>
    </div>
    <form action="form.php?u=<?php echo ($_GET["u"])?>" method="post" class="mx-6">
        <div>
            <label for="small-input" class="block my-4 text-sm font-medium text-gray-900 dark:text-gray-300">Amount</label>
            <input type="text" name="amount" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div>
            <label for="small-input" class="block my-4 text-sm font-medium text-gray-900 dark:text-gray-300">Deadline Date</label>
            <input type="date" name="d_date" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <label for="message" class="block my-4 text-sm font-medium text-gray-900 dark:text-gray-400">Description</label>
        <textarea name="desc" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></textarea>
        <button class="block mt-5 text-white bg-teal-600  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="popup-modal">
           Agree
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
                        <form action="c_anjima.php" method="post">
                        <div class="flex justify-around w-full mb-6">
                            <input type="password" name="pin1" class="text-center shadow-sm bg-gray-50 border border-gray-300 text-teal-600 text-sm focus:ring-teal-500 focus:border-teal-500 block w-10 p-2.5" maxlength="1" placeholder="*" required="">
                            <input type="password" name="pin2" class="text-center shadow-sm bg-gray-50 border border-gray-300 text-teal-600 text-sm focus:ring-teal-500 focus:border-teal-500 block w-10 p-2.5" maxlength="1" placeholder="*" required="">
                            <input type="password" name="pin3" class="text-center shadow-sm bg-gray-50 border border-gray-300 text-teal-600 text-sm focus:ring-teal-500 focus:border-teal-500 block w-10 p-2.5" maxlength="1" placeholder="*" required="">
                            <input type="password" name="pin4" class="text-center shadow-sm bg-gray-50 border border-gray-300 text-teal-600 text-sm focus:ring-teal-500 focus:border-teal-500 block w-10 p-2.5" maxlength="1" placeholder="*" required="">
                        </div>
                        <button type="submit" name="submit" class="justify-center w-1/2 text-white bg-teal-600 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Send
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- MODAL SECTION ENDS HERE -->     
    </form>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
</body>
</html>