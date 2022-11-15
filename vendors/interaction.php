<?php
session_start();
include "config.php";
$list="";
if(!isset($_SESSION['loggedin_vendor'])){
    header("location:vendor_signin.php");
}
function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'Just now'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
$interactwith=base64_decode($_GET['interactwith']);
$_SESSION['interactwith']=$interactwith;
$owner=$_SESSION['loggedin_vendor'];
$getchat=mysqli_query($conn, "SELECT mfrom, mto, date, mcont, MAX(date) FROM chat WHERE mto='$owner' OR mfrom='$owner' GROUP BY mfrom,mto ORDER BY MAX(date)  DESC , date ");


while ($mto = mysqli_fetch_assoc($getchat)) {
$otherPhone = $mto['mto'];
$st=$mto['st'];




// change message status to read


// update message to read

if(mysqli_query($conn, "UPDATE chat SET st='1' WHERE mto='$owner' AND mfrom='$otherPhone'")){



}
else{


}


$getLatest = mysqli_query($conn, "SELECT * from chat WHERE mto='$otherPhone' AND mfrom='$owner' OR mfrom='$otherPhone' AND mto='$owner' ORDER BY id DESC LIMIT 1");
$get = mysqli_fetch_assoc($getLatest);
$lastMsg = $get['mcont'];
$date = $get['date'];
if ($otherPhone == $owner) {
continue;
}else{
$getcs = mysqli_query($conn, "SELECT * FROM users WHERE phone='$otherPhone'");
while ($cs = mysqli_fetch_assoc($getcs)) {
$cid = $cs['phone'];

// get users fullname using his id
$getcname = mysqli_query($conn, "SELECT * FROM users WHERE phone='$cid'");
while ($cd = mysqli_fetch_assoc($getcname)) {
    $cname = $cd['fullname'];
    $cid = $cd['phone'];
    $pic = $cd['pic'];
}
$list.='<a href="interaction.php?interactwith=' . base64_encode($cid) . '" class="flex items-center w-full px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none">
    <img class="object-cover w-10 h-10 rounded-full" src="../user/images/'.$pic.'" alt="username" />
    <div class="flex flex-col w-full gap-1">
        <div class="flex justify-between">
            <span class="block ml-2 font-semibold text-gray-600">'.$cname.'</span>
            <span class="block ml-2 text-sm text-gray-600">'.get_time_ago( $date ).'</span>
        </div>
        <span class="inline-flex justify-start ml-2 w-full text-sm text-gray-600 truncate w-32 md;w-56">'.$lastMsg.'</span>
    </div>
</a>';
        }
    }
}
                          
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anjima | Chat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
<body>
    <div class='flex h-screen flex-col lg:flex-row bg-gray-100' style='background-image: url("data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDxUPDw8VDw8NFRUNDw0NFRUVDQ0NFRUXFhUVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAZAAEBAQEBAQAAAAAAAAAAAAAAAQIDBwT/xAAnEAEBAAEDBAICAwEBAQAAAAAAAVECEUFhwdHwoeEhMQOBsRKRcf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD2UABYLAa0xoigAzq1bAatWznalqAqAAAAsJAAAAAA3QAA3AE3UApaWgXzhL5wW98FvfAFvfBb3xkt655hb1zzMgb98ZN/fxk3655mTfvjINRFiAoAK3pjEdNINCM6tWwLq1bONu6W7rAAABAFWQkAAAAAEAAQABQCqlAtLe5S3uCW9c8lvXPMLe/Jb1zyCW9c8wt655mS3rnkt6556gW9c8zK79c8zKW9c89V36556gsCAKIoLG5XMuvYHTXr2cLq3Y1am9GkFkUQA3S1m0Gt2pE0xQVAABQEABBLQXdN03a0wFkUAEqlBKW+7lL7+QS3vyW9+VvnlLe/IJb1zyW9c89Vt78lvfnqCb9c89V3789T756r989QWI1IAyFQC1z1VumnSDOjRzf/AB0EAS0tc9WoFupvRp2/f7T+PRt+b+/8bABAURoBAAQS0C1i01Vr+PRzf6gLo081sAAAAASlVKBS+eSlBL55X75Ptr7BPvnq1J7v1WTvzcte/u5AkFgDglWgJItEAS1axaCaq1o0bfm/v/F06dmgEVAAbkBNkaqAgIBWatXTpBNGjmtgAAAAAAAACKKA1J7+ST38te8gfecnvOT3k95BYqRQfOBQQEoJWtMWRQBQGTZdnTTNgZmla0zr1AxagUEBZAJFAAAAAAAAAAABqI3AWKAAFAVz/wCwHNFqALISNANbC29+QSpatvflfvkCe/ld/d+pv356s69ffnqBq1+/257m/v8AYAigEUAAAAAAAAAAAAUFjcc29INAUCuWrVuatW7IKgAU2FBWtkkavnIF88pb35q3zlL55oL980t783KW9+b0Z16u/NyC69ffm5Y39/OUt783J95yC+/Ke/J7zlfecgKnvyAoAAAAAAAAAAAAgDW7Uc2pQdN3PXq3S1AAQFEUFVGganv7L5yt9/aXzkC+cpq856Lq85Y/k1d89AP5NXfm9HO3vnJfOS+c5AvnOV+85T7zk+85Bfecr7zlPecr7zkD3nIe85PfkFAAAAAAAABAAQATcBd1SKACAG6Ws2g1uJ/zQHVr3lluAt9/ZfOS+/tnXq75BP5NXfLnfOVvnKXzkEvnJfOcrfOUvnOQL5zlfvOS+c5PvOQPecr7zlPecr7zkD3nJ78nvOQFAAAAAABABEtAtS1LWdwa3akSTZqQCRQBEtLWdVBLWtGnmmjRzf6joAACtMloNa9Tnff2tSgX39pfOVpfIJfOS+crfOUs75AvnOT7zlfvOT3nIJ7zlfecnvye/IHvyCgAAAAAgCCWgWsXUmrU53Vv+IDW7ppmzOmbf/W9M3BdMaABKJQS1dGjmrp0tAAAAACABQApfIAXyXyAH3/p78gB78nvyAHvyACiAKIAIoDNrnqoA469XE/dddGn/mdeagDejTv+eHUAAAQ0xQFAAAAAB//Z")'>
        <!-- CHATS LIST SECTION STARTS HERE -->
        <section class="hidden lg:block flex flex-col lg:w-2/5 h-full">
            <!-- MAIN STARTS HERE -->
            <main class='flex h-full justify-center mb-auto bg-white bg-opacity-50'>
                <div class="container h-full mx-auto">
                    <div class="flex flex-col h-full border rounded">
                        <div class="mb-auto border-r border-gray-300 lg:col-span-1 mb-auto pb-auto h-full">
                            <div class="mx-3 my-3">
                                <div class="relative text-gray-600">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            viewBox="0 0 24 24" class="w-6 h-6 text-gray-300">
                                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </span>
                                    <input type="search" class="block w-full py-2 pl-10 bg-gray-100 rounded outline-none" name="search" placeholder="Search" required />
                                </div>
                            </div>
                            <ul class="flex flex-col">
                                <h2 class="my-2 mb-2 ml-2 text-lg text-gray-600">Chats</h2>
                                <li class=''>
                                    <?php echo $list ?>
                                </li>
                            </ul>
                        </div>
                        <div class='bg-gray-200 py-4'>
                            <div class='flex justify-around w-full max-w-5xl'>
                                <span class='text-teal-600 text-lg md:text-3xl'>
                                    <a href="dashboard.php"><i class='fa fa-home'></i></a>
                                </span>
                                <span class='text-teal-600 text-lg md:text-3xl'>
                                    <a href="#"><i class='fa fa-bank'></i></a>
                                </span>
                                <span class='text-teal-600 text-lg md:text-3xl'>
                                    <a href="messages.php"><i class='fa fa-message'></i></a>
                                </span>
                                <span class='text-teal-600 text-lg md:text-3xl'>
                                    <a href=""><i class='fa fa-bars'></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- MAIN ENDS HERE -->
        </section>
        <!-- CHAT LISTS SECTION ENDS HERE -->

        <!-- CHAT DETAILS SECTION STARTS HERE-->
        <section class="flex flex-col w-full h-full">
            <div class='flex h-full justify-center mb-auto'>
                <div class="flex flex-col w-full h-full py-1">
                    <?php 
                    
                    $details = "SELECT * FROM users WHERE phone='$interactwith'";
                    $result = $conn->query($details);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $name = $row["fullname"];
                            $pic = $row["pic"];
                        }
                    }
                    ?>
                    <!-- HEADER SECTION STARTS HERE -->
                    <header class="relative flex items-center p-3 gap-2 border-b border-gray-300 text-teal-50 bg-teal-600 mx-1 rounded">
                        <a href="messages.php" class='close-chat-btn flex text-2xl pr-2'><i class='fa fa-arrow-left'></i></a>
                        <img class="object-cover w-10 h-10 rounded-full" src="../user/images/<?php echo $pic ?>" alt="username" />
                        <div class="flex flex-col w-full">
                            <span class="block ml-2 font-bold mr-auto"><?php echo $name ?></span>
                            <span class="block ml-2 mr-auto">Online</span>
                        </div>
                        <span class="absolute w-3 h-3 bg-green-600 rounded-full left-10 top-3"></span>
                        <button><i class='fa fa-gear pr-2'></i></button>
                    </header>
                    <!-- HEADER SECTION STARTS HERE -->
                    
                    <!-- MAIN SECTION STARTS HERE -->
                    <main id="main" class="relative w-full px-3 py-4 overflow-y-auto mb-auto">
                        
                    </main>
                    <!-- MAIN SECTION ENDS HERE -->
            
                    <!-- FOOTER SECTION STARTS HERE -->
                    <form id="smsg" method="post" class='flex w-full justify-center mt-auto bg-opacity-25'>
                 
                        <div class="flex items-center justify-between w-full gap-3 p-3 border-t border-gray-300">
                            <div class='w-full'>
                              <p class="text-center font-bold text-teal-600" id="err"></p>
                                <input type="text" placeholder="Message" name="msg" class="block w-full py-2 pl-4 bg-gray-100 rounded-full outline-none focus:text-gray-700" name="message" required />
                            </div>
                            <div  class="flex gap-3">
                            <!-- Voice icon starts here -->
                                <button class='inline-flex justify-center items-center w-8 h-8 md:w-10 md:h-10 bg-teal-600 text-teal-50 rounded-full' type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                    </svg>
                                </button>
                                <!-- Voice icon ends here -->

                                <!-- Message icon starts here -->
                                <button type="submit" name="submit" class='inline-flex justify-center items-center w-8 h-8 md:w-10 md:h-10 bg-teal-600 text-teal-50 rounded-full' type="button">
                                    <svg class="w-5 h-5 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                    </svg>
                                </button>
                                <!-- Message icon ends here -->
                            </div>
                        </div>
                    </form>
                    <!-- FOOOTER SECTION ENDS HERE -->
                </div>
            </div>
        </section>
        <!-- CHAT DETAILS SECTION ENDS HERE -->

        <!-- BLANK CHAT SECTION STARTS HERE-->
        <section class="blank-chat flex flex-col w-full h-full hidden">
            <div class='flex flex-col h-full justify-center items-center mb-auto gap-8'>
                <div>
                    <span class='text-lg md:text-xll lg:text-2xl text-gray-500'>Add Chat</span>
                </div>
                <button class='flex justify-center items-center text-2xl text-teal-600 md:text-3xl lg:text-6xl w-16 h-16 md:w-20 md:h-20 lg:w-24 lg:h-24 border-2 rounded-full'><i class='fa fa-plus'></i></button>
            </div>
        </section>
        <!-- BLANK CHAT SECTION ENDS HERE -->

    </div>
    
  





    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>




    
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>


