<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Online examination System </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
 	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

<!-- <script>
$(function () {
    $(document).on( 'scroll', function(){
        console.log('scroll top : ' + $(window).scrollTop());
        if($(window).scrollTop()>=$(".logo").height())
        {
             $(".navbar").addClass("navbar-fixed-top");
        }

        if($(window).scrollTop()<$(".logo").height())
        {
             $(".navbar").removeClass("navbar-fixed-top");
        }
    });
});</script> -->
</head>

<body>
<div class="header">
<div class="row">
<div class="col-lg-6">
<span class="logo">VQuiz</span></div>
<?php
 include_once 'dbConnection.php';
session_start();
$email=$_SESSION['email'];
$uname=$_SESSION["uname"];
  if(!(isset($_SESSION['email']))){
header("location:index.php");
}
else
{
$name = $_SESSION['name'];
include_once 'dbConnection.php';
echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="dash.php" class="log log1">'.$uname.'</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
}?>

</div></div>
<!-- admin start-->

<!--navigation menu-->
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dash.php?q=0"><b>Dashboard</b></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dash.php?q=0">Home<span class="sr-only">(current)</span></a></li>
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dash.php?q=1">User</a></li>
		<li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="dash.php?q=2">Ranking</a></li>
		<li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="dash.php?q=3">Feedback</a></li>
        <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active"'; ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quiz<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="dash.php?q=4">Add Quiz</a></li>
            <li><a href="dash.php?q=5">Remove Quiz</a></li>
          </ul>
          <li class="dropdown <?php if(@$_GET['q']==11 || @$_GET['q']==6) echo'active"'; ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notice(s)<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="dash.php?q=6">Add Notice</a></li>
            <li><a href="dash.php?q=11">View Notice(s)</a></li></ul>
          <?php 
          if($uname=='admin01') 
          {
            echo '
          <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin(s)<span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="dash.php?q=10">Add Admin(s)</a></li>
            <li><a href="dash.php?q=13">View Admin(s)</a></li></ul>';
          }

          //   if(@$_GET['q']==10 || @$_GET['q']==13)
          //   {
          //   echo'<li><a href="dash.php?q=10">Add Admin(s)</a></li>
          //   <li><a href="dash.php?q=13">View Admin(s)</a></li></ul>';}
          // }
          else
            {
               echo '
          <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin(s)<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="dash.php?q=13">View Admin(s)</a></li></ul>';           
            }
            ?>
         
        </li>
      </ul>
          </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">
<!--home start-->

