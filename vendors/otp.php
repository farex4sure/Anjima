<?php
include "config.php";
session_start();
$err="";
if(!isset($_SESSION['phone'])){
    header("location:vendor_signin.php");
}
if(isset($_POST['submit'])){
$otp1=$_POST['otp1'];
$otp2=$_POST['otp2'];
$otp3=$_POST['otp3'];
$otp4=$_POST['otp4'];
$otp5=$_POST['otp5'];
$otp6=$_POST['otp6'];

$otp=$otp1.$otp2.$otp3.$otp4.$otp5.$otp6;
if($otp=="123456") {
   
$_SESSION['otpVerified']="true";
header("location:details.php");
}else{
    $err='
    <div role="alert">
  <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
    Error
  </div>
  <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
    <p>Invalid otp.</p>
  </div>
</div>
    ';
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
    <title>Anjima | OTP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
    <div class='h-screen flex flex-col items-center bg-gradient-to-r from-teal-900 to-sky-900 font-bold bg-no-repeat bg-cover' style='background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);'>
        <div class='flex flex-col w-full h-auto items-center px-4 py-4 md:px-8 shadow bg-slate-500 bg-opacity-75'>
            <div class='flex mb-4 w-full max-w-5xl text-white'>
                <a href='register1.html'><i class='fa fa-chevron-left'></i></a>
                <span class="flex justify-center w-full">Get Started</span>
            </div>
            <div class='flex w-full max-w-5xl text-gray-200'>
                <span class="mr-auto">Security Info</span>
                <div class="flex justify-center gap-1">
                    <span><button class='h-2 w-3 rounded-lg bg-teal-400'></button></span>
                    <span><button class='h-2 w-3 rounded-lg bg-teal-400'></button></span>
                    <span><button class='h-2 w-3 rounded-lg bg-white'></button></span>
                    <span><button class='h-2 w-3 rounded-lg bg-white'></button></span>
                </div>
            </div>
            <div class='flex w-full max-w-5xl text-gray-50 py-3'>
                <div class="text-xl">
                   Verify your number with OTP
                </div>
            </div>
        </div>
        <div class='flex flex-col w-full h-full max-w-3xl px-4 pt-8'>
        <?php echo $err ?>
            <span class='block py-3 px-1 text-gray-500'>Enter the 6-digit code</span>
            <form action="otp.php" method="post" class='h-full flex flex-col'>
                <div class="flex justify-between mb-4">
                    <div class='flex items-center'>
                        <label for="phone" class="hidden">Mobile  Number</label>
                    </div>
                    <input type="password" name='otp1' maxlength="1" class="w-12 h-12 text-center bg-gray-50 text-gray-900 text-xl font-semibold focus:outline-none focus:ring-teal-500 focus:border-teal-500 block" placeholder="*" required="">
                    
                    <div class='flex items-center'>
                        <label for="phone" class="hidden">Mobile  Number</label>
                    </div>
                    <input type="password" name='otp2' maxlength="1" class="w-12 h-12 text-center bg-gray-50 text-gray-900 text-xl font-semibold focus:outline-none focus:ring-teal-500 focus:border-teal-500 block" placeholder="*" required="">

                    <div class='flex items-center'>
                        <label for="phone" class="hidden">Mobile  Number</label>
                    </div>
                    <input type="password" name='otp3' maxlength="1" class="w-12 h-12 text-center bg-gray-50 text-gray-900 text-xl font-semibold focus:outline-none focus:ring-teal-500 focus:border-teal-500 block" placeholder="*" required="">                    
                    
                    <div class='flex items-center'>
                        <label for="phone" class="hidden">Mobile  Number</label>
                    </div>
                    <input type="password" name='otp4' maxlength="1" class="w-12 h-12 text-center bg-gray-50 text-gray-900 text-xl font-semibold focus:outline-none focus:ring-teal-500 focus:border-teal-500 block" placeholder="*" required="">                    
                    
                    <div class='flex items-center'>
                        <label for="phone" class="hidden">Mobile  Number</label>
                    </div>
                    <input type="password" name='otp5' maxlength="1" class="w-12 h-12 text-center bg-gray-50 text-gray-900 text-xl font-semibold focus:outline-none focus:ring-teal-500 focus:border-teal-500 block" placeholder="*" required="">                    
                    
                    <div class='flex items-center'>
                        <label for="phone" class="hidden">Mobile  Number</label>
                    </div>
                    <input type="password" name='otp6' maxlength="1" class="w-12 h-12 text-center bg-gray-50 text-gray-900 text-xl font-semibold focus:outline-none focus:ring-teal-500 focus:border-teal-500 block" placeholder="*" required="">                    
                </div>
                <div class='flex mb-auto px-2'>
                    <div class='mr-auto text-gray-500'>
                        <span>01</span> :
                        <span>00</span>
                    </div>
                    <button class='flex gap-2 items-center'>
                        <span class='text-teal-600'><i class='fa fa-message'></i></span>
                        <span class='text-gray-500 font-semibold'>Resend OTP</span>
                    </button>
                </div>
                <div class="flex w-full md:justify-center mb-6">
                    <button type="submit" name="submit" class="text-white max-w-xl w-full bg-teal-600 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm md:text-lg px-5 py-2.5 md:p-4 text-center">Verify</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
</body>
</html>