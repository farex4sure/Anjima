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
    <title>Anjima | Receipt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
    <div class='flex h-screen flex-col bg-gray-100' style='background-image: url("data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z")'>
        
        <!-- HEADER STARTS HERE -->
        <header class='flex justify-center p-3 shadow mb-2 md:px-8 bg-gray-100 bg-opacity-25'>
            <div class='flex items-center w-full max-w-6xl'>
                <div class='flex items-center gap-2 mr-auto'>
                    <button onclick="history.back()" class="text-teal-600 text-xl md:text-2xl lg:text-3xl font-bold"><span><i class="fa fa-arrow-left"></i></span></button>
                </div>
            </div>
        </header>
        <!-- HEADER ENDS HERE -->

        <!-- MAIN STARTS HERE -->
        <main class='flex justify-center mb-auto h-full overflow-auto'>
            <div class='flex-flex-col h-full w-full max-w-6xl shadow px-3 md:px-5 lg:px-8 py-2'>
                <div class='flex flex-col w-full gap-3 px-3 py-4 rounded-lg'>
                    <div class="flex flex-col items-center bg-white bg-opacity-50 py-8">
                        <div class="flex justify-center items-center py-4">
                            <div class="flex justify-center items-center rounded-full text-2xl md:text-3xl w-16 h-16 bg-teal-600 text-teal-50">
                                <img class="hidden" src="" alt="user_photo">
                                <span><i class="fa fa-user"></i></span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center gap-4 pt-2 pb-4">
                            <span class="block text-center text-gray-400">Received from <span class="uppercase font-semibold"><?php echo $_SESSION['name'] ?></span></span>
                            <span class="block uppercase text-2xl font-bold text-center"><span><i class="fa fa-naira-sign"></i></span><?php echo number_format($_SESSION['amt']) ?></span>
                            <div>
                                <span class="inline-flex justify-center items-center rounded-full bg-green-400 text-green-50 w-6 h-6"><i class="fa fa-check"></i></span>
                                <span>Completed</span>
                            </div>
                        </div>
                    </div>
                    <div class='flex flex-col divide-y border-t border-b rounded-md justify-start bg-white bg-opacity-50 py-2'>
                        <div class='flex items-center justify-between w-full py-3 px-3'>
                            <div class='flex items-center justify-center'>
                                <span>Transfer Amount</span>
                            </div>
                            <div class='flex justify-end items-center font-semibold'>
                                <span class="truncate"><i class="fa fa-naira-sign"></i><?php echo number_format($_SESSION['amt']) ?></span>
                            </div>
                        </div>
                        <div class='flex items-center justify-between w-full py-3 px-3'>
                            <div class='flex items-center justify-center'>
                                <span>Fee</span>
                            </div>
                            <div class='flex justify-end items-center font-semibold'>
                                <span class="truncate"><i class="fa fa-naira-sign"></i> 0.00</span>
                            </div>
                        </div>
                        <div class='flex items-center justify-between text-teal-500 w-full py-3 px-3'>
                            <div class='flex items-center justify-center'>
                                <span>Total Payment Amount</span>
                            </div>
                            <div class='flex justify-end items-center font-semibold'>
                                <span class="truncate"><i class="fa fa-naira-sign"></i><?php echo number_format($_SESSION['amt']) ?></span>
                            </div>
                        </div>
                    </div>

                    <div class='flex flex-col divide-y border-t border-b rounded-md justify-start bg-white bg-opacity-50 py-2'>
                        <div class='flex items-center justify-between w-full py-3 px-3'>
                            <div class='flex items-center justify-center'>
                                <span>Sender Name</span>
                            </div>
                            <div class='flex justify-end items-center font-semibold'>
                                <span class="truncate uppercase"><?php echo $_SESSION['name'] ?></span>
                            </div>
                        </div>
                        <div class='flex items-center justify-between w-full py-3 px-3'>
                            <div class='flex items-center justify-center'>
                                <span>Fee</span>
                            </div>
                            <div class='flex justify-end items-center font-semibold'>
                                <span class="truncate"><i class="fa fa-naira-sign"></i> 0.00</span>
                            </div>
                        </div>
                        <div class='flex items-center justify-between w-full py-3 px-3'>
                            <div class='flex items-center justify-center'>
                                <span>Total Payment Amount</span>
                            </div>
                            <div class='flex justify-end items-center font-semibold'>
                                <span class="truncate"><i class="fa fa-naira-sign"></i><?php echo number_format($_SESSION['amt']) ?></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
        <!-- MAIN ENDS HERE -->
        
        <!-- FOOTER STARTS HERE -->
        <footer class='flex w-full justify-center p-3 px-0 bg-opacity-25'>
            <div class='flex justify-around w-full max-w-5xl px-4 gap-3'>
                <button class='w-full py-1.5 md:py-2 lg:py-3 font-semibold text-teal-600 bg-teal-100 rounded-2xl border border-gray-00 text-lg md:text-3xl'>
                    Save
                </button>
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
                        <button data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
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