<?php if(@$_GET['q']==0) {
$temp=$_SESSION['uname'];
if($temp!='admin01')
{
  $result = mysqli_query($con,"SELECT * FROM quiz inner join creates on quiz.eid=creates.eid where uname='$temp' ORDER BY date DESC") or die('Error');
  if(mysqli_num_rows($result)==0)
   {  echo'<div class="panel">Create a new quiz!!</div>';}
  else
  {
   echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Quiz id</b></td><td><b>Total questions</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
 
  }
}
elseif($temp=='admin01')
{
   $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
   echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Quiz id</b></td><td><b>Total questions</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
}
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
  $time = $row['time'];
	$eid = $row['eid'];
$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$eid.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
	<td><b><a href="dash.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
}
else
{
echo '<tr style="color:#99cc32"><td>'.$c++.'</td><td>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
	<td><b><a href="update.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Restart</b></span></a></b></td></tr>';
}
}
$c=0;
echo '</table></div>';
}?>
<?php
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2 && $_SESSION['key']=='admin') 
{
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$session=$_SESSION['key'];
// $type=$_SESSION['type'];

$q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
echo '<div class="panel" style="margin:5%">';
while($row=mysqli_fetch_array($q) )
{
$qns=$row['qns'];
$qid=$row['qid'];
if(!file_exists($qns))
{echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br />'.$qns.'</b><br /><br />';}
else if(file_exists($qns))
{
  echo "<b> Question &nbsp;".$sn."&nbsp;::<br /><embed src='$qns' height='200' width='500'>";
}
}
$q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
echo '<form action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'&session='.$session.'" method="POST"  class="form-horizontal">
<br/>';

while($row=mysqli_fetch_array($q) )
{
$option=$row['option'];
$optionid=$row['optionid'];
echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
}
// echo'<br/><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
$sn1=$sn;  
$sn2=$sn;
if($sn2+1>$total)
{
  $sn2=$sn2;
}
else
{
  $sn2+=1;
}
if($sn1-1==0)
{
  $sn1=1;
}
else
{
  $sn1-=1;
}
echo '<br/><button type="submit class="btn"><a href="dash.php?q=quiz&step=2&eid='.$eid.'&n='.$sn1.'&t='.$total.'&qid='.$qid.'"" title="Return to previous page">&laquo; Go back</a></button><br/></td><td><button type="submit class="btn"><a href="http://localhost/online-quiz-master%20-%20Copy/dash.php?q=quiz&step=2&eid='.$eid.'&n='.$sn2.'&t='.$total.'&qid='.$qid.'"" title="Return to previous page"> Next question &raquo</a></button>';
//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
?>
<?php
//ranking start
if(@$_GET['q']== 2) 
{
    echo '
<div class="search"></div>
<form name="search" action ="dash.php?q=2" method="post"> 
<input id="search" type="text" size="100" id ="search" name="search" placeholder="Enter the quiz id from history"/>
<input id="submit" type="submit" value="search"/>
</form>
 ';
  $search="";
if(isset($_POST['search']))
{
  $search=$_POST['search'];
}
if(isset($search))
{
  echo $search;
}
//$search = $_GET['search'];
$search=mysqli_escape_string($con,$search);
$result = mysqli_query($con,"SELECT * FROM rank where eid ='$search'");
$c=1;

if(mysqli_num_rows($result)==0 && $search!='')
{
  error_reporting(0);
  echo '<div class="panel"><table class="table table-striped title1">No quiz of that quiz id or no one has attempted the quiz yet!!</table></div>';
}
elseif($result && $search!='')
{
//   echo  '<div class="panel"><table class="table table-striped title1">
// <tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
while($row = mysqli_fetch_array($result)) {
  $e=$row['email'];
$s=$row['score'];
$eid=$row['eid'];
}
$q=mysqli_query($con,"SELECT * FROM rank where eid='$eid' ORDER BY score desc " )or die('Error223');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:black"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Quiz id</b></td><td><b>email</b></td><td><b>Score</b></td></tr>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$e=$row['email'];
$s=$row['score'];
$eid=$row['eid'];
$q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
// $college=$row['college'];
}
$c++;
echo '<tr><td style="color:black">'.$c.'</td><td>'.$name.'</td><td>'.$eid.'</td><td>'.$e.'</td><td>'.$s.'</td><td>';
}
}

else
{
  echo' <div class="panel"><table class="table table-striped title1">"Enter the quiz id in the search bar!"</table></div>';
}
echo '</table></div>';}
?>


<!--home closed-->
<!--users start-->
<?php if(@$_GET['q']==1) {
$temp=$_SESSION['uname'];
$result = mysqli_query($con,"SELECT * FROM user inner join user_mobile on user.email=user_mobile.email ") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>Email</b></td><td><b>Mobile</b></td><td></td></tr>';
$c=1;
if($temp=='admin01')
{
while($row = mysqli_fetch_array($result)) {
  $name = $row['name'];
  $mob = $row['mobileno'];
  $gender = $row['gender'];
  $email = $row['email'];

  echo '<tr><td>'.$c++.'</td><td>'.$name.'</td><td>'.$gender.'</td><td>'.$email.'</td><td>'.$mob.'</td>
  <td><a title="Delete User" href="update.php?demail='.$email.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
}
$c=0;
echo '</table></div>'; 
}
else
{ 
while($row = mysqli_fetch_array($result)) {
  $name = $row['name'];
  $mob = $row['mobileno'];
  $gender = $row['gender'];
  $email = $row['email'];

  echo '<tr><td>'.$c++.'</td><td>'.$name.'</td><td>'.$gender.'</td><td>'.$email.'</td><td>'.$mob.'</td>
  </tr>';
}
$c=0;
echo '</table></div>';
}

}?>
<!--user end-->

