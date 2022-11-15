<?php
session_start();
include "config.php";

$interactwith=$_SESSION['interactwith'];
$owner=$_SESSION['loggedin_vendor'];

echo "<script>scrollDown();</script>
";



?>

<ul class="space-y-3 md:space-y-4 lg:space-y-5">
                        <?php
                        $msg = "SELECT * FROM chat WHERE mfrom='$owner' AND mto='$interactwith' OR mto='$owner' AND mfrom='$interactwith' ORDER BY ID ASC";
                        $result = $conn->query($msg);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $sms = $row["mcont"];
                                $mto = $row["mto"];
                                $mfrom = $row["mfrom"];
                                $date = $row["date"];
                                $time = date('H:i A',$date);
                            if($owner == $mto){
                           ?>
                            <li class="relative flex items-center justify-start">
                                <div class="relative max-w-2/3 md:max-w-2/5 px-4 py-2 bg-gray-50 teal-teal-600 rounded-r-lg rounded-bl-lg shadow">
                                    <span class="block break-words mb-2 mr-10"><?php echo $sms ?></span>
                                    <div class='absolute flex justify-end items-end h-full w-full top-0 left-0'>
                                        <span class='text-xs px-2 py-1'><?php echo $time ?></span>
                                    </div>
                                </div>
                            </li>
                            <?php 
                            }elseif($owner == $mfrom){
                                ?>
                            <li class="flex w-full justify-end">
                                <div class="flex relative max-w-2/3 md:max-w-2/5 px-4 py-2 bg-teal-600 text-white rounded-l-lg rounded-br-lg shadow">
                                    <span class="w-full block break-words mb-2 mr-10"><?php echo $sms ?></span>
                                    <div class='absolute flex flex-col justify-between items-end h-full w-full top-0 left-0'>
                                        <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider" class='text-xs px-2 py-1'><i class='fa fa-ellipsis-verticals'></i></button>
                                        <span class='text-xs px-2 py-1'><?php echo $time ?></span>
                                    </div>
                                </div>
                            </li>
                            <!-- Dropdown menu -->
                            <div id="dropdownDivider" class="hidden z-10 w-20 md:w-24 bg-white rounded overflow-hidden divide-y divide-gray-100 shadow">
                                <div class="">
                                    <button class="block w-full py-1 px-2 text-xs md:text-sm text-gray-700 hover:bg-gray-100">Delete</button>
                                </div>
                            </div>
                                <?php
                            }
                            ?>
                            <?php
                                }
                            }
                            ?>
                        </ul>