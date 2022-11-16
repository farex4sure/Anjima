<?php
session_start();
include "config.php";
if(!isset($_SESSION['phone']) || !isset($_SESSION['otpVerified']) || !isset($_SESSION['name'])  || !isset($_SESSION['password'])){
header("location: signup.php");
}
else{





if($_SERVER['REQUEST_METHOD']==="POST"){

$fullname=$_SESSION['name'];
$phone=$_SESSION['phone'];
$email=$_SESSION['email'];
$password=$_SESSION['password'];
$pwd=md5($password);
$dt=time();


$msg = ""; 



    $filename = uniqid.$_FILES["picture"]["name"];

    $tempname = $_FILES["picture"]["tmp_name"];  

        $folder = "images/".$filename;   

   
        // query to insert the submitted data

        $sql = "INSERT INTO users (fullname, phone, email, pic, pwd, tier, st, date) VALUES ('$fullname', '$phone', '$email', '$filename', '$pwd', '2', '0', '$dt')";
$sql2 = "INSERT INTO a_wallet (owner, balance, date) VALUES ('$phone', '10000.00','$dt')";
$sql3 = "INSERT INTO wallet (owner, balance, date) VALUES ('$phone', '0.00','$dt')";


        // function to execute above query

        $done=mysqli_query($conn, $sql);       
$done2=mysqli_query($conn, $sql2); 
$done3=mysqli_query($conn, $sql3); 

        // Add the image to the "image" folder"

        if (move_uploaded_file($tempname, $folder) && $done && $done2 && $done3) {
$_SESSION['loggedin_user']=$_SESSION['phone'];

unset($fullname);
unset($email);
unset($phone);
unset($otpVerified);
unset($password);



         ?>
<script>
window.location.href='dashboard.php';
</script>

         <?php

        }else{

            $msg = "Something went wrong, please try again!";

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
    <title>Anjima | Upload Picture</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
    <div class='h-screen flex flex-col items-center bg-gradient-to-r from-teal-900 to-sky-900 font-bold bg-no-repeat bg-cover' style='background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);'>
        <div class='flex flex-col w-full items-center px-4 py-4 md:px-8 shadow bg-slate-500 bg-opacity-75'>
            <div class='flex mb-4 w-full max-w-5xl text-white'>
                <span><i class='fa fa-chevron-left'></i></span>
                <span class="flex justify-center w-full">Get Started</span>
            </div>
            <div class='flex w-full max-w-5xl text-gray-200'>
                <span class="mr-auto">Personal Details</span>
                <div class="flex justify-center gap-1 md:gap-2 lg:gap-3">
                    <span><button class='h-2 w-3 md:h-3 md:w-5 rounded-lg bg-teal-400'></button></span>
                    <span><button class='h-2 w-3 md:h-3 md:w-5 rounded-lg bg-teal-400'></button></span>
                    <span><button class='h-2 w-3 md:h-3 md:w-5 rounded-lg bg-teal-400'></button></span>
                    <span><button class='h-2 w-3 md:h-3 md:w-5 rounded-lg bg-teal-400'></button></span>
                </div>
            </div>
            <div class='flex w-full max-w-5xl text-gray-50 py-3'>
                <div class="text-xl">
                   Upload your profile photo
                </div>
            </div>
        </div>
        <div class='w-full h-full max-w-3xl pt-8 px-4 bg-gray-100 bg-opacity-25'>
            <form class='h-full flex flex-col' method="POST" enctype="multipart/form-data">
                <div class="flex w-full justify-center mb-auto">
                    <button type="button" class='flex justify-center items-center w-32 h-32 md:w-56 md:h-56 bg-white rounded-full overflow-hidden'>
                        <div class='flex edit-photo-btn justify-center'>
                            <span class='w-full h-full text-teal-600'><i class='text-5xl md:text-7xl lg:text-9xl fa fa-camera'></i></span>
                        </div>
                        <div class='hidden'>
                            <img src="" alt="">
                        </div>
                        <div class='hidden'>
                            <div class='flex items-center mb-2'>
                                <label for="picture" class="block text-sm font-medium text-gray-600 mr-auto">Profile Picture</label>
                            </div>
                            <input type="file" name="picture" onchange="previewFile(this);" class="profile-photo bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm md:text-lg font-light block w-full p-2.5 md:py-4">
                        </div>
                    </button>
                    <div></div>


                </div>
                  </p>

                
        <img id="previewImg" src="http://clipart-library.com/img1/1124757.jpg" alt="" style="height:auto; width:100%" class="rounded-lg mt-4">
        <p>
                <div class=" w-full justify-center  fixed bottom-0">

                  <p>
                  <?php
                  if(!empty($msg)){
                      echo $msg;

                  }
                  ?>
                  </p>
                    <button type="submit" class="text-white max-w-xl w-full bg-teal-600 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm md:text-lg px-5 py-2.5 md:p-4 text-center">Create account</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const editPhotoBtn = document.querySelector('.edit-photo-btn');
        const profilePhoto = document.querySelector('.profile-photo');
        editPhotoBtn.addEventListener('click', () => {
            profilePhoto.click();
        })
        profilePhoto.addEventListener('change', (e) => {
            console.log(e.currentTarget.value)
        })
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
        <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
</body>
</html>