<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="shortcut icon" href="images/an.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"  rel="stylesheet"/>
    <link  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css"  rel="stylesheet"/>
    <title>Get Started | Anjima</title>
</head>
<body>
   
    <div class="flex flex-col w-full bg-center bg-cover h-screen" style="background-image: url(https://media.istockphoto.com/photos/smiling-african-american-woman-showing-thumbs-up-on-teal-background-picture-id1206790539?k=20&m=1206790539&s=612x612&w=0&h=YBENY4zoSHABQ6Lv5rQ_rElVU9nrBMOxYhMEF3HefXU=);">
        <div class="flex justify-center w-full lg:bg-black lg:bg-opacity-50 px-4 py-4 bg-black  bg-opacity-50">
            <div class="w-full max-w-6xl">
                <div class="w-32">
                    <a><img src="images/anj.png" alt=""></a>
                </div>
            </div>
            <div>
                <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="flex justify-center text-white bg-teal-600 hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm w-24 md:w-28 py-2.5 text-center inline-flex items-center" type="button">Sign Up<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="hidden z-10 w-24 md:w-28 bg-white rounded divide-y divide-gray-100 shadow">
                <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownDefault">
                    <li>
                        <a href="user/signup.php" class="block py-2 px-4 font-medium hover:font-semibold hover:bg-gray-100 hover:text-teal-600">User</a>
                    </li>
                    <li>
                        <a href="vendors/signup.php" class="block py-2 px-4 font-medium hover:font-semibold hover:bg-gray-100 hover:text-teal-600">Vendors</a>
                    </li>
                </ul>
            </div>
            </div>
        </div>
        <div class="flex flex-col px-4 w-full h-full items-center pb-8 bg-black bg-opacity-50">
            <div class="mt-10 mb-auto w-full max-w-5xl">
                <div class="hidden md:block leading-10">
                    <p class="text-4xl max-w-xs font-bold text-white  lg:text-5xl">
                        Don't Wait. Get Credit or Buy Now, Pay Later.
                    </p>
                    
                </div>
                <div class="md:hidden">
                    <p class="text-4xl pb-3  font-bold text-white  lg:text-5xl">Don't Wait.</p>
                <p class="text-4xl pb-3 font-bold text-white  lg:text-5xl">Get Credit</p>
                <p class="text-4xl pb-3 font-bold text-white  lg:text-5xl">or</p>
                <p class="text-4xl pb-3 font-bold text-white  lg:text-5xl">Buy Now,</p>
                <p class="text-4xl pb-3 font-bold text-white  lg:text-5xl">Pay Later.</p>
                <p class="border-1 w-16"></p>
                </div>
            </div>
            <div class="flex justify-center w-full">
                <div class="flex w-full max-w-xs justify-between">
                    <a href="user/signin.php" class="inline-flex items-center py-2 px-4 text-md font-medium text-center text-white    rounded-lg hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-300 dark: dark:hover:bg-teal-600 dark:focus:ring-teal-800"><i class="fa-solid fa-arrow-right-to-bracket pr-2"></i>Sign in</a>
                    <a href="signup.php" class="inline-flex items-center py-2 px-4 text-md font-medium text-center text-white bg-teal-600 rounded-lg shadow hover:bg-teal-400 focus:ring-4 focus:outline-none focus:ring-gray-200  dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Get Started</a>
                </div>
            </div>
        </div>
    </div>
 

</body>
</html>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
<script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
<script  type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>