<?php
session_start(); 
 $err="";

if(isset($_SESSION["loggedin_user"])){
header("Location:dashboard.php");
                ?>
                <script type="text/javascript">
                  window.location.href="dashboard.php";
                </script>
                <?php

}
include "config.php";

if ($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['phone']) && isset($_POST['pwd'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $phone = $_POST['phone'];

$phone=ltrim($phone, "+2340");
$phone="+234".$phone;
    $pwd = validate(md5($_POST['pwd']));

    if (empty($phone)) {

      $err= "Phone number or email address is required";

      

    }else if(empty($pwd)){

        $err= "Password is required";

      

    }else{

        $sql = "SELECT * FROM users WHERE phone='$phone'  AND pwd='$pwd' OR email='$phone' AND pwd='$pwd'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

          
              

                $_SESSION['loggedin_user'] = $row['phone'];
               

                $err=" <script>
             
                   window.location.href = 'dashboard.php';
              
               </script>
         ";

                
                

             

           

        }else{

            $err="<span class='text-sm text-red-500  dark:bg-red-200 dark:text-red-800' role='alert'>
         Incorrect Login Credentials
          </span>";

       

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
    <title>Anjima | User Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
    <div class='h-screen flex flex-col items-center bg-gradient-to-r from-teal-900 to-sky-900 font-bold bg-no-repeat bg-cover' style='background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);'>
        <div class='flex w-full justify-center px-2 py-4 shadow bg-gray-100 bg-opacity-25'>
            <div class='w-32 md:w-44'>
                <img src="../images/anj.png" alt="">
            </div>
        </div>
        <div class='mb-6 w-full'>
            <div class='flex divide-x-2 w-full'>
                <a href="#" class='flex py-3 md:py-4 bg-teal-600 text-teal-50 bg-opacity-75 justify-center w-full'>User Login</a>
                <a href="../vendors/vendor_signin.php" class='flex py-3 bg-white text-teal-600 bg-opacity-75 hover:bg-teal-600 hover:bg-opacity-75 hover:text-teal-50 justify-center w-full'>Vendor Login</a>
            </div>
        </div>
        <div class='w-full max-w-5xl px-4'>
            <div class='mb-12'>
                <div class='text-lg lg:text-5xl text-gray-600'>
                    <span>😁</span>
                    <span>Welcome</span>
                </div>
            </div>
            <div>
                <form method="POST">
                    <div class="mb-6">
                        <div class='flex items-center mb-2'>
                            <label for="phone-email" class="block text-sm font-medium text-gray-900 dark:text-gray-300 mr-auto">Mobile</label>
                        </div>
                        <input type="text" id="phone-email" name="phone" class="bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm md:rounded-lg focus:outline-none focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5" placeholder="Email/Phone" required="">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
                        <input type="password" name="pwd" id="password" class="bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm md:rounded-lg focus:outline-none focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5" placeholder="Password" required="">
                    </div>
                    <div class="flex items-start mb-6">
                        <div class=" items-center h-5 text-gray-700">
                        <span><?php
                        
                        if(!empty($err)){

                            echo $err;
                        }
                        ?>
                        </span>
                        
                            <p><a href="#" class="focus:teal-600 hover:teal-600">Forgot Password?</a>
                            </p>
                        </div>
                    </div>
                    <button type="submit" class="text-white bg-teal-600 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Sign in</button>
                </form>
            </div>
            <div class="mt-8 border p-3 rounded-lg bg-gray-300 bg-opacity-50">
                <span class='flex items-center text-xs'>
                    <span class='mr-auto'>Don't have an Anjima Account?</span>
                    <a href='signup.php' class='text-teal-600'><i class="fa fa-user-plus"></i> Sign Up</a>
                </span>
            </div>
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