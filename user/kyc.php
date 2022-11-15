<?php
session_start();
include "config.php";
if(!isset($_SESSION['loggedin_user'])){
    header("location:signin.php");
}

$err="";
if(isset($_POST['submit'])){
    $nin=$_POST['nin'];
    

$data = "number=$nin";
$curl = curl_init();
// $encode=json_encode($data);
curl_setopt_array($curl, [
  CURLOPT_URL => "https://sandbox.myidentitypass.com/api/v2/biometrics/merchant/data/verification/nin_wo_face",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => [
    "x-api-key: test_ucc8c5fyl6rl78idn3lqjp:ogINip3R6hrzzARkTI42vv13ybY",
    "app-id: 17186c39-023b-40d6-8889-768104e94e07"
    // "accept: application/json",
    // "content-type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $resp = json_decode($response,true);
//  var_dump ($resp);

if(isset($resp['nin_data'])){

    $_SESSION['fname']=$resp['nin_data']['firstname'];
    $_SESSION['sname']=$resp['nin_data']['surname'];
    $_SESSION['title']=$resp['nin_data']['title'];
    $_SESSION['country']=$resp['nin_data']['birthcountry'];
    $_SESSION['dob']=$resp['nin_data']['birthdate'];
    $_SESSION['b_lga']=$resp['nin_data']['birthlga'];
    $_SESSION['b_state']=$resp['nin_data']['birthstate'];
    $_SESSION['email']=$resp['nin_data']['email'];
    $_SESSION['phone']=$resp['nin_data']['telephoneno'];
    $_SESSION['nins']=$resp['nin_data']['nin'];
    $_SESSION['add']=$resp['nin_data']['residence_address'];
    $_SESSION['res_town']=$resp['nin_data']['residence_town'];
    $_SESSION['res_state']=$resp['nin_data']['residence_state'];
    $_SESSION['trackingid']=$resp['nin_data']['trackingId'];
    $date=time();
    $_SESSION['fullname']=$_SESSION['fname']." ".$_SESSION['sname'];

    header("location:kyc2.php");

}else{
    $err = '<div id="alert-border-3" class="flex p-4 mb-4 bg-red-100 border-t-4 border-red-500 dark:bg-red-200" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium text-red-700">
                            Invalid NIN
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 dark:bg-red-200 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 dark:hover:bg-red-300 inline-flex h-8 w-8"  data-dismiss-target="#alert-border-3" aria-label="Close">
                            <span class="sr-only">Dismiss</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>';
}
//  $re = $resp['detail'];
//  echo $re;
  
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
    <title>K.Y.C Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
        <div class='flex h-screen flex-col bg-gray-100' style="background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);">

       <!-- HEADER SECTION STARTS HERE -->
           <div class=" flex justify-between items-center bg-teal-600 py-3">
               <a href="dashboard.php">
                <i class="fa fa-arrow-left text-white px-2"></i>
               </a>
             <div class=" flex  items-center p  w-full">
             <div class="items-center">
                <p class="  font-bold text-lg pr-8  text-white "><span class="">Registration</span> </p>
             </div>
                <div class="flex   items-center md:order-2 ">
                    <div class="fixed right-0">
                        <button type="button" data-dropdown-toggle="language-dropdown-menu" class="inline-flex justify-center  items-center p-2 text-sm text-white rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span><i class="fa fa-globe mr-2"></i></span>
                        Language
                        </button>
                        <!-- Dropdown -->
                        <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700" id="language-dropdown-menu">
                            <ul class="py-1" role="none">
                            <li>
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                <div class="inline-flex items-center">
                                    English 
                                </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                <div class="inline-flex items-center">
                                    Hausa
                                </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                <div class="inline-flex items-center">
                                    Igbo
                                </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                <div class="inline-flex items-center">
                                    
                                    Yoruba
                                </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                <div class="inline-flex items-center">
                                    Fulani
                                </div>
                                </a>
                            </li>
                            </ul>
                        </div>
                    </div>
                    </div>
             </div>
           </div>
          

       <!-- HEADER SECTION ENDS HERE -->

        <!-- MAIN STARTS HERE -->
        <main class='flex justify-center mt-5 mb-auto h-full overflow-auto'>
            <div class='h-full w-full max-w-6xl  px-3 md:px-5 lg:px-8'>
                <div class='flex flex-col gap-y-3 mt-3'>
                    <?php echo $err ?>
                    <form action="kyc.php" method="post" class='w-full flex flex-col items-center justify-center h-96 px-6'>
                        <div class="relative z-0 mb-6 w-full max-w-md group">
                            <input type="text" name="nin" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-teal-500 focus:outline-none focus:ring-0 focus:border-teal-600 peer" placeholder=" " required="">
                            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-teal-600 peer-focus:dark:text-teal-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 font-bold peer-focus:-translate-y-6">National Identity Number (N.I.N.)</label>
                        </div>
                        <button type="submit" name="submit" class="text-white bg-teal-600 hover:bg-teal-400 my-8 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Submit</button>
                    </form>
                </div>
            </div>
        </main>
        <!-- MAIN ENDS HERE -->
        <script>
            // TOOGLE FORM HIDE-SHOW BUTTON
            const editPhotoBtn = document.querySelector('.edit-photo-btn');
            const profilePhoto = document.querySelector('.profile-photo');
            editPhotoBtn.addEventListener('click', () => {
                profilePhoto.click();
            })
            const passwordDisplayToggle = document.querySelectorAll('.password-display-toggle');
            passwordDisplayToggle.forEach((toggle) => {
                toggle.addEventListener('click', (e) => {
                    toggle.classList.toggle('hide')
                    let type = toggle.classList.contains('hide')? 'password': 'text';
                    e.currentTarget.querySelectorAll('span').forEach(span => {
                        span.classList.toggle('hidden')
                    });
                    let input = e.currentTarget.parentElement.parentElement.querySelector('input');
                    input.type = `${type}`;
                    toggle.classList.toggle('text-cyan-500');
                })
            });
        </script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
        <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
        <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
</body>
</html>