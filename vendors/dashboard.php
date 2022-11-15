<?php
session_start();
include "config.php";
if(!isset($_SESSION['loggedin_vendor'])){
    header("location:vendor_signin.php");
}
$details = "SELECT * FROM vendors WHERE phone='".$_SESSION['loggedin_vendor']."'";
            $result = $conn->query($details);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row["fullname"];
                    $tpin = $row["tpin"];
                    $pic = $row["pic"];
                }
            }
if($tpin == "0"){
    header("location:setpin.php");
}
$balance = "SELECT * FROM wallet WHERE owner='".$_SESSION['loggedin_vendor']."'";
            $result = $conn->query($balance);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $balance = $row["balance"];
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
    <title>Anjima | Vendor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
    <div class='flex h-screen flex-col bg-gray-100' style='background-image: url("data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z")'>

        <!-- HEADER STARTS HERE -->
        <header class='flex justify-center p-3 shadow mb-4 md:px-8 bg-gray-300 bg-opacity-25'>
            <div class='flex items-center w-full max-w-6xl'>
                <div class='flex items-center gap-2 mr-auto' id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider">
                    <div class='flex items-center justify-center w-8 h-8 md:w-12 md:h-12 rounded-full bg-teal-100 object-cover overflow-hidden'>
                        <img class='h-full w-full' src="vendor/<?php echo $pic ?>" alt="">
                    </div>
                    <span class='font-semibold md:text-lg'><?php echo $name ?></span>
                </div>
    

                <!-- Dropdown menu -->
                <div id="dropdownDivider" class="hidden z-10 w-32 md:w-36 bg-white rounded divide-y divide-gray-100 shadow">
                    <ul class="px-[3px] text-sm text-gray-700" aria-labelledby="dropdownDividerButton">
                        <li>
                            <a href="profile.php" class="flex justify-between items-center w-full text-xs py-2 px-1 hover:bg-gray-100">My Profile <i class="fa-solid fa-user text-teal-600"></i></a>
                        </li>
                        <li>
                            <a href="cpass.php" class="flex justify-between items-center w-full text-xs py-2 px-1 hover:bg-gray-100">Change Password <i class="fa-solid fa-key text-teal-600"></i></a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center w-full text-xs py-2 px-1 hover:bg-gray-100">Change Pin <i class="fa-solid fa-edit text-teal-600"></i></a>
                        </li>
                        <li>
                            <button type="button" data-modal-toggle="popup-modal" class="flex justify-between items-center w-full text-xs py-2 px-1 hover:bg-gray-100">Sign Out <i class="fa-solid fa-power-off text-red-500"></i></button>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <!-- HEADER ENDS HERE -->

        <!-- MAIN STARTS HERE -->
        <main class='flex justify-center mb-auto h-full overflow-auto'>
            <div class='flex flex-col h-full w-full max-w-6xl shadow px-3 md:px-5 lg:px-8'>
                <div class='flex justify-center w-full rounded-lg py-1 md:mb-6 md:mt-4'>
                    <div class='w-32 md:w-44'>
                        <img class='' src="../images/anj.png" alt="">
                    </div>
                </div>
                <div class='flex flex-col h-full gap-y-3 mt-3'>
                    <!-- BALANCE SECTION STARTS HERE -->
                    <div class='flex w-full justify-between items-center px-3 py-2 md:py-4 md:px-6 bg-white bg-opacity-75 rounded-full'>
                        <div class='flex w-full gap-2'>
                            <button class='text-teal-600'><i class='fa fa-refresh'></i></button>
                            <div class='flex w-full justify-between gap-1 items-center'>
                                <div class='flex items-center gap-x-1 text-base md:text-lg'>Balance
                                    <span class='text-sm'><i class='fa fa-naira-sign'></i></span>
                                    <span class='account-balance font-bold text-teal-500'><?php echo number_format($balance); ?></span>
                                    <span class='hidden alternate-account-balance flex items-center text-base md:text-lg font-bold text-teal-500'>*****</span>
                                </div>
                                <button class='toggle-show-balance show'>
                                    <span class='hidden toggle-show-balance-btn'><i class='fa fa-eye'></i></span>
                                    <span class='toggle-show-balance-btn'>
                                        <i class='fa fa-eye-slash'></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- BALANCE SECTION ENDS HERE -->
                    
                    <!-- TRANSFER SECTION STARTS HERE -->
                    <div class='flex flex-col w-full px-3 py-2 md:py-4 md:px-6 bg-white bg-opacity-75 rounded-lg'>
                        <div class='w-full flex justify-between mb-2'>
                            <h3 class='text-sm md:text-lg font-semibold text-gray-600'>Money Transfer</h3>
                            <a href="topup.php" class='text-sm md:text-lg font-semibold text-gray-600'><i class="fa fa-wallet"></i></a>
                        </div>
                        <div class='flex items-start justify-between w-full py-2 px-3 h-full '>
                            <button class='flex flex-col items-center h-full md:gap-1'  id="withdrawDropdownButton" data-dropdown-toggle="withdrawDropdown">
                                <span class="text-teal-600 text-xl md:text-3xl lg:text-4xl">
                                    <i class='fa fa-bank'></i>
                                </span>
                                <span class='text-xs md:text-base'>Transfer</span>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="withdrawDropdown" class="hidden z-10 ml-5 w-28 bg-white rounded divide-y divide-gray-100 shadow">
                                <ul class="px-[3px] text-sm text-gray-700" aria-labelledby="withdrawDropdownButton">
                                    <li>
                                        <a href="anjima.php" class='flex justify-between items-center py-1 px-1 h-full'>
                                            <span class='text-xs md:text-base'>To Anjima</span>
                                            <span class='h-4 w-4 md:h-5 md:w-5'>
                                                <img src="../images/an.png" alt="">
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class='flex justify-between items-center py-1 px-1 h-full'>
                                            <span class='text-xs md:text-base'>To Bank</span>
                                            <span class="text-teal-600 text-base md:text-md">
                                                <i class='fa fa-bank'></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <a href='debtors.php' class='flex flex-col items-center h-full md:gap-1'>
                                <span class="text-teal-600 text-xl md:text-3xl lg:text-4xl">
                                    <i class="fa-solid fa-hand-holding-dollar"></i>
                                </span>
                                <span class='text-xs md:text-base'>Debtors</span>
                            </a>
                            <a href='messages.php' class='flex flex-col items-center h-full md:gap-1'>
                                <span class="text-teal-600 text-xl md:text-3xl lg:text-4xl">
                                    <i class='fa fa-comment-dots'></i>
                                </span>
                                <span class='text-xs md:text-base'>Messages</span>
                                <?php
                                // get number of unread messages
                                include "config.php";
                                session_start();
                                $vendor=$_SESSION['loggedin_vendor'];
                                $getNoUmsgs=mysqli_query($conn, "SELECT * FROM chat WHERE mto='$vendor' AND st='0'");
                                
                                // number of unread messages
                                $no=mysqli_num_rows($getNoUmsgs);
                                if($no=="0"){}
                                else{
                                    ?>
                                    <div class="inline-flex absolute -top-2 -right-2 justify-center items-center w-4 h-4 text-[10px] text-white bg-red-500 rounded-full">
                                    <?php echo mysqli_num_rows($getNoUmsgs); ?>
                                    </div>
                                <?php

                                }                       
                                ?>
                            </a>
                            <a href='scanner/src/index.php' class='flex flex-col items-center h-full md:gap-1'>
                                <span class="text-teal-600 text-xl md:text-3xl lg:text-4xl">
                                    <i class='fa fa-qrcode'></i>
                                </span>
                                <span class='text-xs md:text-base'>Receive</span>
                            </a>
                        </div>
                    </div>
                    <!-- TRANSFER SECTION ENDS HERE -->
                    
                    <!-- TRANSACTION HISTORY SECTION STARTS HERE -->
                        <div class='flex flex-col w-full h-full px-3 py-4 bg-white bg-opacity-75 rounded-lg'>
                            <a href="transactions.php">
                                <div class='flex items-center w-full mb-2 py-1'>
                                    <div class='flex items-center gap-1 mr-auto'>
                                        <h3 class='w-full text-sm md:text-lg font-semibold text-gray-600'>Transaction History</h3>
                                        <button class='text-teal-600 text-sm'><i class='fa fa-refresh'></i></button>
                                    </div>
                                    <button class='text-sm text-teal-600 capitalize'><span>see all </span><i class='fa fa-chevron-right'></i></button>
                                </div>
                            </a>
                        <!-- TRANSACTION DETAILS SECTION STARTS HERE -->
                        <div class='flex flex-col h-full border-t border-b'>
                        <?php
                        $fetch = mysqli_query($conn, "SELECT * FROM transfer WHERE tto='".$_SESSION['loggedin_vendor']."' OR tfrom='".$_SESSION['loggedin_vendor']."' ORDER BY id DESC LIMIT 5");
                        if($fetch->num_rows > 0){
                            while($row = $fetch->fetch_assoc()){
                                $t_id=$row['id'];
                                $dt=$row['date'];
                                $dt=date("M d, Y", $dt);
                                $camount=$row['tamt'];
                            
                                $sendto=$row['tto'];
                                if ($row['tto'] == $_SESSION['loggedin_vendor']){
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
                    if($_SESSION['loggedin_vendor']==$row['tfrom']) {
                        ?>
                            <!-- SENT TRANSFER SECTION STARTS HERE -->
                            <form action="dashboard.php" method="post" class="flex flex-col divide-y border-t border-b">
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
                    }elseif($_SESSION['loggedin_vendor']==$row['tto']){
                            ?>
                            <!-- RECEIVED TRANSFER SECTION STARTS HERE -->
                            <form action="dashboard.php" method="post" class="flex flex-col divide-y border-t border-b">
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
                            
                        </div>
                        <!-- TRANSACTION DETAILS SECTION ENDS HERE -->

                        </div>
                    <!-- TRANSACTION HISTORY SECTION ENDS HERE -->
                    
                </div>
            </div>
        </main>
        <!-- MAIN ENDS HERE -->
        
        <!-- FOOTER STARTS HERE -->
        <footer class='flex w-full justify-center p-3 px-0 border-t border-1 bg-gray-300 bg-opacity-25'>
            <div class='flex justify-around w-full max-w-5xl'>
                <span class='text-teal-600 text-lg md:text-3xl'>
                    <a href="dashboard.php"><i class='fa fa-home'></i></a>
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
    
    <script>
        document.querySelector('.toggle-show-balance').addEventListener('click',
        (e) => {
            e.currentTarget.querySelectorAll('.toggle-show-balance-btn')
            .forEach(btn => {
            btn.classList.toggle('hidden')
            })
            if (e.currentTarget.classList.contains('show')) {
                e.currentTarget.classList.remove('show');
                e.currentTarget.classList.add('hide');
                document.querySelector('.alternate-account-balance')
                .classList.remove('hidden');
                document.querySelector('.account-balance')
                .classList.add('hidden');
            } else {
                e.currentTarget.classList.remove('hide');
                e.currentTarget.classList.add('show');
                document.querySelector('.alternate-account-balance')
                .classList.add('hidden');
                document.querySelector('.account-balance')
                .classList.remove('hidden');
            }
        })
    </script>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
</body>
</html>