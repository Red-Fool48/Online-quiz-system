<?php
include 'account.php';
$from_time=date('Y-m-d H:i:s');
$to_time=$_SESSION["end_time"];

$timefirst=strtotime($from_time);
$timesecond=strtotime($to_time);
$difference=$timesecond-$timefirst;
echo gmdate("i:s",$difference);
?>