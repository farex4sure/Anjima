<?php
session_start();
include "config.php";
if(!isset($_SESSION['loggedin_user'])){
    header("location:signin.php");
}ll items-center justify-center z-10 pt-2'>
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