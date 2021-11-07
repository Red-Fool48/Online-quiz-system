<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Online examination </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

<!-- <script type="text/javascript">
  function timeout()
  {
    var minute=Math.floor($difference/60);
    var second=($difference%60);
     if($difference<=0)
     {
      document.getElementById(("quiz")).submit();
     }
     else
     {
      document.getElementById("timer").innerHTML=minute+":"+second;
     }
     $difference--;
     var setTimeout(function(){timeout()},1000);
  }
</script>
 --> 
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
 <!--alert message-->
<script type = "text/javascript">
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

    </script>
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->

</head>
<?php
include_once 'dbConnection.php';
?>

<body>
<div class="header">
<div class="row">
<div class="col-lg-6">
<span class="logo">VQuiz</span></div>
<div class="col-md-4 col-md-offset-2">
 <?php
 include_once 'dbConnection.php';
session_start();
if($usuccess==1)
{
  echo $usuccess;
}
else
{
  echo '....';
}
  if(!(isset($_SESSION['email']))){
header("location:index.php");
}
else
{
$name = $_SESSION['name'];
$email=$_SESSION['email'];
$_SESSION["key"] ='account';

include_once 'dbConnection.php';
echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php?q=1" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
}

?>
</div>
</div></div>
<div class="bg">

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
      <a class="navbar-brand" href="#"><b>VQuiz</b></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li <?php if(@$_GET['q']==1) echo'class="active"'; ?> ><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">
            <form name="search" action ="account.php?q=1" method="POST"> 
            <input id="search" type="text" id ="search" placeholder="Type here">
            <input id="submit" type="submit" value="Search">
            </form></span></a></li>
          <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;History</a></li>
		      <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="account.php?q=3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Ranking</a></li>
          <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==15) echo'active"'; ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Feedback<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="account.php?q=4">View Feedback</a></li>
            <li><a href="account.php?q=15">Add Feedback</a></li>
          </ul>
          <!-- <li <?php if(@$_GET['q']==4) echo'class="active"'; ?>><a href="account.php?q=4">&nbsp;Feedback</a></li> 
          <li <?php if(@$_GET['q']==15) echo'class="active"'; ?>><a href="account.php?q=15">&nbsp;Add Feedback</a></li> -->
        <li <?php if(@$_GET['q']==11) echo'class="active"'; ?>><a href="account.php?q=11">&nbsp;View Notice(s)</a></li>
        </ul> 
      </div><!-- navbar-collapse -->
  </div><!-- container-fluid -->
</nav><!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">

<!--home start-->
<!-- <form name="search" action ="account.php?q=1" method="GET"> 
<input id="search" type="text" id ="search" name="search" placeholder="Type here"/>
<input id="submit" type="submit" value="Search"/>
</form> -->
<script type="text/javascript"> 
        function preventBack() { 
            window.history.forward();  
        } 
          
        setTimeout("preventBack()", 0); 
          
        window.onunload = function () { null }; 
    </script>
<?php if(@$_GET['q']==1) {
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
echo '
<div class="search"></div>
<form name="search" action ="account.php?q=1" method="post"> 
<input id="search" type="text" id ="search" name="search" placeholder="Type here"/>
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
$result = mysqli_query($con,"SELECT * FROM quiz where tag like '%$search%' or eid='$search'");

$c=1;
if(mysqli_num_rows($result)==0)
{
  error_reporting(0);
  echo '<div class="panel"><table class="table table-striped title1">No quiz of that tag or quiz id exists!!</table></div>';
}

elseif($result && $search!='')
{
  echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
  $time = $row['time'];
	$eid = $row['eid'];
}
$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
	<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
}
else
{
echo '<tr style="color:black"><td>'.$c++.'</td><td>'.$title.'&nbsp;<span title="This quiz is already solved by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
	<td><b><a href="" class="pull-right btn sub1" style="margin:0px;background:grey"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Done</b></span></a></b></td></tr>';
}
}
else
{
  echo '<div class="panel"><table class="table table-striped title1">Please enter a tag</table></div>';
}

