<?php
session_start();
ob_start();
include "config.php";
if(!isset($_SESSION['loggedin_vendor'])){
    header("location:vendor_signin.php");


}

$loggedin_vendor=$_SESSION['loggedin_vendor'];

$getVName=mysqli_query($conn, "SELECT * FROM vendors WHERE phone='$loggedin_vendor'");
while($vName=mysqli_fetch_assoc($getVName)){
$name=$vName['fullname'];






}
$qrsender=$_SESSION['qrsender'];


// get the latest transaction



$glt=mysqli_query($conn, "SELECT * FROM transfer WHERE tfrom='$qrsender' AND tto='$loggedin_vendor' ORDER BY id DESC LIMIT 1");


while($tDetails=mysqli_fetch_assoc($glt)){




$amount=$tDetails['tamt'];
$refid=$tDetails['ref_id'];


}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/jquery.min.js"></script> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anjima | Confirm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
    <div class='flex h-screen flex-col bg-gray-100' style='background-image: url("data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z")'>
        <!-- MAIN STARTS HERE -->
        <main class='flex justify-center mb-auto h-full overflow-auto'>
            <div class='flex-flex-col h-full w-full max-w-6xl shadow px-3 md:px-5 lg:px-8 py-4'>
                <div class='flex flex-col w-full h-full px-3 py-4 bg-white bg-opacity-50 rounded-lg'>
                    <div class="flex flex-col items-center py-8">
                        <div class="flex justify-center items-center py-4">
                            <span class="flex justify-center items-center rounded-full text-2xl md:text-3xl w-10 h-10 md:w-12 md:h-12 bg-teal-600 text-teal-100"><i class="fa fa-check"></i></span>
                        </div>
                        <div class="flex flex-col gap-2 pt-2 pb-4">
                            <span class="block uppercase text-2xl font-semibold text-center">Successful</span>
                            <span class="block text-center text-gray-400">Your transfer is successful</span>
                            <span class="block uppercase text-2xl font-bold text-center"><span><i class="fa fa-naira-sign"></i></span><?php echo number_format($amount); ?></span>
                        </div>
                    </div>
                    <div class='flex flex-col divide-y border-t border-b justify-start py-2'>
                        <!-- SENT TRANSFER SECTION STARTS HERE -->
                        <div class='flex items-center justify-between w-full py-3 px-3'>
                            <div class='flex items-center justify-center'>
                                <span>Receipient</span>
                            </div>
                            <div class='flex justify-end items-center w-3/5 md:w-full font-semibold'>
                                <span class="truncate"><?php echo $name ?></span>
                            </div>
                        </div>
                        <div class='flex items-center justify-between w-full py-3 px-3'>
                            <div class='flex items-center justify-center'>
                                <span>Phone Number</span>
                            </div>
                            <div class='flex justify-end items-center w-3/5 md:w-full font-semibold'>
                                <span>(<?php echo $_SESSION['qrsender'] ?>)</span>
                            </div>
                        </div>
                        <div class='flex items-center justify-between w-full py-3 px-3'>
                            <div class='flex items-center justify-center'>
                                <span>Amount</span>
                            </div>
                            <div class='flex justify-end items-center font-semibold'>
                                <span class="truncate"><i class="fa fa-naira-sign"></i><?php echo number_format($amount); ?></span>
                            </div>
                        </div>
                        <div class='flex items-center justify-between w-full py-3 px-3'>
                            <div class='flex items-center justify-center'>
                                <span>Transaction ID</span>
                            </div>
                            <div class='flex justify-end items-center font-semibold'>
                                <span class="truncate w-62"><?php echo $refid; ?></span>
                            </div>
                        </div>
                        <div class='flex items-center justify-between w-full py-3 px-3'>
                            <div class='flex items-center justify-center'>
                                <span>Transaction Type</span>
                            </div>
                            <div class='flex justify-end items-center font-semibold'>
                                <span class="truncate">Money Transfer</span>
                            </div>
                        </div>
                        <!-- SENT TRANSFER SECTION ENDS HERE -->
                    </div>

                </div>
            </div>
        </main>
        <!-- MAIN ENDS HERE -->
        
        <!-- FOOTER STARTS HERE -->
        <footer class='flex w-full justify-center p-3 px-0 bg-opacity-25'>
            <div class='flex justify-around w-full max-w-5xl px-4 gap-3'>
                <button onclick="myFunction()" class='w-full py-1.5 md:py-2 lg:py-3 font-semibold text-teal-600 bg-teal-100 rounded-2xl border border-gray-00 text-lg md:text-3xl'>
                    Complete
                </button>
            </div>
        </footer>
        <!-- FOOOTER ENDS HERE -->
    </div>


    
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
function myFunction() {
  location.replace("dashboard.php")
}
</script>
    <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
</body>
</html>