
<?php
session_start();

include "config.php";






if(!isset($_SESSION['loggedin_user'])){
header("location:signin.php");


?>
<script>
window.location.href="signin.php";
</script>

<?php
}


else{


    function timeago($ptime)
{
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'Just now';
    }

    $condition = array(
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return  $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}






$loggedin_user=$_SESSION['loggedin_user'];

//user details
$getUserDetails=mysqli_query($conn, "SELECT * FROM users WHERE phone='$loggedin_user'");

while($row=mysqli_fetch_assoc($getUserDetails)){

$fullname=$row["fullname"];
$phone=$row["phone"];
$email=$row["email"];
$pic=$row["pic"];
$tier=$row["tier"];






}


// wallet balance
$getWalletBal=mysqli_query($conn, "SELECT * FROM wallet WHERE owner='$phone'");
while($r=mysqli_fetch_assoc($getWalletBal)){

$bal=$r['balance'];

}



// anjima loan wallet balance
$getaWalletBal=mysqli_query($conn, "SELECT * FROM a_wallet WHERE owner='$phone'");
while($ra=mysqli_fetch_assoc($getaWalletBal)){

$abal=$ra['balance'];

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/jquery.min.js"></script> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anjima | Vendor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
    <div class='flex h-screen flex-col bg-gray-100'  style="background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);">

            <!-- HEADER SECTION STARTS HERE -->
            <div class="flex  p-6 items-center w-full md:order-2 ">
                <div class=""></div>
                <div class="flex justify-end items-center w-full left-0">
                     <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                         <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 rounded-full" src="images/<?php echo $pic; ?>" alt="<?php echo $fullname; ?>" title="<?php echo $fullname; ?>">
                     </button>
                     <!-- Dropdown menu -->
                     <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(956px, 1184px);">
                         <div class="py-3 px-4">
                         <span class="block text-sm text-gray-900 white"> <?php
                            echo "&nbsp; ".$fullname;
                            ?>
                           </span>
                         <span class="block text-sm font-medium text-gray-500 truncate gray-400">
                             <?php
                            echo $phone;
                            ?></span>
                         </div>
                         <ul class="py-1" aria-labelledby="dropdown">
                         <li>
                             <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 gray-200 dark:hover:text-white"><span><i class="fa fa-user mr-2"></i></span>Profile</a>
                         </li>
                         <li>
                             <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 gray-200 dark:hover:text-white"><span><i class="fa fa-wrench mr-2"></i></span>Settings</a>
                         </li>
                         
                         <li>
                             <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 gray-200 dark:hover:text-white"><span><i class="fa fa-sign-out mr-2"></i></span>Sign out</a>
                         </li>
                         </ul>
                     </div>
                      <p class="text-center lg:text-sm font-semibold  "><?php
                         echo $fullname;
                         ?></p>
                </div>
               <div class="fixed bottom-0 right-0">
                 <button type="button" data-dropdown-toggle="language-dropdown-menu" class="inline-flex justify-center mb-10 items-center p-2 text-sm text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                     <span><i class="fa fa-globe mr-2"></i></span>
                     Hausa 
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
  
       <!-- HEADER SECTION ENDS HERE -->

        <!-- MAIN STARTS HERE -->
        <main class='flex justify-center mb-auto h-full overflow-auto'>
            <div class='h-full w-full max-w-6xl  px-3 md:px-5 lg:px-8'>
                <div class='flex justify-center w-full rounded-lg py-1 md:mb-6 md:mt-4'>
                    <div class="h-8 w-8  lg:hidden rounded-full md:mr-0 focus:ring-4">
                        <img class='' src="../images/an.png" alt="">
                    </div>
                </div>
                <div class='flex flex-col gap-y-3 mt-3'>
                    <main>
                        <div class="flex flex-no-wrap overflow-hidden">
                            <!-- Sidebar starts -->
                         <!-- Remove class [ hidden ] and replace [ sm:flex ] with [ flex ] -->
                        <!-- Remove class when adding a card block -->
                         <div class="container md:w-full px-">
                              <div class="w-full h-screen overflow-y-auto rounded border-gray-300">
                   <main>
                    <div class=" w-full rounded-md mt-6 lg:mt-1 ">
                        <p class="text-center font-semibold  ">Wallet Balance</p>
                        <p class="text-center text-teal-600 text-2xl font-bold pt-  ">&#8358 3,000 </p>
                        <p class="text-center font-semibold  ">Anjima available Balance</p>
                            <div class="flex justify-center">
                                <p class="text-center font-bold text-green-500 text-2xl w-44 border-b-2 border-teal-600">&#8358 5000 </p>
                
                            </div>
                    </div>
                    <div id="accordion-color" data-accordion="collapse" data-active-classes="dark:bg-gray-800 text-black white">
                        <div class="flex w-full justify-center items-center">
                            <div class="" id="accordion-color-heading-1">
                                <button type="button" class="flex items-center  w-full p-2 font-medium text-left text-gray-500  rounded-t-xl  gray-400  dark:hover:bg-gray-800" data-accordion-target="#accordion-color-body-1" aria-expanded="false" aria-controls="accordion-color-body-1">
                                  <span>Eligibility Status</span>
                                  <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
                        </div>
                          <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
                            <div class="p-1 font-light    border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <div class="grid grid-cols-2 w-full h-full md:grid-cols-3 sm:grid-col-2  justify-items-center  md:py-8">
                                    <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                                        <div class="flex flex-col gap-2">
                                         <span class="font-medium block border-b-2 border-teal-600" >Eligible loan amount</span>
                                         <p class="italic font- text-gray-700 text-center"><span class="">&#8358 3,000</span> </p>
                                        </div>
                                     </a>
                                     <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                                        <div class="flex flex-col gap-2">
                                         <span class="font-medium block border-b-2 border-teal-600" >Amount Remaining</span>
                                         <p class="italic font- text-gray-700 text-center"><span class="">&#8358 3,000</span> </p>
                                        </div>
                                     </a>
                                    <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                                        <div class="flex flex-col gap-2">
                                         <span class="font-medium block border-b-2 border-teal-600" >Amount Used</span>
                                         <p class="italic font- text-gray-700 text-center"><span class="">&#8358 3,000</span> </p>
                                        </div>
                                     </a>
                                    <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                                       <div class="flex flex-col gap-2">
                                        <span class="font-medium block border-b-2 text-center border-teal-600" >Amount Paid</span>
                                        <p class="italic font- text-gray-700 text-center"><span class="block">&#8358 3,000 </span> </p>
                                        <!-- <p class="italic font- text-gray-700 text-center"><span class="">&#8358 3,000</span> </p> -->
                                      </div>
                                    </a>
                                </div>  
                              </div>
                          </div>
                    <!-- <p class="text-center  text-md lg:py-3 py-3 ">Services</p> -->
                  <div class="flex justify-center pt-2 items-center w-full">
                  <div class="grid grid-cols-2 h-full md:grid-cols-3 sm:grid-col-2 w-full justify-items-center gap-y-8 gap-x-8 py-1 px- md:py-8">
                        <a href="#" class="flex flex-col items-center text-teal-600 justify-center  gap-2   ">
                            <span class="text-3xl md:text-5xl lg:text-6xl "><i class="fa fa-exchange"></i></span>
                            <span class="font-bold text-2xl"></span>
                            <p class="italic font-bold text-gray-700 text-center"><span class="">Transfer</span> </p>
                        </a>
                        <!-- <a href="vendors.html" class="flex flex-col items-center text-gray-700 justify-center gap-4  p-4 bg-white h-38  hover:text-green-500 hover:shadow-lg rounded">
                            <span class="text-3xl md:text-5xl lg:text-6xl "><i class="fa fa-ils"></i></span>
                            <span class="font-bold text-2xl"></span>
                            <p class="italic font-bold text-gray-700 text-center"><span class="">Request f Credit</span> </p>
                        </a> -->
                        <a href="#" class="flex flex-col items-center text-teal-600 justify-center gap-2   ">
                            <span class="text-3xl md:text-5xl lg:text-6xl "><i class="fa fa-industry"></i></span>
                            <span class="font-bold text-2xl"></span>
                            <p class="italic font-bold text-gray-700 text-center"><span class="">Vendors</span> </p>
                        </a>
                    </div>
                  </div>
                    <div>
                        <p class=" pt-8 font-bold text-lg text-gray-700 pb-4 pl-6"><span class="">Transaction History</span> </p>
                        <ul class="pt-2 pb-4 px-4 space-y-1 text-sm">
                            <li class="rounded-sm">
                                <div class="flex items-start">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <i class="fa fa-arrow-up text-red-700" aria-hidden="true"></i>  
                                        </div>
                                        <label for="remember" class="ml-2 text-md font-medium  ">Alh Musa</label>
                                    </div>
                                    <a href="#" class="ml-auto text-sm text-red-700 hover:underline teal-600">- &#8358 300,000</a>
                                </div>
                                <p class="text-xs pl-6 ">january </p>
                            </li>
                            <li class="rounded-sm pt-6">
                                <div class="flex items-start">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <i class="fa fa-arrow-down text-green-700" aria-hidden="true"></i>  
                                        </div>
                                        <label for="remember" class="ml-2 text-md font-medium  ">Alh Danjuma</label>
                                    </div>
                                    <a href="#" class="ml-auto text-sm text-green-500 hover:underline teal-600">&#8358 300,000</a>
                                </div>
                                <p class="text-xs pl-6 ">january </p>
                            </li>
                            <li class="rounded-sm pt-6">
                                <div class="flex items-start">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <i class="fa fa-arrow-up text-red-700" aria-hidden="true"></i>  
                                        </div>
                                        <label for="remember" class="ml-2 text-md font-medium  ">Hajiya Maryam</label>
                                    </div>
                                    <a href="#" class="ml-auto text-sm text-red-700 hover:underline teal-600">- &#8358 300,000</a>
                                </div>
                                    <p class="text-xs pl-6 ">january </p>
                           </li>
                           <li class="rounded-sm pt-6">
                            <div class="flex items-start">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <i class="fa fa-arrow-up text-red-700" aria-hidden="true"></i>  
                                    </div>
                                    <label for="remember" class="ml-2 text-md font-medium  ">Hajiya Maryam</label>
                                </div>
                                <a href="#" class="ml-auto text-sm text-red-700 hover:underline teal-600">- &#8358 300,000</a>
                            </div>
                                <p class="text-xs pl-6 ">january </p>
                       </li>
                           <!-- <li class="rounded-sm pt-">
                            <div class="flex items-start">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <i class="fa fa-bullseye hidden" aria-hidden="true"></i>  
                                    </div>
                                    <label for="remember" class="ml-2 text-md font-medium hidden ">Hajiya Maryam</label>
                                </div>
                                <a href="transaction.html" class="ml-auto text-sm text-black  hover:underline">see more</a>
                            </div>
                                <p class="text-xs pl-6 hidden ">january </p>
                       </li>
                        -->
                        </ul>
                       <a href="transaction.html">
                        <div class="flex w-full items-center justify-center">
                            <!-- <i class="fa fa-list text-black px-2 " aria-hidden="true"></i>   -->
                            <p class="hover:underline text-md hover:text-teal-600 ">see more</p>
                        </div>
                       </a>
                    </div>
                       </main>
                     </main>
                    
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

    <!-- MODAL SECTION STARTS HERE -->
        <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md p-4 md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to log out?</h3>
                        <a href="logout.php"><button data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button></a>
                        <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- MODAL SECTION ENDS HERE -->
    
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
        <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
</body>
</html>

<?php
}

?>