$c=0;
echo '</table></div>';
}
// <!-- <script>
// var seconds = 40;
//     function secondPassed() {
//     var minutes = Math.round((seconds - 30)/60);
//     var remainingSeconds = seconds % 60;
//     if (remainingSeconds < 10) {
//         remainingSeconds = "0" + remainingSeconds; 
//     }
//     document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
//     if (seconds == 0) {
//         clearInterval(countdownTimer);
//         document.getElementById('countdown').innerHTML = "Buzz Buzz";
//     } else {    
//         seconds--;
//     }
//     }
// var countdownTimer = setInterval('secondPassed()', 1000);
// </script>
//  -->
// <!--quiz start-->
?>
<?php

if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
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
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$q2=mysqli_query($con,"SELECT * from quiz where eid='$eid'");

$q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
echo '<div class="panel" style="margin:5%">';
// need to add a col called type to store the type of question. If !mcq, need to leave options blank and need to figure out how to let evaluator give marks
while($row=mysqli_fetch_array($q))
{
$qns=$row['qns'];
$qid=$row['qid'];
echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br />'.$qns.'</b><br /><br />';
}
$q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
echo '<form id ="quiz" action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
<br />';

while($row=mysqli_fetch_array($q) )
{
$option=$row['option'];
$optionid=$row['optionid'];
echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
}

echo'<br/><button id="submitt" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
echo'
<script language="javascript" type="text/javascript">
window.history.forward(1);   
    window.onload = () => {

      const parts = [];
      let mediaRec;
          var strr;
          // document.getElementById("start").onclick = () => {
            navigator.mediaDevices.getUserMedia({audio:true,video:true}).then((stream)=>{
              strr=stream;
              // document.getElementById("video").srcObject = stream;
              mediaRec = new MediaRecorder(stream);
            
            mediaRec.start(1000);
    
            mediaRec.ondataavailable = (e) => {
              parts.push(e.data);
            };
            console.log(mediaRec.state);
            console.log(parts);
            // console.log(counter);
            });
            
         // };
          document.getElementById("submitt").onclick = () => {
            mediaRec.stop();
            const blob = new Blob(parts, {
              type: "video/webm",
            });
            const url = URL.createObjectURL(blob);

            strr.getTracks().forEach((track)=>{
              track.stop();
            })
           fetch(`http://localhost/online_quiz_system_cpy/post_trial.php`,{method:"POST",body:blob})
           .then(response=>{
              if(response.ok) 
              // console.log(response.text())
              return response
              else 
              throw Error("Could not post :(");
          })
          .then(response=>{
              console.log(response.text());
          }).catch(err=>alert(err));
          }
        };
</script>';
// if($remainingSeconds==0)
// {
//   window.setInterval(function(){ 
//     document.getElementById("quiz").submit(); 
// }, 2000);
// }
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


// echo '<br/><tr><td><button type="submit class="btn btn-primary"><a href="account.php?q=quiz&step=2&eid='.$eid.'&n='.$sn1.'&t='.$total.'&qid='.$qid.'"" title="Return to previous page">&laquo; Go back</a></button><br/></td><td><button type="submit class="btn btn-primary"><a href="account.php?q=quiz&step=2&eid='.$eid.'&n='.$sn2.'&t='.$total.'&qid='.$qid.'"" title="Return to previous page"> Next question &raquo;</a></button></td></tr>';


// if($remainingSeconds==0)
// {
//   window.setInterval(function(){ 
//     document.getElementById("quiz").submit(); 
// }, 2000);
// }
// $sn1=$sn;  
// $sn2=$sn;
// if($sn2+1>$total)
// {
//   $sn2=$sn2;
// }
// else
// {
//   $sn2+=1;
// }
// if($sn1-1==0)
// {
//   $sn1=1;
// }
// else
// {
//   $sn1-=1;
// }


// echo '<br/><tr><td><button type="submit class="btn btn-primary"><a href="account.php?q=quiz&step=2&eid='.$eid.'&n='.$sn1.'&t='.$total.'&qid='.$qid.'"" title="Return to previous page">&laquo; Go back</a></button><br/></td><td><button type="submit class="btn btn-primary"><a href="account.php?q=quiz&step=2&eid='.$eid.'&n='.$sn2.'&t='.$total.'&qid='.$qid.'"" title="Return to previous page"> Next question &raquo;</a></button></td></tr>';
//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}?>
<!--quiz end-->

