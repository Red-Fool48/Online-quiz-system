<?php
include_once 'dbConnection.php';
ob_start();

$name = $_POST['name'];
$name= ucwords(strtolower($name));
$gender = $_POST['gender'];
$email = $_POST['email'];
//$regno = $_POST['regno'];
$mob = $_POST['mob'];
$password = $_POST['password'];
$name = stripslashes($name);
$name = addslashes($name);
$name = ucwords(strtolower($name));
$gender = stripslashes($gender);
$gender = addslashes($gender);
$email = stripslashes($email);
$email = addslashes($email);
// $regno = stripslashes($regno);
// $regno = addslashes($regno);
$mob = stripslashes($mob);
$mob = addslashes($mob);
$password = stripslashes($password);
$password = addslashes($password);

$to      = $email; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
  
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
  
------------------------
Username: '.$name.'
------------------------
'; // Our message above including the link
                      
$headers = 'From:vquiz.dmin.com'; // Set from headers
$temp=mail($to, $subject, $message, $headers); 
$password=md5($password);
// echo $temp;
// $q3=mysqli_query($con,"INSERT INTO user VALUES  ('$name' , '$gender' ,'$email', '$password')");
$q3=$con->prepare("INSERT INTO user(name,gender,email,password) VALUES (?,?,?,?)");
//INSERT INTO user(name,gender,email,password) VALUES ('$name' , '$gender' ,'$email', '$password')
$q3->bind_param("ssss",$name,$gender,$email,$password);
if($q3->execute())
{
	$usuccess=1;
}
else
{
	$usuccess='Error!!';
}
// if($stmt->execute())
// {
// 	header("location:index.php");
// 	echo'Success';
// }
$q4=mysqli_query($con,"INSERT INTO user_mobile VALUES ('$email','$mob')");
if($q3)
{
session_start();
$_SESSION["email"] = $email;
$_SESSION["name"] = $name;

header("location:account.php?q=1");
}
else
{
header("location:index.php?q7=Email Already Registered!!!");
}
ob_end_flush();
?>