<script type="text/javascript">


        function scrollDown() {
          

          $('#main').scrollTop($('#main')[0].scrollHeight);
        }


    // This function is used to get error message for all ajax calls
    function getErrorMessage(jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = '<div class="alert alert-danger" role="alert">Internet connection lost!\n Please connect to internet and retry.</div>';
        } else if (jqXHR.status == 404) {
            msg = '<div class="alert alert-danger" role="alert">Requested page not found. [404]</div>';
        } else if (jqXHR.status == 500) {
            msg = '<div class="alert alert-danger" role="alert">Internal Server Error [500].</div>';
        } else if (exception === 'parsererror') {
            msg = '<div class="alert alert-danger" role="alert">Requested JSON parse failed.</div>';
        } else if (exception === 'timeout') {
            msg = '<div class="alert alert-danger" role="alert">Time out error.</div>';
        } else if (exception === 'abort') {
            msg = '<div class="alert alert-danger" role="alert">Ajax request aborted.</div>';
        } else {
            msg = '<div class="alert alert-danger" role="alert">Uncaught Error.</div>\n' + jqXHR.responseText;
        }

        ///
        $("#err").html(msg).fadeIn();
    }

var auto_refresh = setInterval(
function ()
{
$('#main').load('loadc.php');
 $('#main').scrollTop($('#main')[0].scrollHeight);

scrollDown();
}, 3000);



    $(document).ready(function(e) {
        scrollDown();
        $("#smsg").on('submit', (function(e) {
            e.preventDefault();

            $.ajax({
                url: "sendmsg.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#err").html("Sending message").fadeIn();
                },
                success: function(data) {

                    $('#err').html(data).fadeIn(2000);
                     $('#main').scrollTop($('#main')[0].scrollHeight);
                     $("#err").fadeOut("slow");
                    $("#smsg")[0].reset();
                  
                  

                },
                error: function(jqXHR, exception) {
                    console.log(jqXHR);
                    getErrorMessage(jqXHR, exception);

                    $("#err").html(data).fadeIn();
                },
            });

        }));

    });
</script>







</body>
</html>