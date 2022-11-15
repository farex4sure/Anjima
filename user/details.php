<?php
session_start();
ob_start();

if (!isset($_SESSION['otpVerified']) OR $_SESSION['otpVerified']!= "true") {
header("location:otp.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    <div class='h-screen flex flex-col items-center bg-gradient-to-r from-teal-900 to-sky-900 font-bold bg-no-repeat bg-cover' style='background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);'>
        <div class='flex flex-col w-full items-center mb-8 px-4 py-4 md:px-8 shadow bg-slate-500 bg-opacity-75'>
            <div class='flex mb-4 w-full max-w-5xl text-white'>
                <span><i class='fa fa-chevron-left'></i></span>
                <span class="flex justify-center w-full">Get Started</span>
            </div>
            <div class='flex w-full max-w-5xl text-gray-200'>
                <span class="mr-auto">Personal Details</span>
                <div class="flex justify-center gap-1">
                    <span><button class='h-2 w-3 rounded-lg bg-teal-400'></button></span>
                    <span><button class='h-2 w-3 rounded-lg bg-teal-400'></button></span>
                    <span><button class='h-2 w-3 rounded-lg bg-teal-400'></button></span>
                    <span><button class='h-2 w-3 rounded-lg bg-white'></button></span>
                </div>
            </div>
            <div class='flex w-full max-w-5xl text-gray-50 py-3'>
                <div class="text-xl">
                   Enter your personal details
                </div>
            </div>
        </div>
        <div class='w-full h-full max-w-3xl px-4'>
            <form class='h-full flex flex-col' method="POST" id="form">
                <div class="mb-6 md:mb-8">
                    <div class='flex items-center mb-2'>
                        <label for="name" class="block text-sm font-medium text-gray-600 mr-auto">Full Name</label>
                    </div>
                    <input type="text" name="name" class="bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm md:text-lg font-light focus:outline-none focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 md:py-4" placeholder="Your Name" required="">
                </div>
                <div class="mb-6 md:mb-8">
                    <div class='flex items-center mb-2'>
                        <label for="password" class="block text-sm font-medium text-gray-600 mr-auto">Create Password</label>
                    </div>
                    <input type="password" name="password" class="bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm md:text-lg font-light focus:outline-none focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 md:py-4" placeholder="Create a new password" required>
                </div>
                <div class="mb-auto md:mb-8">
                    <div class='flex items-center mb-2'>
                        <label for="confirm-password" class="block text-sm font-medium text-gray-600 mr-auto">Confirm Password</label>
                    </div>
                    <input type="password" name="cpassword" class="bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm md:text-lg font-light focus:outline-none focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 md:py-4" placeholder="Confirm password" required>
                </div>
                 <p id="resp"></p>
                <div class="flex w-full md:justify-center mb-6">
               
                    <button type="submit" class="text-white max-w-xl w-full bg-teal-600 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm md:text-lg px-5 py-2.5 md:p-4 text-center">Continue</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
<script>
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'validate.php',
            data: new FormData(this),
        
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('button').attr("disabled","");
                $('#form').css("opacity",".5");
var Password=$("#password").val();
var ConfirmPassword=$("#password").val();


                if(Password != ConfirmPassword){
        $("#resp").html("Both passwords must be same.");
        return false;
    }




            },
            success: function(response){ //console.log(response);
                $('#resp').html(response);
                  $('#form').css("opacity","");
                $("button").removeAttr("disabled");
                if(response.status == 1){
                  
                }else{
                    $('#resp').html(response);
                }
                $('#form').css("opacity","");
                $("button").removeAttr("disabled");
            }
        });
    });
});

</script>