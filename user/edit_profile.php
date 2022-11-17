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
if(isset($_POST['submit'])){
    $e_name=$_POST['fname'];
    $e_email=$_POST['email'];

    $e_image = $_FILES['image']['name'];
    $e_tmp =$_FILES['image']['tmp_name'];
    move_uploaded_file($e_tmp,"vendor/".$e_image);
    
    if($e_image != ""){
    $update = "UPDATE vendors SET pic = '$e_image' WHERE phone='".$_SESSION['loggedin_user']."'";
    $updated = mysqli_query($conn,$update);

    if($e_name != ""){
    $update = "UPDATE vendors SET fullname = '$e_name' WHERE phone='".$_SESSION['loggedin_user']."'";
    $updated = mysqli_query($conn,$update);
    }
    if($e_email != ""){
    $update = "UPDATE vendors SET email = '$e_email' WHERE phone='".$_SESSION['loggedin_user']."'";
    $updated = mysqli_query($conn,$update);
    }
    $err= '
    <div role="alert">
        <div class="bg-teal-600 text-white font-bold rounded-t px-4 py-2">
            Success
        </div>
        <div class="border border-t-0 border-teal-400 rounded-b bg-teal-100 px-4 py-3 text-teal-600">
            <p>Profile updated !!!.</p>
        </div>
    </div>
    ';
}else{
    $err= '
    <div role="alert">
  <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
    Error
  </div>
  <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
    <p>Image is required.</p>
  </div>
</div>
    ';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anjima | Edit Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
<body>
    <div class='flex h-screen flex-col bg-gray-100' style='background-image: url("data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z")'>
        
        <!-- HEADER STARTS HERE -->
        <header class='flex justify-center p-3 shadow mb-2 md:px-8 bg-gray-100 bg-opacity-25'>
            <div class='flex items-center w-full max-w-6xl'>
                <div class='flex items-center gap-2 mr-auto'>
                    <a href="profile.php" class="text-teal-600 text-xl md:text-2xl lg:text-3xl font-bold"><span><i class="fa fa-arrow-left"></i></span></a>
                    <span class='inline-flex justify-center w-full'>Edit Profile</span>
                </div>
            </div>
        </header>
        <!-- HEADER ENDS HERE -->

        <!-- MAIN STARTS HERE -->
        <main class='flex justify-center mb-auto h-full overflow-auto'>
            <div class='flex-flex-col h-full w-full max-w-6xl shadow px-3 md:px-5 lg:px-8 py-2'>
                <?php echo $err ?>
                <div class='flex flex-col w-full gap-3 px-3 py-4 rounded-lg'>
                    <div class="flex flex-col items-center bg-white bg-opacity-50 py-5 px-3 rounded-xl">
                        <div class="relative flex justify-center items-center w-20 h-20 border border-teal-600 text-teal-50 rounded-full">
                            <div class="flex justify-center items-center rounded-full w-full h-full text-2xl md:text-3xl overflow-hidden">
                                <img class='w-full h-full object-cover' src="images/<?php echo $pic ?>" alt="user_photo">
                            </div>
                        </div>
                        <div class='flex h-full w-full items-center justify-center z-10 pt-2'>
                            <button class='profile-img-btn text-gray-600 text-sm z-20'>Edit photo <i class='fa fa-edit  text-xs text-teal-600'></i></button>
                        </div>
                    </div>
                    <div class='flex flex-col divide-y border-t border-b rounded-md justify-start bg-white bg-opacity-50 py-6 px-3 md:px-6 lg:px-8'>
                        <form action="edit_profile.php" method="post">
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="fname" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer" placeholder="" value="<?php  echo $name ?>" required="" spellcheck="false" data-ms-editor="true">
                                    <label for="first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-teal-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Full name</label>
                                </div>
                            </div>
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="email" name="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer" placeholder=" " value='<?php echo $email ?>'>
                                <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-teal-600 peer-focus:dark:text-teal-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="tel" name="phone" disabled class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-teal-500 focus:outline-none focus:ring-0 focus:border-teal-600 peer" value="<?php echo $_SESSION['loggedin_user'] ?>" placeholder=" " required="">
                                    <label for="phone" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-teal-600 peer-focus:dark:text-teal-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone number</label>
                                </div>
                            </div>
                            <div class="hidden rounded border overflow-hidden">
                                <label for='profile_img'></label>
                                <input class='profile-img-target' type="file" name='image' value="<?php echo $pic ?>" accept="img">
                            </div>
                            <button type="submit" name="submit" class="hidden submit-btn-target">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- MAIN ENDS HERE -->
        
        <!-- FOOTER STARTS HERE -->
        <footer class='flex w-full justify-center p-3 px-0 bg-opacity-25'>
            <div class='flex justify-around w-full max-w-5xl px-4 gap-3'>
                <button type="button" class="submit-btn text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm w-full max-w-lg px-5 py-2.5 text-center">Save</button>
            </div>
        </footer>
        <!-- FOOOTER ENDS HERE -->
    </div>
    
    <script>
        const  profileImgBtn = document.querySelector('.profile-img-btn');
        const  profileImgTarget = document.querySelector('.profile-img-target');
        const  submitBtn = document.querySelector('.submit-btn');
        const  submitBtnTarget = document.querySelector('.submit-btn-target');

        const handleClick = (target) => {
            target.click()
        }

        profileImgBtn.addEventListener('click', () => {
            handleClick(profileImgTarget)
        })
        
        submitBtn.addEventListener('click', () => {
            handleClick(submitBtnTarget)
        })
    </script>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>