<?php 
session_start();
if(isset($_SESSION['email'])){
session_destroy();}
$ref= @$_GET['q'];
header("location:$ref");
echo'<script language="javascript" type="text/javascript">
window.history.forward(1);
  setTimeout("disableBackButton()", 0);
    $(document).ready(function () {
       disableBackButton();
    });
</script>';
?>