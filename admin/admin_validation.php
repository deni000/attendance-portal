<?php

session_start();

$user = $_POST['username'];
$password = $_POST['password'];
$con = mysqli_connect('localhost','root');
mysqli_select_db($con, 'bca_attendance');

$q = "SELECT * FROM admin_tbl WHERE admin_user_name ='$user' && admin_password ='$password'";
$result = mysqli_query($con, $q);
$num = mysqli_num_rows($result);

if($num == 1)
{
  
  $_SESSION['admin_id']=$user;
  header('location:http://localhost/BCAattendance/admin/admin_home.php');
}
else
{
  
  header('location:http://localhost/BCAattendance/admin/index.php');
  echo "invalid username password combination";
} 


?>