<?php
//result display
if(@$_GET['q']== 'result' && @$_GET['eid']) 
{
$eid=@$_GET['eid'];
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' order by level limit 1" )or die('Error157');
echo  '<div class="panel">
<center><h1 class="title" style="color:black">Result</h1><center><br/><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
echo '<tr style="color:grey"><td>Total Questions</td><td>'.$qa.'</td></tr>
      <tr style="color:grey"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
	  <tr style="color:grey"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
	  <tr style="color:grey"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
$q=mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' and eid= '$eid' " )or die('Error157');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
echo '<tr style="color:grey"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
echo '</table></div>';

}
?>

<?php
//history start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
echo  '<div class="panel">
<table class="table table-striped title1" >
<tr style="color:black"><td><b>S.N.</b></td><td><b>Quiz</b></td><td><b>Question Solved</b></td><td><b>Quiz id</b></td><td><b>Correct answers</b></td><td><b>Wrong answers<b></td><td><b>Score</b></td>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$eid=$row['eid'];
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
$q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
while($row=mysqli_fetch_array($q23) )
{
$title=$row['title'];
}
$c++;
echo '<tr><td>'.$c.'</td><td>'.$title.'</td><td>'.$qa."</td><td>
<a href='account.php?q=history&step=2&eid=$eid'>
".$eid.'</a></td><td>'.$r.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
}
echo'</table></div>';
}
// history part 2: responses and answers
if(@$_GET['q']== 'history' && @$_GET['step']==2 && @$_GET['eid']!=0)
{
  $eid=@$_GET['eid'];
  $email=$_SESSION['email'];
  $q=mysqli_query($con,"select * from questions where eid='$eid'");
  $sn=1;
  while($row=mysqli_fetch_array($q))
  {
    $qns=$row['qns'];
    $qid=$row['qid'];
    $q4=mysqli_query($con,"select * from answer where qid='$qid'");
    echo '<div class="panel" style="margin:5%"> Qno:'.$sn. '<br>' .$qns.'<br>Options: <br>';  
    $q2=mysqli_query($con,"select * from options where qid='$qid'");
    $q3=mysqli_query($con,"select * from response where qid='$qid'");
    //if(mysqli_fetch_array($q3))
    while($row4=mysqli_fetch_array($q4))
    {
      $correct=$row4['ansid'];
      while($row3=mysqli_fetch_array($q3))
    {
      $marked=$row3['response'];
    while($row2=mysqli_fetch_array($q2) )
    {
      $option=$row2['option'];
      $optionid=$row2['optionid'];
      if($optionid==$marked && $marked==$correct)
      {
        echo '<div style="background-color:lightgreen"><input type="radio" name="ans" value="" disabled '.$optionid.'>'.$option.'<br /><br /></div>';
      }
      else if($optionid==$marked && $marked != $correct)
      {
        echo '<div style="background-color:red"><input type="radio" name="ans" value="" disabled '.$optionid.'>'.$option.'<br /><br /></div>';  
      }
      // else echo 'hmm';
      else
      echo'<input type="radio" name="ans" value="" disabled '.$optionid.'>'.$option.'<br /><br />';
         }
    echo '</div>';
      }
      $sn+=1;
  }  
  }
}


