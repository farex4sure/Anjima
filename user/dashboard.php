<?php
session_start();
include "config.php";
if(!isset($_SESSION['loggedin_user'])){
    header("location:signin.php");
}
$details = "SELECT * FROM users WHERE phone='".$_SESSION['loggedin_user']."'";
            $result = $conn->query($details);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row["fullname"];
                    $email = $row["email"];
                    $tpin = $row["tpin"];
                    $pic = $row["pic"];
                }
            }
if($tpin == "0"){
    header("location:setpin.php");
}

$wallet = "SELECT * FROM wallet WHERE owner='".$_SESSION['loggedin_user']."'";
            $result = $conn->query($wallet);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $bal = $row["balance"];
                }
            }

$awallet = "SELECT * FROM a_wallet WHERE owner='".$_SESSION['loggedin_user']."'";
            $result = $conn->query($awallet);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $a_bal = $row["balance"];
                }
            }
if(isset($_POST['submit'])){
    $trans_id=$_POST['trans_id'];
    $amt=$_POST['amount'];
    $o_name=$_POST['name'];
    $_SESSION['trans_id']=$trans_id;
    $_SESSION['amt']=$amt;
    $_SESSION['name']=$o_name;
    header("header:receipt.php");
    ?>
    <script>
    window.location.href = "receipt.php";
    </script>
    <?php
}
if(isset($_POST['submit2'])){
    $trans_id=$_POST['trans_id'];
    $amt=$_POST['amount'];
    $o_name=$_POST['name'];
    $_SESSION['trans_id']=$trans_id;
    $_SESSION['amt']=$amt;
    $_SESSION['name']=$o_name;
    header("header:receipt.php");
    ?>
    <script>
    window.location.href = "receipt2.php";
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/jquery.min.js"></script> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
        <div class='flex h-screen flex-col bg-gray-100' style="background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);">

            <!-- HEADER SECTION STARTS HERE -->
            <div class="flex shadow-md border-teal-600 p-4 items-center w-full ">
                <div class=""></div>
                <div class="relative flex  items-center w-full ">
                     <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 us:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                         <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 rounded-full" src="data:image/jpeg;base64,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" alt="user photo">
                     </button>
                     <!-- Dropdown menu -->
                     <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow gray-700 ide-gray-600" id="dropdown" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(956px, 1184px);">
                         <div class="py-3 px-4">
                         <span class="block text-sm text-gray-900 white"><?php echo $name ?></span>
                         <span class="block text-sm font-medium text-gray-500 truncate gray-400"><?php echo $email ?></span>
                         </div>
                         <ul class="py-1" aria-labelledby="dropdown">
                         <li>
                             <a href="profile.php" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 er:bg-gray-600 gray-200 er:text-white"><span><i class="fa fa-user mr-2"></i></span>Profile</a>
                         </li>
                         <li>
                             <a href="logout.php" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 er:bg-gray-600 gray-200 er:text-white"><span><i class="fa fa-sign-out mr-2"></i></span>Sign out</a>
                         </li>
                         </ul>
                     </div>
                      <p class="text-center lg:text-sm font-semibold  "><?php echo $name ?></p>
                </div>
               <div class="fixed  right-0">
                 <button type="button" data-dropdown-toggle="language-dropdown-menu" class="inline-flex justify-center  items-center p-2 text-sm text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 er:bg-gray-700 er:text-white">
                     <span><i class="fa fa-globe mr-2"></i></span>
                     Hausa 
                   </button>
                   <!-- Dropdown -->
                   <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow gray-700" id="language-dropdown-menu">
                     <ul class="py-1" role="none">
                       <li>
                         <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 er:bg-gray-600 er:text-white" role="menuitem">
                           <div class="inline-flex items-center">
                             English 
                           </div>
                         </a>
                       </li>
                       <li>
                         <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 er:bg-gray-600 er:text-white" role="menuitem">
                           <div class="inline-flex items-center">
                            Igbo
                           </div>
                         </a>
                       </li>
                       <li>
                         <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 er:bg-gray-600 er:text-white" role="menuitem">
                           <div class="inline-flex items-center">
                            
                             Yoruba
                           </div>
                         </a>
                       </li>
                       <li>
                         <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 gray-400 er:bg-gray-600 er:text-white" role="menuitem">
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
                <div class='flex justify-center mt-4 w-full rounded-lg py-1 md:mb-6 md:mt-4'>
                    <div class="h-10 w-10 lg:hidden rounded-full md:mr-0 focus:ring-4">
                        <img class='' src="../images/an.png" alt="">
                    </div>
                </div>
                <div class='flex flex-col gap-y-3 mt-3'>
                   <main>
                    <div class="flex justify-between  w-full rounded-md">
                        <div class="">
                            <p class="text-center font-semibold  ">Anjima available Balance</p>
                            <div class="flex ">
                                <p class="text-center font-bold text-green-500 text-2xl w-44 ">&#8358 <?php echo number_format($a_bal); ?> </p>
                       </div>
                        </div>
                        <div class="">
                            
                        <p class="text-center font-semibold  ">Wallet Balance</p>                 
                        <div class="flex justify-between">
                            <p class="text-center text-teal-600 text-2xl font-bold pt-  ">&#8358 <?php echo number_format($bal); ?> </p>
                            <div class="mx-4">
                 <a href="topup.php" class="flex flex-col items-center text-teal-600 justify-center   ">
                        <span class="text-2xl md:text-5xl lg:text-6xl "><i class="fa fa-wallet"></i></span>
                        <span class="font-bold text-2xl"></span>
                        <p class="italic text-sm text-gray-700 text-center"><span class=""></span> </p>
                    </a>
                    </div>
                   </div>    
                    </div>
                    </div>
                    <div id="accordion-color" data-accordion="collapse" data-active-classes="gray-800 text-black white">
                        <div class="flex w-full justify-center items-center">
                            <div class="" id="accordion-color-heading-1">
                                <button type="button" class="flex items-center  w-full p-2 font-medium text-left text-gray-500  rounded-t-xl  gray-400  er:bg-gray-800" data-accordion-target="#accordion-color-body-1" aria-expanded="false" aria-controls="accordion-color-body-1">
                                  <span>Eligibility Status</span>
                                  <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
                        </div>
                        <?php 
                            $loan = "SELECT * FROM collected_loans WHERE phone='".$_SESSION['loggedin_user']."'";
                                $result = $conn->query($loan);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $amt = $row["amt"];
                                    }
                                }else{
                                    $amt=0;
                                }
                                $remain=10000-$amt;
                        ?>
                          <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
                            <div class="p-1 font-light    border-gray-200 der-gray-700 gray-900">
                                <div class="grid grid-cols-2 bg-white rounded-lg bg-opacity-50 my-4 w-full h-full md:grid-cols-4 sm:grid-col-2  justify-items-center  md:py-8">
                                    <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                                        <div class="flex flex-col gap-2">
                                         <span class="font-medium block border-b-2 border-teal-600" >Eligible loan Credit</span>
                                         <p class="italic font- text-gray-700 text-center"><span class="">&#8358 10,000</span> </p>
                                        </div>
                                     </a>
                                     <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                                        <div class="flex flex-col gap-2">
                                         <span class="font-medium block border-b-2 border-teal-600" >Credit Remaining</span>
                                         <p class="italic font- text-gray-700 text-center"><span class="">&#8358 <?php echo number_format($remain) ?></span> </p>
                                        </div>
                                     </a>
                                    <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                                        <div class="flex flex-col gap-2">
                                         <span class="font-medium block border-b-2 border-teal-600" >Credit Used</span>
                                         <p class="italic font- text-gray-700 text-center"><span class="">&#8358 <?php echo number_format($amt) ?></span> </p>
                                        </div>
                                     </a>
                                    <a href="#" class="flex flex-col p-2 items-center text-gray-700 justify-center hover:text-green-500 hover:shadow-lg rounded">
                                       <div class="flex flex-col gap-2">
                                        <span class="font-medium block border-b-2 text-center border-teal-600" >Credit Paid</span>
                                        <p class="italic font- text-gray-700 text-center"><span class="block">&#8358 0 </span> </p>
                                      </div>
                                    </a>
                                </div>  
                              </div>
                          </div>
                    <!-- <p class="text-center  text-md lg:py-3 py-3 ">Services</p> -->
                  <div class="flex flex-col justify-center p-2 bg-opacity-50 bg-white rounded-lg items-center w-full">
                        <div class='w-full px-2 mb-2'>
                            <h3 class='w-full text-sm md:text-lg font-semibold text-gray-600'>Money Transfer</h3>
                        </div>
                        <div class="grid grid-cols-4 h-full md:grid-cols-4 sm:grid-col-2 w-full justify-items-center gap-y-8 gap-x-6 py-1 px- md:py-8">
                        <a href="transfer.php" class="flex flex-col items-center text-teal-600 justify-center  gap-1   ">
                            <img src="images/an.png" class="h-8 w-9 md:h-16 md:w-16" alt="">
                            <span class="font-bold text-2xl"></span>
                            <p class="italic text-xs text-gray-700 text-center"><span class="">Transaction</span> </p>
                        </a>
                        <button class="flex flex-col items-center text-teal-600 justify-center gap-1" id="withdrawDropdownButton" data-dropdown-toggle="withdrawDropdown">
                            <span class="text-3xl md:text-5xl lg:text-6xl "><i class="fa fa-search"></i></span>
                            <span class="font-bold text-2xl"></span>
                            <p class="italic text-sm text-gray-700 text-center"><span class="">Vendors</span> </p>
                        </button>
                            <!-- Dropdown menu -->
                            <div id="withdrawDropdown" class="hidden z-10 ml-5 w-28 bg-white rounded divide-y divide-gray-100 shadow">
                                <ul class="px-[3px] text-sm text-gray-700" aria-labelledby="withdrawDropdownButton">
                                    <li>
                                        <a href="vendors.php" class='flex justify-between items-center py-1 px-1 h-full'>
                                            <span class='text-xs md:text-base'>Vendors</span>
                                            <span class="text-teal-600 text-base md:text-md">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="debtors.php" class='flex justify-between items-center py-1 px-1 h-full'>
                                            <span class='text-xs md:text-base'>debtors</span>
                                            <span class="text-teal-600 text-base md:text-md">
                                                <i class="fa-solid fa-hand-holding-dollar"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <a href="qr.php" class="flex flex-col items-center text-teal-600 justify-center gap-1   ">
                            <span class="text-3xl md:text-5xl lg:text-6xl "><i class="fa fa-qrcode"></i></span>
                            <span class="font-bold text-2xl"></span>
                            <p class="italic text-xs text-gray-700 text-center"><span class="">Scan to pay</span> </p>
                        </a>
                        <a href="messages.php" class="relative flex flex-col items-center text-teal-600 justify-center gap-1   ">
                            <span class="text-3xl md:text-5xl lg:text-6xl "><i class="fa fa-message"></i></span>
                            <span class="font-bold text-2xl"></span>
                            <p class="italic text-sm text-gray-700 text-center"><span class="">Chat</span></p>
                               <?php

