<?php
// check user status
session_start();
$loggedin_vendor=$_SESSION['loggedin_vendor'];
include "../../config.php";
$checkuser=mysqli_query($conn, "SELECT * FROM vendors WHERE phone='$loggedin_vendor'");

 while($row = $checkuser->fetch_assoc()) {
                    $st = $row["st"];

                 if($st=="0"){

                     header("location:../../kyc.php");

                     ?>

                    <script>
                    window.location.href='../../kyc.php';
                    </script>
                     <?php

                 }



                }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stemlab - Attendance</title>
    <link rel="stylesheet" href="./css/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <script src="html5-qrcode.min.js"></script>
    <style>
        .result{
            background-color: green;
            color:#fff;
            /* padding:20px; */
        }
        #reader__dashboard_section {
            display: flex;
            gap: 10px;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }
        #reader__dashboard_section_csr {
            color: rgb(255, 94, 0)
        }
        #reader__dashboard_section_csr :nth-child(2) {
            color: white;
            margin: 3px;
            padding: 4px 8px !important;
            text-decoration: none !important;
            font-size: 12px;
            border: 1px solid rgb(8 145 178);
            border-radius: 10px;
            background-color: rgb(8 145 178);
        }
        #reader__dashboard_section_swaplink {
            color: white;
            padding: 4px 8px !important;
            text-decoration: none !important;
            font-size: 12px;
            border: 1px solid gray;
            border-radius: 10px;
            background-color: gray;
        }
    </style>
    <div class="flex flex-col gap-4 relative">
        <div class="flex justify-center bg-teal-500 text-white font-semibold w-full py-4 mb-4 md:mb-6">
            <h1 class="flex justify-center w-full max-w-3xl text-xl md:text-3xl capitalize">Scanner</h1>
        </div>
        <div class='text-center font-bold italic bg-teal-700 text-white py-2'>Scan to receive money</div>
        <div class='flex flex-col items-center gap-4'>
            <div class="w-full max-w-3xl px-3">
                <div class='flex flex-col justify-center rounded-xl' id="reader"></div>
            </div>
            <div class="py-4">
                <div id="result"></div>
            </div>
            <div class='w-full max-w-3xl px-4 mb-4'>
                <form class='details-form hidden flex flex-col gap-4 w-full border-2 rounded-xl px-6 md:px-8 py-8'>
                    <div class="sr-only">
                        <label for="qrcode"></label>
                        <input class='qr-code-response' type='text' name='qrcode' id='qrcode' placeholder='qrcode'>
                    </div>
                    <div>
                        <button type='button' class='submit-btn bg-teal-500 text-white px-4 py-2 rounded-lg w-full font-semibold'>Sign In</button>
                    </div>
                </form>
            </div>
        </div>
        <div class='hidden response-page absolute top-0 left-0 h-screen w-full flex justify-center items-center bg-gray-300 bg-opacity-75'>
            <div class='inline-flex h-14 w-14  border-4 border-r-teal-500 rounded-full animate-spin'></div>
        </div>
    </div>

    <script>
        const selectSection = document.querySelectorAll('.select-section');

        const compileValues = async (value) => {
            submitValues(value);
        }

        const submitValues = async (query) => {
            // responsePage.classList.remove('hidden');
            // console.log(`https://stem360.stemlab.com.ng/admin/src/check.php?u=${query}`)
            window.location.href = `https://anjima.rf.gd/vendors/choose.php?u=${query}`;
        }

        const onScanSuccess = (qrCodeMessage) => {
            let message = qrCodeMessage;

            html5QrcodeScanner.clear()
            .then(_ => {
                // the UI should be cleared here
                compileValues(message);   
            }).catch(error => {
                // Could not stop scanning for reasons specified in `error`.
                // This conditions should ideally not happen.
            });
        }

        const onScanError = (errorMessage) => {
        //handle scan error
        }
        const html5QrcodeScanner = new Html5QrcodeScanner('reader', { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess, onScanError);

        const reader = document.querySelector('#reader');
        const readerHeader = reader.querySelectorAll('div')[0];
        const readerStatusSpan = document.querySelector('#reader__status_span');
        const readerScanRegion = document.querySelector('#reader__scan_region');
        readerScanRegion.className += ' flex justify-center w-full gap-6 text-purple-800 font-bold';
        reader.className += ' flex justify-center w-full gap-6 md:gap-10 text-purple-800 font-bold';
        reader.querySelector('img').className += ' flex w-64';
        
        readerStatusSpan.style.display = 'flex';
        readerStatusSpan.style.color = '34 197 94';
        readerHeader.className += 'text-purple-800 font-bold';

    </script>
</body>
</html>