//ranking start
if(@$_GET['q']==3) 
{
  echo '
<div class="search"></div>
<form name="search" action ="account.php?q=3" method="post"> 
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
  echo '<div class="panel"><table class="table table-striped title1">No quiz of that quiz id!!</table></div>';
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

<!-- feedback table -->
<?php if(@$_GET['q']==4) {
  $temp=$_SESSION['email'];
$result = mysqli_query($con,"SELECT * FROM `feedback` where email='$temp'") or die('Error');
if(mysqli_num_rows($result)==0)
{
  echo '<div class="panel">Please add a feedback first!!</div>';

}

else
{echo '<div class="panel"><table class="table table-striped title1">
<tr><td><b>id</b></td><td><b>Subject</b></td><td><b>Feedback</b></td></tr>';
$c=1;

while($row = mysqli_fetch_array($result)) {
	// $date = $row['date'];
	// $date= date("d-m-Y",strtotime($date));
	//$time = $row['time'];
	$subject = $row['subject'];
	//$name = $row['name'];
	// $email = $row['email'];
  $feedback=$row['feedback'];
	$id = $row['id'];
	 echo '<tr><td>'.$c++.'</td>';
  echo '<td><a title="Click to open feedback" href="account.php?q=4&fid='.$id.'">'.$subject.'</a></td><td>'.$feedback.'</td>
  <td><a title="Open Feedback" href=account.php?q=4&fid='.$id.'"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>';
	echo '<td><a title="Delete Feedback" href="update.php?fdid='.$id.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td>
	</tr>';
}
echo '</table></div>';
}
}
?>
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
<?php if(@$_GET['q']==15)
{
	// <!-- Text input-->
	// <div class="form-group">
	//   <label class="col-md-12 control-label" for="id"></label>  
	//   <div class="col-md-12">
	//   <input id="id" name="id" placeholder="Enter id" class="form-control input-md" type="number">
	//   </div>
	// </div>

// <!-- Text input-->
// <div class="form-group">
//   <label class="col-md-12 control-label" for="email"></label>  
//   <div class="col-md-12">
//   <input id="email" name="email" placeholder="Enter email" class="form-control input-md" type="text">
    
//   </div>
// </div>

	echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Feedback Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="update.php?q=addfeedback"  method="POST">
<fieldset>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="subject"></label>  
  <div class="col-md-12">
  <input id="subject" name="subject" placeholder="Enter subject" class="form-control input-md"  type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="feedback"></label>  
  <div class="col-md-12">
  <input id="feedback" name="feedback" placeholder="Enter feedback" class="form-control input-md" type="text"> 
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
// <!-- Text input-->
// <div class="form-group">
//   <label class="col-md-12 control-label" for="name"></label>  
//   <div class="col-md-12">
//   <input id="name" name="name" placeholder="Enter Name" class="form-control input-md" type="text">
//   </div>
// </div>
// <!-- Text input-->
// <div class="form-group">
//   <label class="col-md-12 control-label" for="date"></label>  
//   <div class="col-md-12">
//   <input id="date" name="date" placeholder="Enter date" class="form-control input-md" type="text"> 
//   </div>
// </div>
// <!-- Text input-->
// <div class="form-group">
//   <label class="col-md-12 control-label" for="feedback"></label>  
//   <div class="col-md-12">
//   <input id="time" name="time" placeholder="Enter time" class="form-control input-md" type="text"> 
//   </div>
// </div>
}?>
<?php
//notice start
if(@$_GET['q']== 11) 
{

echo '
<div class="search"></div>
<form name="search" action ="account.php?q=11" method="post"> 
<input id="search" type="text" id ="search" name="search" placeholder="Type here"/>
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
$q=mysqli_query($con,"SELECT * FROM notice where uname='$search'" )or die('Error201');
if(mysqli_num_rows($q)==0)
{
echo'<div class="panel">Enter the admin uname!!</div>';
}
else
{

echo  '<div class="panel">
Notice(s) that have been written by the teacher with uname '.$search.'
<table class="table table-striped title1" >
<tr style="color:black"><td><b>Notice</b></td>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$notice=$row['notice'];
$c++;
echo '<tr><td>'.$notice.'</td></tr>';
}
echo'</table></div>';
}
}?>
</div></div></div></div>
<!--Footer start-->
<!-- <div class="row footer">
<div class="col-md-6 box">
<a href="" target="_blank">About us</a>
</div>
<div class="col-md-6 box">
<a href="#" data-toggle="modal" data-target="#login">Admin Login</a></div>


    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal for admin login-->
	 <div class="modal fade" id="login">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span style="color:orange;font-family:'typo' ">LOGIN</span></h4>
      </div>
      <div class="modal-body title1">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<form role="form" method="post" action="admin.php?q=index.php">
<div class="form-group">
<input type="text" name="uname" maxlength="20"  placeholder="Admin user id" class="form-control"/> 
</div>
<div class="form-group">
<input type="password" name="password" maxlength="15" placeholder="Password" class="form-control"/>
</div>
<div class="form-group" align="center">
<input type="submit" name="login" value="Login" class="btn btn-primary" />
</div>
</form>
</div><div class="col-md-3"></div></div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--footer end--> 


</body>
</html>