<!--feedback start-->
<?php if(@$_GET['q']==3) {
$result = mysqli_query($con,"SELECT * FROM `feedback`") or die('<div class="panel">No feedbacks!!</div>');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Subject</b></td><td><b>Feedback</b></td><td><b>Email</b></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	//$date = $row['date'];
	//$date= date("d-m-Y",strtotime($date));
	//$time = $row['time'];
	$subject = $row['subject'];
	//$name = $row['name'];
	 $email = $row['email'];
	$id = $row['id'];
  $feedback=$row['feedback'];
	 echo '<tr><td>'.$c++.'</td>';
	echo '<td>'.$subject.'</a></td><td>'.$feedback.'</td><td>'.$email.'</td>
	<td><a title="Open Feedback" href="dash.php?q=3&fid='.$id.'"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>';
	 echo '<td><a title="Delete Feedback" href="update.php?fdid='.$id.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td>

	</tr>';
}
echo '</table></div>';
}
?>
<!--feedback closed-->

<!--feedback reading portion start-->
<?php if(@$_GET['fid']) {
echo '<br />';
$id=@$_GET['fid'];
$result = mysqli_query($con,"SELECT * FROM feedback WHERE id='$id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$name = $row['email'];
	$subject = $row['subject'];
	// $date = $row['date'];
	// $date= date("d-m-Y",strtotime($date));
	// $time = $row['time'];
	$feedback = $row['feedback'];
	
echo '<div class="panel"<a title="Back to Archive" href="update.php?q1=2"><b><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span></b></a><h2 style="text-align:center; margin-top:-15px;font-family: "Ubuntu", sans-serif;"><b>'.$subject.'</b></h1>';
 echo '<div class="mCustomScrollbar" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:450px; line-height:35px;padding:5px;">
<span style="line-height:35px;padding:5px;">&nbsp;<b>By:</b>&nbsp;'.$name.'</span><br />'.$feedback.'</div></div>';}
}?>
<!--Feedback reading portion closed-->
<!-- Text input-->
<!-- // <div class="form-group">
//   <label class="col-md-12 control-label" for="type"></label>  
//   <div class="col-md-12">
//   <textarea rows="3" cols="4" id="type" name="type" class="form-control" placeholder="Write display type here: all at once [0] or one by one [1] "></textarea>  
//   </div>
// </div> -->
<!--add quiz start-->
<?php
if(@$_GET['q']==4 && !(@$_GET['step']) ) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Quiz Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   
 <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST" enctype="multipart/form-data">

 <fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="name" name="name" placeholder="Enter Quiz title" class="form-control input-md" type="text">    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="right"></label>  
  <div class="col-md-12">
  <input id="right" name="right" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="wrong"></label>  
  <div class="col-md-12">
  <input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer without sign" class="form-control input-md" min="0" type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="time"></label>  
  <div class="col-md-12">
  <input id="time" name="time" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="tag"></label>  
  <div class="col-md-12">
  <input id="tag" name="tag" placeholder="Enter #tag which is used for searching" class="form-control input-md" type="text">
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="desc"></label>  
  <div class="col-md-12">
  <textarea rows="8" cols="8" name="desc" class="form-control" placeholder="Write description here..."></textarea>  
  </div>
</div>


<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';



}
?>
<!--add quiz end-->

<!--add quiz step2 start-->
<?php
if(@$_GET['q']==4 && (@$_GET['step'])==2 ) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 "  method="POST">
<fieldset>
';
// if($type)
// {
//   echo $_SESSION['type'];
// }
// else
// {
//   echo 'No!';
// }
 for($i=1;$i<=@$_GET['n'];$i++)
 {
echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'1"></label>  
  <div class="col-md-12">
  <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'2"></label>  
  <div class="col-md-12">
  <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'3"></label>  
  <div class="col-md-12">
  <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'4"></label>  
  <div class="col-md-12">
  <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
    
  </div>
</div>
<br />
<b>Correct answer</b>:<br />
<select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
   <option value="a">Select answer for question '.$i.'</option>
  <option value="a">option a</option>
  <option value="b">option b</option>
  <option value="c">option c</option>
  <option value="d">option d</option> </select><br /><br />'; 
 }
    
echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';



}
?><!--add quiz step 2 end-->

