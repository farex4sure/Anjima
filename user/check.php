
<?php

session_start();
include "config.php";


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


include "config.php";
$err="";
if(!isset($_SESSION['loggedin_user'])){
    header("location:signin.php");
}
$vphone=$_SESSION['checked'];
$details = "SELECT * FROM vendors WHERE phone='$vphone'";
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

$kyc = "SELECT * FROM kyc WHERE phone='$vphone'";
            $result = $conn->query($kyc);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $fname = $row["fullname"];
                    $address = $row["address"];
                }
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/jquery.min.js"></script> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anjima | Vendor Withdraw</title>
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
                <div class='flex items-center gap-2 mr-auto'>
                    <div class='flex items-center gap-4'>
                        <a href="dashboard.php"><i class="fa fa-arrow-left"></i></a>
                        <h3 class='w-full text-sm md:text-lg font-semibold text-gray-600'><?php echo $name ?></h3>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER ENDS HERE -->

        <!-- MAIN STARTS HERE -->
        <main class='flex justify-center mb-auto h-full overflow-auto'>
            <main class="profile-page">
                <section class="relative block h-80">
                    <div class="absolute top-0 w-full h-full bg-center bg-cover" style="background-image:url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=2710&amp;q=80');">
                        <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
                    </div>
                    <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px" style="transform: translateZ(0px)">
                        <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                            <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                        </svg>
                    </div>
                </section>
                <section class="relative py-16 bg-blueGray-200">
                    <div class="container mx-auto px-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
                            <div class="px-6">
                                <div class="flex flex-wrap justify-center">
                                    <div class="w-full lg:w-3/12 px-4 py-4 lg:order-2 flex justify-center">
                                                <img alt="..." src="../vendors/vendor/<?php echo $pic ?>" class="shadow-xl object-cover rounded-full h-32 align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 w-32">
                                    </div>
                                    <div class="w-full lg:w-4/12 mt-16 px-4 lg:order-3 lg:text-right lg:self-center">
                                        <div class="py-3 px-3 mt-2 sm:mt-0 justify-between flex w-full">
                                            <button class="bg-teal-600 active:bg-teal-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" type="button">
                                            <a href="interaction.php?interactwith=<?php echo base64_encode($vphone) ?>"><i class="fa fa-message"></i></a>
                                            </button>
                                            <button class="bg-teal-600 active:bg-teal-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" type="button">
                                            <i class="fa fa-phone"></i>
                                            </button>
                                            <button class="bg-teal-600 active:bg-teal-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" type="button">
                                            <i class="fa-solid fa-thumbs-up"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                    </div>
                                </div>
                                <div class="text-center md:mt-20">
                                    <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                                        <?php echo $name ?>
                                    </h3>
                                    <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                                        <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
                                        <?php echo $address ?>
                                    </div>
                                </div>
                                <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                                    <div class="flex flex-wrap justify-center">
                                        <div class="w-full lg:w-9/12 px-4">
                                            <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                                            An artist of considerable range, Jenna the name taken by
                                            Melbourne-raised, Brooklyn-based Nick Murphy writes,
                                            performs and records all of his own music, giving it a
                                            warm, intimate feel with a solid groove structure. An
                                            artist of considerable range.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="relative bg-blueGray-200 pt-2 pb-2 mt-2">
                        <div class="container mx-auto px-4">
                            <div class="flex flex-wrap items-center md:justify-between justify-center">
                                <div class="w-full md:w-6/12 px-4 mx-auto text-center">
                                    <div class="text-sm text-blueGray-500 font-semibold py-1">
                                    Anjima vendors connect.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                </section>
            </main>
        </main>
        <!-- MAIN ENDS HERE -->
        
        <!-- FOOTER STARTS HERE -->

        <!-- FOOOTER ENDS HERE -->
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