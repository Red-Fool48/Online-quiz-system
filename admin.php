<?php
include_once 'dbConnection.php';
$ref=@$_GET['q'];
$email = $_POST['aemail'];
$password = $_POST['password'];

$email = stripslashes($email);
$email = addslashes($email);
$password = stripslashes($password); 
$password = addslashes($password);
$password1=md5($password);
$password2=md5($password1);
$result = mysqli_query($con,"SELECT email,uname,name FROM admin WHERE email = '$email' and  password = '$password1' or email = '$email' and  password = '$password2' or email = '$email' and  password = '$password'  ") or die('Error');
// $result1 = mysqli_query($con,"SELECT uname FROM admin WHERE email = '$email' and  password = '$password1' or email = '$email' and  password = '$password2' or email = '$email' and  password = '$password'  ") or die('Error');
$count=mysqli_num_rows($result);
$uname="";
if($count==1){
while($row=mysqli_fetch_array($result))
{
$uname=$row['uname'];
$name=$row['name'];	
}

session_start();
if(isset($_SESSION['email'])){
session_unset();}
$_SESSION["name"] = $name;
$_SESSION["key"] ='admin';
$_SESSION["email"] = $email;
$_SESSION["uname"]=$uname;
header("location:dash.php?q=0");
}
else header("location:$ref?w=Warning : Access denied");
?>