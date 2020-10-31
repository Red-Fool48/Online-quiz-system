<?php
session_start();
if(isset($_SESSION["email"])){
header('location: account.php?q=1');
}
include_once 'dbConnection.php';
$ref=@$_GET['q'];
$email = $_POST['email'];
$password = $_POST['password'];

$email = stripslashes($email);
$email = addslashes($email);
$password = stripslashes($password); 
$password = addslashes($password);
$password1=md5($password); 
$password2=md5($password1); 
$result = mysqli_query($con,"SELECT name FROM user WHERE email = '$email' and password = '$password2' or email = '$email' and password = '$password1' or email = '$email' and password = '$password'") or die('Error');
$count=mysqli_num_rows($result);
if($count==1){
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
}
$_SESSION["name"] = $name;
$_SESSION["email"] = $email;
header("location:account.php?q=1");
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
     header("Location: account.php?q=1"); // redirects them to homepage
     exit; // for good measure
}
?>