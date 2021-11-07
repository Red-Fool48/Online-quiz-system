<?php 

// // print_r($_POST);
// foreach ($_POST as $key => $value) {
//     echo $key."\n";
// }
// header("Content-Type: application/json", true);
// header("Content-Type: multipart/form-data",true);
// echo($_POST['name']);
// print_r($_POST);
session_start();
$data=file_get_contents("php://input");
$f=fopen($_SESSION['name'].".webm","a+");
fwrite($f,$data);

// print_r($_POST)
// echo "OK!";
// echo($data);
?>