<!-- <?php
// include_once 'dbConnection.php';
// $ref=@$_GET['q'];
// $email = $_POST['aemail'];
// $password = $_POST['apassword'];

// $email = stripslashes($email);
// $email = addslashes($email);
// $password = stripslashes($password); 
// $password = addslashes($password);
// $password1=md5($password);
// $password2=md5($password1);
// $result = mysqli_query($con,"SELECT * FROM admin WHERE email = '$email' and  password = '$password1' or email = '$email' and  password = '$password2' or email = '$email' and  password = '$password'  ") or die('Error');
// // $result1 = mysqli_query($con,"SELECT uname FROM admin WHERE email = '$email' and  password = '$password1' or email = '$email' and  password = '$password2' or email = '$email' and  password = '$password'  ") or die('Error');
// $count=mysqli_num_rows($result);

// if($count==1){
// while($row=mysqli_fetch_array($result))
// {
// $uname=$row['uname'];
// $name=$row['name'];	
// }
// }
// else 
// 	header("location:$ref?w=Warning : Access denied");
// session_start();
// if(isset($_SESSION['email'])){
// session_unset();}
// $_SESSION["name"] = $name;
// $_SESSION["key"] ='admin';
// $_SESSION["email"] = $email;
// $_SESSION["uname"]=$uname;
// header("location:dash.php?q=0");


?> -->

<?php
session_start();
if(isset($_SESSION["email"])){
header('location: dash.php?q=0');
}
include_once 'dbConnection.php';
$ref=@$_GET['q'];
$email = $_POST['aemail'];
$password = $_POST['apassword'];

$email = stripslashes($email);
$email = addslashes($email);
$password = stripslashes($password); 
$password = addslashes($password);
$password1=md5($password); 
$password2=md5($password1); 
$result = mysqli_query($con,"SELECT * FROM admin WHERE email = '$email' and password = '$password2' or email = '$email' and password = '$password1' or email = '$email' and password = '$password'") or die('Error');
$count=mysqli_num_rows($result);
if($count==1){
while($row = mysqli_fetch_array($result)) {
	$name  = $row['name'];
	$uname = $row['uname'];
}
$_SESSION["name"] = $name;
$_SESSION["email"] = $email;
$_SESSION['uname']=$uname;
$_SESSION['key']='admin';
header("location:dash.php?q=0");
}
else
{header("location:$ref?w=Wrong Username or Password");}
echo'<script type = "text/javascript">
    function changeHashOnLoad() {
        window.location.href += "#";
        setTimeout("changeHashAgain()", "50");
    }
    function changeHashAgain() 
    {          
        window.location.href += "1";
    }
    var storedHash = window.location.hash;
    window.setInterval(function () {
        if (window.location.hash != storedHash) {
            window.location.hash = storedHash;
        }
    }, 50);

    </script>';
    if(isset($_SESSION['email'])) {
     header("Location: dash.php?q=0"); // redirects them to homepage
     exit; // for good measure
}
?>