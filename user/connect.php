<?php

session_start();
include "config.php";
if(!isset($_SESSION['loggedin_user'])){
    header("location:signin.php");
}

// check user status
$loggedin_user=$_SESSION['loggedin_user'];
include "config.php";
$checkuser=mysqli_query($conn, "SELECT * FROM users WHERE phone='$loggedin_user'");

 while($row = $checkuser->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row["fullname"];
                    $email = $row["email"];
                    $tpin = $row["tpin"];
                    $pic = $row["pic"];
                    $st = $row["st"];

                 if($st=="0"){

                     header("location:kyc.php");

                     ?>

                    <script>
                    window.location.href='kyc.php';
                    </script>
                     <?php

                 }



                }





$details = "SELECT * FROM users WHERE phone='".$_SESSION['loggedin_user']."'";
            $result = $conn->query($details);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row["fullname"];
                    $email = $row["email"];
                    $phone = $row["phone"];
                    $tpin = $row["tpin"];
                    $pic = $row["pic"];
                }
            }
if(isset($_POST['submit'])){
    $checkphone=$_POST['vphone'];
    $_SESSION['checked']=$checkphone;
    header("location:check.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/jquery.min.js"></script> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect with vendors | Anjima</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
        <div class='flex h-screen flex-col bg-gray-100' style="background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);">

       <!-- HEADER SECTION STARTS HERE -->
            <div class="flex   items-center w-full md:order-2 ">
                <div class="fixed bottom-0 right-0">
                    <button type="button" data-dropdown-toggle="language-dropdown-menu" class="inline-flex justify-center  items-center p-2 text-sm text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 -gray-700 xt-white">
                        <span><i class="fa fa-globe mr-2"></i></span>
                        Hausa 
                    </button>
                    <!-- Dropdown -->
                    <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow 700" id="language-dropdown-menu">
                        <ul class="py-1" role="none">
                        <li>
                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 -gray-600 xt-white" role="menuitem">
                            <div class="inline-flex items-center">
                                English 
                            </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 -gray-600 xt-white" role="menuitem">
                            <div class="inline-flex items-center">
                                Igbo
                            </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 -gray-600 xt-white" role="menuitem">
                            <div class="inline-flex items-center">
                                
                                Yoruba
                            </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 -gray-600 xt-white" role="menuitem">
                            <div class="inline-flex items-center">
                                Fulani
                            </div>
                            </a>
                        </li>
                        </ul>
                    </div>
                </div>
                </div>
           <div class="  bg-teal-600 py-3">
            <div class="relative flex justify-between  items-center w-full p-3 ">
                <a href="vendors.php">
                 <i class="fa-solid fa-angle-left text-white "></i>
                </a>
                 <button type="button" class="flex  text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 ng-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                     <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="../user/images/<?php echo $pic; ?>" alt="">
                 </button>
                 <!-- Dropdown menu -->
                 <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow 700 ray-600" id="dropdown" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(956px, 1184px);">
                     <div class="py-3 px-4">
                     <span class="block text-sm text-gray-900 white">
                     <?php
                     echo $name;

                     ?>

                     </span>
                     <span class="block text-sm font-medium text-gray-500 truncate gray-400">
                     <?php
                    echo $phone;



                     ?>
                     </span>
                     </div>
                     <ul class="py-1" aria-labelledby="dropdown">
                     <li>
                         <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 -gray-600 gray-200 xt-white"><span><i class="fa fa-user mr-2"></i></span>Profile</a>
                     </li>
                     <li>
                         <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 -gray-600 gray-200 xt-white"><span><i class="fa fa-wrench mr-2"></i></span>Settings</a>
                     </li>
                     
                     <li>
                         <a href="logout.pho" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 -gray-600 gray-200 xt-white"><span><i class="fa fa-sign-out mr-2"></i></span>Sign out</a>
                     </li>
                     </ul>
                 </div>
            </div>
             <div class="justify-center items-center p-3  ">
                <form class="flex  items-center">   
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-teal-500 al-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="text" id="simple-search" class="bg-teal-50 border border-teal-300 text-teal-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  -700 teal-600 lder-teal-400 ite ing-blue-500 order-blue-500" placeholder="Search" required="">
                    </div>
                    <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-teal-400 rounded-lg border border-teal-600 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-blue-300 -600 g-blue-700 ing-blue-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="sr-only">Search</span>
                    </button>
                </form>
             </div>
             <p class="text-center text-2xl font-bold text-white py-3">
             <?php
            echo base64_decode($_GET['cat']);


             ?>
             </p>
           </div>
       <!-- HEADER SECTION ENDS HERE -->
        <!-- MAIN STARTS HERE -->
        <main class='flex justify-center mb-auto h-full overflow-auto'>
            <div class='h-full w-full max-w-6xl  px-3 md:px-5 lg:px-8'>
                        <div class='flex flex-col gap-y-3 mt-3'>
                    <main>
                  
                            
    <!-- <div class="flex justify-between items-center mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 te">Latest Customers</h5>
        <a href="#" class="text-sm font-medium text-teal-600 hover:underline l-500">
            View all
        </a>
   </div> -->
   <div class="flow-root">
        <ul role="list" class="divide-y divide-gray-200">


        <?php
$category=base64_decode($_GET['cat']);
        // get vendors  

        // get only verified vendors

        $getVVendors=mysqli_query($conn, "SELECT * FROM vendors WHERE category='$category' AND st='1'");

if(mysqli_num_rows($getVVendors) > 0){




while($vendors=mysqli_fetch_assoc($getVVendors)){

// get vendors dtails

$vname=$vendors['fullname'];
$vphone=$vendors['phone'];
$vpic=$vendors['pic'];

//get the vendor address in kyc table

$getVD=mysqli_query($conn, "SELECT * FROM kyc WHERE phone='$vphone'");

while($vkyc=mysqli_fetch_assoc($getVD)){

$vaddress=$vkyc['address'];
$vlg=$vkyc['lga'];
$vstate=$vkyc['state'];





        ?> 
            
          
            
        <div class=" shadow-lg bg-white p-2 my-2">
            <form action="connect.php" method="post">
                <button type="submit" name="submit" class="text-left w-full py- sm:py-">
                <input type="text" name="vphone" hidden value="<?php echo $vphone ?>">
                    <div class="flex items-center ">
                        <div class="flex-shrink-0 mr-3">
                            <img class="w-10 h-10 rounded-full" src="../vendors/vendor/<?php echo $vpic; ?>" alt="Default avatar">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-md font-medium text-teal-600 truncate ">
                            <?php
                            echo $vname;
                            ?>
                            </p>
                            <p class="text-sm text-gray-500 truncate ">
                            <?php echo $vlg ." , " .$vstate; 
                            ?>
                            </p>
                            <span class="text-sm font-medium text-teal-600 w-64 truncate block ">
                                Shop Address: <span class="text-sm  text-black truncate"><?php
                                echo $vaddress;
                                ?>
                                </span>
                            </span>
                        </div>
                    </div>
                </button>
            <form>
        </div>



<?php
// vendor ends here

}



}





}


else{



    echo "No result found";
}


?>







        </ul>
   </div>
</div>
  
                     </main>
                    
                </div>
            </div>
        </main>
        <!-- MAIN ENDS HERE -->
        
        <!-- FOOTER STARTS HERE -->
        <!-- <footer class='flex w-full justify-center p-3 px-0 border-t border-1 bg-opacity-25'>
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
        </footer> -->
        <!-- FOOOTER ENDS HERE -->
    </div>

    <!-- MODAL SECTION STARTS HERE -->
        <!-- <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md p-4 md:h-auto">
                <div class="relative bg-white rounded-lg shadow 700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center -gray-800 xt-white" data-modal-toggle="popup-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-14 h-14 y-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 y-400">Are you sure you want to log out?</h3>
                        <a href="logout.php"><button data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 ng-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button></a>
                        <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 700 y-300 ray-500 xt-white -gray-600 ng-gray-600">No, cancel</button>
                    </div>
                </div>
            </div>
        </div> -->
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