<!--remove quiz-->
<?php if(@$_GET['q']==5) {

// $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
$temp=$_SESSION['uname'];
if($temp!='admin01')
{
  $result = mysqli_query($con,"SELECT * FROM quiz inner join creates on quiz.eid=creates.eid where uname='$temp' ORDER BY date DESC") or die('Error');
  if(mysqli_num_rows($result)==0)
    echo'<div class="panel">Create a new quiz first!!</div>';
  else
  {
  echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Quiz id</b></td><td><b>Total questions</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
  
  }
}
elseif($temp=='admin01')
{
   $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
   echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total questions</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td><b>Quiz id</b></td></tr>';
}
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['time'];
	$eid = $row['eid'];
	echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$eid.'<td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
	<td><b><a href="update.php?q=rmquiz&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></a></b></td></tr>';
}
$c=0;
echo '</table></div>';

}
?>

<!-- add admin -->
<?php
if(@$_GET['q']==10 && $uname=='admin01') {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter New Admin Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="update.php?q=addadmin"  method="POST">
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="name" name="name" placeholder="Enter Name" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="uname"></label>  
  <div class="col-md-12">
  <input id="uname" name="uname" placeholder="Enter uname" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="email"></label>  
  <div class="col-md-12">
  <input id="email" name="email" placeholder="Enter email" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="password"></label>  
  <div class="col-md-12">
  <input id="password" name="password" placeholder="Enter password" class="form-control input-md"  type="password">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="mobile"></label>  
  <div class="col-md-12">
  <input id="mobile" name="mobile" placeholder="Enter mobile numer" class="form-control input-md" type="number">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>
</fieldset>
</form></div>';
}
elseif($uname!='admin01')
{
  echo'<script>alert You do not have the access</script>';
}
?>
<!-- notice insertion -->
<!-- Text input-->
<!-- <div class="form-group">
  <label class="col-md-12 control-label" for="uname"></label>  
  <div class="col-md-12">
  <input id="uname" name="uname" placeholder="Enter uname" class="form-control input-md" type="text">
    </div>
</div> -->

<?php
if(@$_GET['q']==6 ) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Add notice</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="update.php?q=addnotice"  method="POST">
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="notice"></label>  
  <div class="col-md-12">
  <input id="notice" name="notice" placeholder="Enter notice" class="form-control input-md" type="text">
    </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>
</fieldset>
</form></div>';
}
?>
<!-- view all notices -->
<?php
if(@$_GET['q']== 11) 
{
$temp=$_SESSION['uname'];
if($uname!='admin01')
{
  $q=mysqli_query($con,"SELECT * FROM notice where uname='$temp'" )or die('Error201');
if(mysqli_num_rows($q)==0)
{
echo'<div class="panel">Add a new notice!!</div>';
}
else
{
echo  '<div class="panel">Notices added by you:
<table class="table table-striped title1" >
<tr style="color:black"><td><b>Notice</b></td></tr>'; 
$c=0;
while($row=mysqli_fetch_array($q) )
{
$notice=$row['notice'];
$id=$row['id'];
$c++;
echo '<tr><td>'.$notice.'</td><td><a title="Delete Notice" href="update.php?id='.$id.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
}
}
}
elseif($uname=='admin01')
{
    $q=mysqli_query($con,"SELECT * FROM notice " )or die('Error201');
echo  '<div class="panel">
<table class="table table-striped title1" >
<tr style="color:black"><td><b>Notice</b></td><td><b>By</b></td></tr>';

$c=0;
while($row=mysqli_fetch_array($q) )
{
$notice=$row['notice'];
$id=$row['id'];
$uname=$row['uname'];
$c++;
echo '<tr><td>'.$notice.'</td><td>'.$uname.'</td><td><a title="Delete Notice" href="update.php?id='.$id.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
}
}
// echo '<td><a title="Delete Notice" href="update.php?q=delnotice"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
echo'</table></div>';
}?>
<!-- view all admins -->
<?php
if(@$_GET['q']== 13) 
{
$q=mysqli_query($con,"SELECT name,uname,email FROM admin" )or die('Error231');
echo  '<div class="panel">
<table class="table table-striped title1" >
<tr style="color:black"><td><b>Name</b></td><td><b>uname</b></td><td><b>email</b></td>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$name=$row['name'];
$uname=$row['uname'];
$email=$row['email'];
$c++;
echo '<tr><td>'.$name.'</td><td>'.$uname.'</td><td>'.$email.'</td></tr>';
}
echo'</table></div>';
}?>
<!-- view all admins -->

</div></div>
</body>
</html>