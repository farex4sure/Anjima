<?php
session_start();
$data = $_POST;

if (empty($data['name']) ||
    empty($data['password']) ||
   
    empty($data['cpassword'])) {
    
    die('<span class="text-red-500">Please fill all required fields!</span>');
}

if ($data['password'] !== $data['cpassword']) {
   die('<span class="text-red-500">Password and Confirm password should match!</span>');   
}
else{
if(strlen($data['password']) <8){
  die('<span class="text-red-500">Password should not be less than 8 characters</span>');   

}
if(strlen($data['password']) > 16){
  die('<span class="text-red-500">Password should not be more than 16 characters</span>');   

}
else{
$_SESSION['name']=$_POST['name'];
$_SESSION['password']=$_POST['password'];

    echo "<span class='text-green-500'>Upload your picture in the next page</span>";
 ?>
<script>
window.location.href="upload.php";
</script>
 <?php 

}
}
?>