// get number of unread messages


include "config.php";
session_start();
$user=$_SESSION['loggedin_user'];

$getNoUmsgs=mysqli_query($conn, "SELECT * FROM chat WHERE mto='$user' AND st='0'");


// number of unread messages

$no=mysqli_num_rows($getNoUmsgs);
if($no=="0"){

}
else{
    ?>
    <div class="inline-flex absolute -top-2 -right-2 justify-center items-center w-4 h-4 text-[10px] text-white bg-red-500 rounded-full">
    <?php echo mysqli_num_rows($getNoUmsgs); ?>
    </div>

<?php

}

                    
    ?>
                    
                        </a>
                    </div>
                  </div>
                    <div class="bg-white rounded-lg bg-opacity-50 mt-4">
                        <a href="transactions.php" class="flex justify-between  items-center pt-4 font-bold text-lg text-gray-700 pb-2 pl-4 ">
                            <h5 class="text-sm font-semibold leading-none text-gray-900 ">Transaction History<i class="fa-solid fa-arrows-rotate px-2"></i></h5>
                            
                            <span class="text-sm font-medium text-teal-600 hover:underline px-4 l-500">
                                View all <i class="fa fa-chevron-right"></i>
                            </span>
                        </a>
                        <ul class="pt-2 pb-4 px-4 space-y-1 text-sm">
                        <?php
                        $fetch = mysqli_query($conn, "SELECT * FROM transfer WHERE tto='".$_SESSION['loggedin_user']."' OR tfrom='".$_SESSION['loggedin_user']."' ORDER BY id DESC LIMIT 5");
                        if($fetch->num_rows > 0){
                            while($row = $fetch->fetch_assoc()){
                                $t_id=$row['id'];
                                $dt=$row['date'];
                                $dt=date("M d, Y", $dt);
                                $camount=$row['tamt'];
                            
                                $sendto=$row['tto'];
                                if ($row['tto'] == $_SESSION['loggedin_user']){
                                    $sendto = $row['tfrom'];
                                }

                                $checkc=mysqli_query($conn, "SELECT * FROM users WHERE phone='$sendto'");
                                
                                // get contact details
                                
                                while ($cc=mysqli_fetch_assoc($checkc)) {
                                    $cfullname=$cc['fullname'];
                                
                    }

                                $checkc=mysqli_query($conn, "SELECT * FROM vendors WHERE phone='$sendto'");
                                
                                // get contact details
                                
                                while ($cc=mysqli_fetch_assoc($checkc)) {
                                    $cfullname=$cc['fullname'];
                                
                    }
                    if($_SESSION['loggedin_user']==$row['tfrom']) {
                        ?>
                            <!-- SENT TRANSFER SECTION STARTS HERE -->
                            <form action="dashboard.php" method="post" class="flex flex-col divide-y border-t">
                                <input hidden type="text"  name="trans_id" value="<?php echo $t_id ?>">
                                <input hidden type="text"  name="amount" value="<?php echo $camount ?>">
                                <input hidden type="text"  name="name" value="<?php echo $cfullname ?>">
                                <button type="submit" name="submit" class='flex items-center justify-between w-full py-2 px-3 h-full'>
                                    <div class='flex gap-2 items-start'>
                                        <div class='text-red-500 pt-1 font-bold'><i class='fa fa-arrow-up'></i></div>
                                        <div class="flex flex-col">
                                            <div class='text-left font-semibold md:text-lg uppercase'><?php echo $cfullname ?></div>
                                            <div class="text-left text-xs md:text-sm italic text-red-500 font-semibold">You transferred <span><?php echo number_format($camount) ?> to <?php echo $cfullname ?></span></div>
                                        </div>
                                    </div>
                                    <div class='flex flex-col justify-start items-center'>
                                        <span class='text-red-500 md:text-lg font-bold'><span class='text-sm md:text-lg font-bold'><i class='fa fa-naira-sign'></i></span><?php echo number_format($camount) ?></span>
                                        <span class='text-xs md:text-sm self-end'><?php echo $dt ?></span>
                                    </div>
                                </button>
                            </form>
                            <!-- SENT TRANSFER SECTION ENDS HERE -->
                            <?php
                    }elseif($_SESSION['loggedin_user']==$row['tto']){
                            ?>
                            <!-- RECEIVED TRANSFER SECTION STARTS HERE -->
                            <form action="dashboard.php" method="post" class="flex flex-col divide-y border-t">
                                <input hidden type="text"  name="trans_id" value="<?php echo $t_id ?>">
                                <input hidden type="text"  name="amount" value="<?php echo $camount ?>">
                                <input hidden type="text"  name="name" value="<?php echo $cfullname ?>">
                            <button type="submit" name="submit2" class='flex items-center justify-between w-full py-2 px-3 h-full'>
                                <div class='flex gap-2 items-start'>
                                    <span class='text-green-500 pt-1 font-bold'><i class='fa fa-arrow-down'></i></span>
                                    <div class="flex flex-col">
                                        <span class='text-left font-semibold md:text-lg uppercase'><?php echo $cfullname ?></span>
                                        <span class="text-left text-xs md:text-sm italic text-green-500 font-semibold">You received <span><?php echo number_format($camount) ?> from <?php echo $cfullname ?></span></span>
                                    </div>
                                </div>
                                <div class='flex flex-col justify-start items-center'>
                                    <span class='text-green-500 md:text-lg font-bold'><span class='text-sm md:text-lg font-bold'><i class='fa fa-naira-sign'></i></span><?php echo number_format($camount) ?></span>
                                    <span class='text-xs md:text-sm self-end'><?php echo $dt ?></span>
                                </div>
                            </button>
                            </form>
                            <!-- RECEIVED TRANSFER SECTION ENDS HERE -->
                            <?php
                    }else{
                        echo "error";
                    }
                    } 
                    
                    }else{
                    echo "No Any Transaction Yet";
                    }
                            ?>
                        </ul>
                    </div>
                     </main>
                    
                </div>
            </div>
        </main>
        <!-- MAIN ENDS HERE -->
        
        <!-- FOOTER STARTS HERE -->
        <footer class='flex w-full justify-center p-3 px-0 border-t border-1 bg-opacity-25'>
            <div class='flex justify-around w-full max-w-5xl'>
                <span class='text-teal-600 text-lg md:text-3xl'>
                    <a href="#"><i class='fa fa-home'></i></a>
                </span>
            </div>
        </footer>
        <!-- FOOOTER ENDS HERE -->
    </div>

    <!-- MODAL SECTION STARTS HERE -->
        <!-- <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md p-4 md:h-auto">
                <div class="relative bg-white rounded-lg shadow gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center er:bg-gray-800 er:text-white" data-modal-toggle="popup-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-14 h-14 t-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 t-gray-400">Are you sure you want to log out?</h3>
                        <a href="logout.php"><button data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 us:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button></a>
                        <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 gray-700 t-gray-300 der-gray-500 er:text-white er:bg-gray-600 us:ring-gray-600">No, cancel</button>
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