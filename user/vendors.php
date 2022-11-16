
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



?>

<!DOCTYPE html> 
<head>
    <script src="js/jquery.min.js"></script> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendors | Anjima</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
 
<body>
    <div class="spin-wrapper h-screen flex justify-center items-center bg-gray-400">
        <img class="animate-ping w-20 h-20" src="../images/an.png">
    </div>
    <div class='relative flex h-full flex-col bg-teal-100' style="background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z);">
    <div class="fixed bottom-0 right-0">
        <button type="button" data-dropdown-toggle="language-dropdown-menu" class="inline-flex justify-center  items-center p-2 text-sm text-teal-500 rounded cursor-pointer hover:text-teal-900 hover:bg-teal-100 dark:hover:bg-teal-700 dark:hover:text-white">
            <span><i class="fa fa-globe mr-2"></i></span>
            Hausa 
        </button>
        <!-- Dropdown -->
        <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-teal-100 shadow dark:bg-teal-700" id="language-dropdown-menu">
            <ul class="py-1" role="none">
            <li>
                <a href="#" class="block py-2 px-4 text-sm text-teal-700 hover:bg-teal-100 teal-400 dark:hover:bg-teal-600 dark:hover:text-white" role="menuitem">
                <div class="inline-flex items-center">
                    English 
                </div>
                </a>
            </li>
            <li>
                <a href="#" class="block py-2 px-4 text-sm text-teal-700 hover:bg-teal-100 teal-400 dark:hover:bg-teal-600 dark:hover:text-white" role="menuitem">
                <div class="inline-flex items-center">
                    Igbo
                </div>
                </a>
            </li>
            <li>
                <a href="#" class="block py-2 px-4 text-sm text-teal-700 hover:bg-teal-100 teal-400 dark:hover:bg-teal-600 dark:hover:text-white" role="menuitem">
                <div class="inline-flex items-center">
                    
                    Yoruba
                </div>
                </a>
            </li>
            <li>
                <a href="#" class="block py-2 px-4 text-sm text-teal-700 hover:bg-teal-100 teal-400 dark:hover:bg-teal-600 dark:hover:text-white" role="menuitem">
                <div class="inline-flex items-center">
                    Fulani
                </div>
                </a>
            </li>
            </ul>
        </div>
    </div> 
    <div class="static text-left p-2 bg-teal-600 h-52">        
        <div class="flex flex-col">
            <a href="dashboard.php">
             <i class="fa fa-angle-left text-white px-2"></i>
            </a>
             <div class="py-2 px-1 w-full ">
                 <p class="text-sm  text-white"><span class="">Connect with Vendors</span> </p>
                 <p class="  font-bold text-lg pb-4 text-white "><span class="">Connect with Vendors</span> </p>
             </div>
             <form class="flex  items-center">   
                 <label for="simple-search" class="sr-only">Search</label>
                 <div class="relative w-full">
                     <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                         <svg aria-hidden="true" class="w-5 h-5 text-teal-500 dark:text-teal-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                     </div>
                     <input type="text" id="simple-search" class="bg-teal-50 border border-teal-300 text-teal-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-teal-700 dark:border-teal-600 dark:placeholder-teal-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required="">
                 </div>
                 <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-teal-400 rounded-lg border border-teal-600 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                     <span class="sr-only">Search</span>
                 </button>
             </form>
        </div>
  
     <!-- MAIN STARTS HERE -->
     <main class='flex bottom-0 justify-center mb-auto overflow-auto'>
        <div class='h-full w-full max-w-6xl  px-3 md:px-5 lg:px-8'>
                    <div class='flex flex-col gap-y-3 mt-3'>
                        <div class="grid grid-cols-2 h-full md:grid-cols-2  justify-items-center gap-y-8 gap-x-8 py-4  md:py-8">
                                               <?php

session_start();
include "config.php";


// get category list
$getCatList=mysqli_query($conn, "SELECT * FROM categories ORDER BY name ASC");
while($cats=mysqli_fetch_assoc($getCatList)){

    $catName=$cats['name'];
  
$catpic=$cats['description'];



?>

                            <a href="connect.php?cat=<?php echo base64_encode($catName);  ?>" class="flex flex-col items-center rounded-lg text-gray-700 justify-center gap-4 w-full p-4 bg-white  shadow-md hover:text-cyan-500 hover:shadow-lg rounded">
                                <span class="text-3xl md:text-5xl lg:text-7xl text-teal-600"><img src="../images/cats/<?php echo $catpic;?>"></span>
                                <p class="italic font-bold text-gray-700 text-center capitalize"> <?php
                                echo $catName;
                                ?>
                                </p>
                            </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
        </div>
    </main>
    <!-- MAIN ENDS HERE -->
        
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