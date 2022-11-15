<?php
session_start();
include "config.php";
if(!isset($_SESSION['loggedin_vendor'])){
    header("location:vendor_signin.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/jquery.min.js"></script>  
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
    <div class='flex h-screen  flex-col bg-teal-100' style="background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);">
    <div class="p-2 bg-teal-600 mb-6 h-24">        
        <div class="flex flex-col">
            <a href="dashboard.php">
             <i class="fa fa-angle-left text-white px-2"></i>
            </a>
             <div class="py-2 px-1 w-full justify-center items-center ">
                 <p class="text-center font-bold text-2xl pb-4 text-white "><span class="">Check Status</span> </p>
             </div>
        </div>
    </div>
    <div class="">
    <?php
    $details = "SELECT * FROM d_loans WHERE vendor='".$_SESSION['loggedin_vendor']."'";
        $result = $conn->query($details);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $debtor = $row["user"];
                $st = $row["amt_remaining"];

    $debt = "SELECT * FROM users WHERE phone='$debtor'";
        $res = $conn->query($debt);
        if ($res->num_rows > 0) {
            while($rows = $res->fetch_assoc()) {
                $name = $rows["fullname"];
            }
        }
    $kyc = "SELECT * FROM kyc WHERE phone='$debtor'";
        $rest = $conn->query($kyc);
        if ($rest->num_rows > 0) {
            while($row1 = $rest->fetch_assoc()) {
                $address = $row1["address"];
                $state = $row1["state"];
            }
        }
    ?>
        <div class='mx-4 lg:mx-12 mt-2'>
            <div class="p-2 w-full  bg-white border shadow-md sm:p-4 dark:bg-gray-800 dark:border-gray-700">
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <a href="payloan.php?pay=<?php echo base64_encode($id)?>" class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-16 h-16 rounded-full" src="https://cdn.pixabay.com/photo/2019/06/05/08/37/dog-4253238__340.jpg" alt="  ">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        <?php echo $name ?>
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        <?php echo $state ?>
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        <?php echo $address ?>
                                    </p>
                                </div>
                                <?php
                                if($st <= 0){
                                    ?>
                                    
                                <div class="inline-flex items-center h-2.5 w-2.5 rounded-full bg-green-400 mr2 ">
                                
                                </div>
                                    <?php

                                }else{
                                ?>
                                <div class="inline-flex items-center h-2.5 w-2.5 rounded-full bg-red-400 mr2 ">
                                
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
</body>
</html>