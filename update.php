<?php
include_once 'dbConnection.php';
session_start();
$email=$_SESSION["email"];
//delete feedback
$temp=0;
if(isset($_SESSION['key'])){
if(@$_GET['fdid'] && $_SESSION['key']=='admin') {
$id=@$_GET['fdid'];
$result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
header("location:dash.php?q=3");
}
elseif(@$_GET['fdid'] && $_SESSION['key']=='account') {
$id=@$_GET['fdid'];
$result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
header("location:account.php?q=4");
}
}

//delete user
if(isset($_SESSION['key'])){
if(@$_GET['demail'] && $_SESSION['key']=='admin') {
$demail=@$_GET['demail'];
$r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$demail' ") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM history WHERE email='$demail' ") or die('Error');
$result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
$res1=mysqli_query($con,"DELETE FROM user_mobile where email='$demail'") or die("Error 77");
header("location:dash.php?q=1");
}
}
//remove quiz
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='admin') {
$eid=@$_GET['eid'];
$result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error1');
while($row = mysqli_fetch_array($result)) {
    $qid = $row['qid'];
$r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error2');
$r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error3');
}
$r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error4');
$r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error5');
$r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error6');
$r4 = mysqli_query($con,"DELETE FROM rank WHERE eid='$eid' ") or die('Error7');
$r5 = mysqli_query($con,"DELETE FROM creates where eid='$eid'") or die("Failed");
header("location:dash.php?q=5");
}
}

//add quiz
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addquiz' && $_SESSION['key']=='admin') {
$name = $_POST['name'];
$name= ucwords(strtolower($name));
$total = $_POST['total'];
$sahi = $_POST['right'];
$wrong = $_POST['wrong'];
$time = $_POST['time'];
$tag = $_POST['tag'];
$desc = $_POST['desc'];
$t1=$_SESSION['uname'];
$id=uniqid();
$GLOBALS['$temp'] = $id;
$q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('$id','$name' , '$sahi' , '$wrong','$total','$time' ,'$desc','$tag', NOW())");
$q4=mysqli_query($con,"INSERT INTO creates(eid,uname) values('$id','$t1')") or die("Not working");
header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
}

//add question
// if(isset($_SESSION['key'])){
// if(@$_GET['q']== 'addqns' && $_SESSION['key']=='admin') {
// $n=@$_GET['n'];
// $eid=@$_GET['eid'];
// $ch=@$_GET['ch'];

// for($i=1;$i<=$n;$i++)
//  {
//  $qid=uniqid();
//  $qns=$_POST['qns'.$i];
// $q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
//   $oaid=uniqid();
//   $obid=uniqid();
// $ocid=uniqid();
// $odid=uniqid();
// $a=$_POST[$i.'1'];
// $b=$_POST[$i.'2'];
// $c=$_POST[$i.'3'];
// $d=$_POST[$i.'4'];
// $qa=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
// $qb=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
// $qc=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
// $qd=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');
// $e=$_POST['ans'.$i];
// switch($e)
// {
// case 'a':
// $ansid=$oaid;
// break;
// case 'b':
// $ansid=$obid;
// break;
// case 'c':
// $ansid=$ocid;
// break;
// case 'd':
// $ansid=$odid;
// break;
// default:
// $ansid=$oaid;
// }
// $qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");

//  }
// header("location:dash.php?q=0");
// }
// }
//add admin
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addadmin' && $_SESSION['key']=='admin') {
$name = $_POST['name'];
$name= ucwords(strtolower($name));
$uname = $_POST['uname'];
$email = $_POST['email'];
$password = $_POST['password'];
$password=md5($password);
$password=md5($password);
$mobile = $_POST['mobile'];
$q3=mysqli_query($con,"INSERT INTO admin  values ('$email','$name','$name','$password')");
$q4=mysqli_query($con,"INSERT INTO admin_mobile values('$email','$mobile')");
header("location:dash.php?q=10");
}
}
//quiz start
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) 
{
    // $eid=@$_GET['eid'];
    // $sn=@$_GET['n'];
    // $total=@$_GET['t'];
    // $ans=$_POST['ans'];
    // $qid=@$_GET['qid'];
    // // $count=0;
    // $s=0;
    // $qno=array();
    // $mark=array();
    // $q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
    // $sahi='';
    // for($i=0;$i<$total;$i++)
    // {
    //     array_push($qno, 0);
    // }
    // while($row=mysqli_fetch_array($q) )
    // {
    // $ansid=$row['ansid'];
    // }
    // if($ans == $ansid)
    // {
    // // $count+=1;
    // $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
    // while($row=mysqli_fetch_array($q) )
    // {
    // $sahi=$row['sahi'];
    // }
    // // if($qno[$sn]==0)
    // // {
    // //     $qno[$sn]=1;
    // //     array_push($mark, $sahi);
    // // }
    // // elseif($qno[$sn]==1)
    // // {
    // //     $mark[$sn]=$sahi;
    // //     echo' ..;';
    // // }
    
    
    // if($sn == 1)
    // {
    // $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
    // $rowcount=mysqli_num_rows($q);
    // if($rowcount==0)
    // {
    //     $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
    // }
    // }
    // $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' order by level desc limit 1 ")or die('Error115');
    
    // while($row=mysqli_fetch_array($q) )
    // {
    // $s=$row['score'];
    // $r=$row['sahi'];
    // $w=$row['wrong'];
    // }
    // // if($r<$sn)
    // $r++;
    // // else
    // // {$r=$r;}
    // // $w=$sn-$r;
    // // if($w<0)
    // // {
    // //     $w=0;
    // // }
    // $s=$s+$sahi;
    // $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');
    // } 

    // //wrong ans
    // else
    // {
    // $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');
    // // $count+=1;
    
    // while($row=mysqli_fetch_array($q) )
    // {
    // $wrong=$row['wrong'];
    // }
    
    // if($sn == 1)
    // {
    // $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
    // $rowcount=mysqli_num_rows($q);
    // if($rowcount==0)
    // {
    //     $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
    // }
    // }
    // $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' order by level desc limit 1 ")or die('Error115');
    // while($row=mysqli_fetch_array($q) )
    // {
    // $s=$row['score'];
    // $w=$row['wrong'];
    // // $r=$row['sahi'];
    // }
    // // if($w<$count)
    // // $w++;
    // // else
    // // {$w=$w;}
    // // $r=$sn-$w;
    // if($sn!=$total)
    // {
    //     $sn++;
    //     header("location:account.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total") or die("Erorr !!")
    // }
    // // if($qno[$sn]==0)
    // // {
    // //     $qno[$sn]=1;
    // //     array_push($mark, -$wrong);
    // // }
    // // elseif($qno[$sn])
    // // {
    // //     $mark[$sn]=-($wrong);
    // // }
    // // if($r<0)
    // // {
    // //     $r=0;
    // // }
    // $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
    // // foreach($mark as $m)
    // // {
    // //     $s+=$m;
    // // }
    // $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
    // if($sn != $total)
    // {
    // $sn++;
    // header("location:account.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
    // }

    // else if( $_SESSION['key']!='admin')
    // {
    // $q=mysqli_query($con,"SELECT score,eid FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
    // while($row=mysqli_fetch_array($q) )
    // {
    // $s=$row['score'];
    // $eid=$row['eid'];
    // }
    // $q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email' and eid='$eid'" )or die('Error161');
    // $rowcount=mysqli_num_rows($q);
    // if($rowcount == 0)
    // {
    // $q2=mysqli_query($con,"INSERT INTO rank VALUES('$eid','$email','$s',NOW())")or die('Error165');
    // }
    // else
    // {
    // $q3=mysqli_query($con,"SELECT * FROM history where email='$email'");	
    // while($row=mysqli_fetch_array($q) )
    // {
    // $sun=$row['score'];
    // }
    // while($row=mysqli_fetch_array($q3))
    // {
    //     $eid=$row['eid'];
    // }
    // $sum=$s+$sun;
    // // $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
    // $q=mysqli_query($con,"INSERT INTO rank VALUES('$eid','$email','$s',NOW())")or die('Error174');
    // }
    // header("location:account.php?q=result&eid=$eid");
    // }
    // else
    // {
    // header("location:account.php?q=result&eid=$eid");
    // }
$q5;
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$ans=$_POST['ans'];
$qid=@$_GET['qid'];
$count=0;
$q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
$sahi='';
while($row=mysqli_fetch_array($q) )
{
$ansid=$row['ansid'];
}
if($ans == $ansid)
{
$count+=1;
$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
while($row=mysqli_fetch_array($q) )
{
$sahi=$row['sahi'];
}
if($sn == 1)
{
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
$rowcount=mysqli_num_rows($q);
if($rowcount==0)
{
    $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
}
}
$q5=mysqli_query($con,"INSERT INTO response VALUES('$eid','$qid','$ans','$email')")or die("ERROR!");
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' order by level desc limit 1 ")or die('Error115');

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$r=$row['sahi'];
$w=$row['wrong'];
}
if($r<$sn)
$r++;
else
{$r=$r;}
$w=$sn-$r;
if($w<0)
{
    $w=0;
}
// if($s<$sn*($sahi)+1)
// {
// $s+=$sahi;   
// }
if($s==0 && $sn==1)
{
    $s=$sahi;
}
// if($s<=0 && $s<$sn*($sahi)+1 && $sn==1)
// {
//  $s+=$sahi;
// }
elseif($s>0 && $s<$sn*($sahi)+1 && $sn>=1)
{
    $s+=$sahi;
}
if($s<0 && $s<$sn*($sahi)+1 )
{
    $s+=$sahi;
}
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r,`wrong`=$w, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');

} 
else
{
$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');
$count+=1;

while($row=mysqli_fetch_array($q) )
{
$wrong=$row['wrong'];
}
$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
while($row=mysqli_fetch_array($q) )
{
$sahi=$row['sahi'];
}
if($sn == 1)
{
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
$rowcount=mysqli_num_rows($q);
if($rowcount==0)
{
    $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
}
}
$q5=mysqli_query($con,"INSERT INTO response VALUES('$eid','$qid','$ans','$email')")or die("ERROR!");
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' order by level desc limit 1 ")or die('Error115');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
}
// if($w<$sn)
// $w++;
// $r=$sn-$w;
// if($r<0)
// {
//     $r=0;
// }
// if($s-$wrong>-($count)*($wrong)-1 && $s>0)
// {
// $s-=$wrong;   
// }
// elseif($s-$wrong>-($count)*($wrong)-1 && $s<=0)
// {
//     if($count>1)
//     {
//         $s-=$wrong;     
//     }
//     if($s<=0)
//     {
//         $s-=$wrong;
//     }
// }
$s=$s-$wrong;
$w++;
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
}
if($sn != $total)
{
$sn++;
header("location:account.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
}
else if( $_SESSION['key']!='admin')
{
$q=mysqli_query($con,"SELECT score,eid FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$eid=$row['eid'];
}
$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email' and eid='$eid'" )or die('Error161');
$rowcount=mysqli_num_rows($q);
if($rowcount == 0)
{
$q2=mysqli_query($con,"INSERT INTO rank VALUES('$eid','$email','$s',NOW())")or die('Error165');
}
else
{
$q3=mysqli_query($con,"SELECT * FROM history where email='$email'");    
while($row=mysqli_fetch_array($q) )
{
$sun=$row['score'];
}
while($row=mysqli_fetch_array($q3))
{
    $eid=$row['eid'];
}
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
$q=mysqli_query($con,"INSERT INTO rank VALUES('$eid','$email','$s',NOW())")or die('Error174');
}
// echo'<script type = "text/javascript">
//     function changeHashOnLoad() {
//         window.location.href += "#";
//         setTimeout("changeHashAgain()", "50");
//     }
//     function changeHashAgain() 
//     {          
//         window.location.href += "1";
//     }
//     var storedHash = window.location.hash;
//     window.setInterval(function () {
//         if (window.location.hash != storedHash) {
//             window.location.hash = storedHash;
//         }
//     }, 50);
//     </script>';
header("location:account.php?q=result&eid=$eid");
}
else
{
header("location:account.php?q=result&eid=$eid");
}
}
//add questions
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addqns' && $_SESSION['key']=='admin') {
$n=@$_GET['n'];
$eid=@$_GET['eid'];
$ch=@$_GET['ch'];

for($i=1;$i<=$n;$i++)
 {
 $qid=uniqid();
 $qns=$_POST['qns'.$i];
$q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
  $oaid=uniqid();
  $obid=uniqid();
$ocid=uniqid();
$odid=uniqid();
$a=$_POST[$i.'1'];
$b=$_POST[$i.'2'];
$c=$_POST[$i.'3'];
$d=$_POST[$i.'4'];
$qa=mysqli_query($con,"INSERT INTO options VALUES ('$qid','$a','$oaid')") or die('Error61'.$i.'akof');
$qb=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
$qc=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
$qd=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');
$e=$_POST['ans'.$i];
switch($e)
{
case 'a':
$ansid=$oaid;
break;
case 'b':
$ansid=$obid;
break;
case 'c':
$ansid=$ocid;
break;
case 'd':
$ansid=$odid;
break;
default:
$ansid=$oaid;
}
$qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");

 }
header("location:dash.php?q=0");
}
}
//for admin quiz
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2 &&$_SESSION['key']=='admin') {
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$ans=$_POST['ans'];
$qid=@$_GET['qid'];
$q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
while($row=mysqli_fetch_array($q) )
{
$ansid=$row['ansid'];
}
if($ans == $ansid)
{
$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
while($row=mysqli_fetch_array($q) )
{
$sahi=$row['sahi'];
}
if($sn == 1)
{
$q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
}
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$r=$row['sahi'];
}
$r++;
$s=$s+$sahi;
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');

} 
else
{
$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');

while($row=mysqli_fetch_array($q) )
{
$wrong=$row['wrong'];
}
if($sn == 1)
{

$q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
}
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
}
$w++;
$s=$s-$wrong;
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
}
if($sn != $total)
{
$sn++;
header("location:dash.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
}
}



//add feedback
if(@$_GET['q']== 'addfeedback') {
//$name = $_POST['name'];
//$name= ucwords(strtolower($name));
$email = $_SESSION['email'];
$subject = $_POST['subject'];
$feedback = $_POST['feedback'];
// $date = $_POST['date'];
// $time = $_POST['time'];
$id=$_POST['id'];
$q3=mysqli_query($con,"INSERT INTO feedback(`email`,`subject`,`feedback`) VALUES ('$email','$subject','$feedback')");
header("location:account.php?q=4");
}

//addnotice
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addnotice' && $_SESSION['key']=='admin') {
$notice=$_POST['notice'];
$uname=$_SESSION['uname'];
$q3=mysqli_query($con,"INSERT INTO notice(notice,uname) values('$notice','$uname')");
header("location:dash.php?q=6");    
}
}

//restart quiz
if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
$eid=@$_GET['eid'];
$n=@$_GET['n'];
$t=@$_GET['t'];
$q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
$q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
while($row=mysqli_fetch_array($q) )
{
$sun=$row['score'];
}
$sun=$sun-$s;
$q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
header("location:account.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
}

//delete notice
if(isset($_SESSION['key'])){
if($_SESSION['key']=='admin' && @$_GET['id']) {
//if($_SESSION['key']=='admin' ) {
$id=@$_GET['id'];
$uname=$_SESSION['uname'];
$r1 = mysqli_query($con,"DELETE FROM notice WHERE id='$id'") or die('Error');
header("location:dash.php?q=11");
}
}
?>

<?php
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addadmin' && $_SESSION['key']=='admin') {
$name = $_POST['name'];
$name= ucwords(strtolower($name));
$uname = $_POST['uname'];
$email = $_POST['email'];
$password = $_POST['password'];
$password=md5($password);
$password=md5($password);
$mobile = $_POST['mobile'];
$q3=mysqli_query($con,"INSERT INTO admin values ('$email','$name','$uname','$password'");

header("location:dash.php?q=10");
}
}?>


<!-- <?php
// include_once 'dbConnection.php';
// session_start();
// $email=$_SESSION['email'];
// //delete feedback
// $temp=0;
// if(isset($_SESSION['key'])){
// if(@$_GET['fdid'] && $_SESSION['key']=='admin') {
// $id=@$_GET['fdid'];
// $result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
// header("location:dash.php?q=3");
// }
// elseif(@$_GET['fdid'] && $_SESSION['key']=='account') {
// $id=@$_GET['fdid'];
// $result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
// header("location:account.php?q=4");
// }
// }

// //delete user
// if(isset($_SESSION['key'])){
// if(@$_GET['demail'] && $_SESSION['key']=='admin') {
// $demail=@$_GET['demail'];
// $r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$demail' ") or die('Error');
// $r2 = mysqli_query($con,"DELETE FROM history WHERE email='$demail' ") or die('Error');
// $result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
// header("location:dash.php?q=1");
// }
// }
// //remove quiz
// if(isset($_SESSION['key'])){
// if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='admin') {
// $eid=@$_GET['eid'];
// $result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error1');
// while($row = mysqli_fetch_array($result)) {
//     $qid = $row['qid'];
// $r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error2');
// $r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error3');
// }
// $r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error4');
// $r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error5');
// $r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error6');
// $r4 = mysqli_query($con,"DELETE FROM rank WHERE eid='$eid' ") or die('Error7');
// header("location:dash.php?q=5");
// }
//}

// //add quiz
// if(isset($_SESSION['key'])){
// if(@$_GET['q']== 'addquiz' && $_SESSION['key']=='admin') {
// $name = $_POST['name'];
// $name= ucwords(strtolower($name));
// $total = $_POST['total'];
// $sahi = $_POST['right'];
// $wrong = $_POST['wrong'];
// $time = $_POST['time'];
// $tag = $_POST['tag'];
// $desc = $_POST['desc'];
// $id=uniqid();
// $GLOBALS['$temp'] = $id;
// $type=$_POST['type'];
// $q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('$id','$name' , '$sahi' , '$wrong','$total','$time' ,'$desc','$tag', NOW())");

// header("location:dash.php?q=4&step=2&eid=$id&n=$total");
// }
// }

// //add question
// if(isset($_SESSION['key'])){
// if(@$_GET['q']== 'addqns' && $_SESSION['key']=='admin') {
// $n=@$_GET['n'];
// $eid=@$_GET['eid'];
// $ch=@$_GET['ch'];

// for($i=1;$i<=$n;$i++)
//  {
//  $qid=uniqid();
//  $qns=$_POST['qns'.$i];
// $q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
//   $oaid=uniqid();
//   $obid=uniqid();
// $ocid=uniqid();
// $odid=uniqid();
// $a=$_POST[$i.'1'];
// $b=$_POST[$i.'2'];
// $c=$_POST[$i.'3'];
// $d=$_POST[$i.'4'];
// $qa=mysqli_query($con,"INSERT INTO options(qid,option,optionid) VALUES  ('$qid','$a','$oaid')") or die('Error61');
// $qb=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
// $qc=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
// $qd=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');
// $e=$_POST['ans'.$i];
// switch($e)
// {
// case 'a':
// $ansid=$oaid;
// break;
// case 'b':
// $ansid=$obid;
// break;
// case 'c':
// $ansid=$ocid;
// break;
// case 'd':
// $ansid=$odid;
// break;
// default:
// $ansid=$oaid;
// }
// $qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");

//  }
// header("location:dash.php?q=0");
// }
// }
// //add admin
// if(isset($_SESSION['key'])){
// if(@$_GET['q']== 'addadmin' && $_SESSION['key']=='admin') {
// $name = $_POST['name'];
// $name= ucwords(strtolower($name));
// $uname = $_POST['uname'];
// $email = $_POST['email'];
// $password = $_POST['password'];
// $password=md5($password);
// $password=md5($password);
// $mobile = $_POST['mobile'];
// $q3=mysqli_query($con,"INSERT INTO admin (name,uname,email,password) values ('$name','$uname','$email','$password','$mobile')");

// header("location:dash.php?q=10");
// }
// }
// //quiz start
// if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
// $eid=@$_GET['eid'];
// $sn=@$_GET['n'];
// $total=@$_GET['t'];
// $ans=$_POST['ans'];
// $qid=@$_GET['qid'];
// $marks=array();
// $r=0;
// $w=0;
// $s=0;
// $s1=0;
// $w1=0;
// for($i=1;$i<$total;$i++)
// {
//     array_push($marks,0);
// }
// $q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
// while($row=mysqli_fetch_array($q) )
// {
// $ansid=$row['ansid'];
// }
// if($ans == $ansid)
// {
// $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
// while($row=mysqli_fetch_array($q) )
// {
// $sahi=$row['sahi'];
// }
// $s1=$sahi;
// $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
// if($sn == 1 && mysqli_num_rows($q)==0)
// {
// $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
// }
// // $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');

// // while($row=mysqli_fetch_array($q) )
// // {
// // $s=$row['score'];
// // $r=$row['sahi'];
// // }
// // $r++;
// // $s=$s+$sahi;
// // $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');
// $marks[$sn]=$sahi;

// } 
// else
// {
// $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');

// while($row=mysqli_fetch_array($q) )
// {
// $wrong=$row['wrong'];
// }
// $w1=$wrong;
// $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
// if($sn == 1 && mysqli_num_rows($q)==0)
// {
// $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
// }

// //$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
// // while($row=mysqli_fetch_array($q) )
// // {
// // $s=$row['score'];
// // $w=$row['wrong'];
// // }
// // $w++;
// // $s=$s-$wrong;
// $marks[$sn]=-$wrong;
// }
// // foreach($marks as $temp)
// for($i=1;$i<$total+1;$i++)
// {
//     $s=$s+$marks[$i];
//     if($marks[$i]==$s1)
//         {
//             $r++;
//         }
//     elseif($marks[$i]==-$w1)
//         {$w++;}
//     else
//     {
//         $r+=0;
//         $w+=0;
//     }

// }
// $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
// echo $r;
// if($sn != $total)
// {
// $sn++;
// header("location:account.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
// }
// else if( $_SESSION['key']!='admin')
// {
// $q=mysqli_query($con,"SELECT score,eid FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
// while($row=mysqli_fetch_array($q) )
// {
// $s=$row['score'];
// $eid=$row['eid'];
// }
// $q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
// $rowcount=mysqli_num_rows($q);
// if($rowcount == 0)
// {
// $q2=mysqli_query($con,"INSERT INTO rank VALUES('$eid','$email','$s',NOW())")or die('Error165');
// }
// else
// {
// $q3=mysqli_query($con,"SELECT * FROM history where email='$email'");    
// while($row=mysqli_fetch_array($q) )
// {
// $sun=$row['score'];
// }
// while($row=mysqli_fetch_array($q3))
// {
//     $eid=$row['eid'];
// }
// $sun=$sun;
// // UPDATE `rank` SET `eid`=$eid, `score`=$sun ,time=NOW() WHERE email= '$email'
// $q=mysqli_query($con,"INSERT INTO rank VALUES('$eid','$email','$s',NOW())")or die('Error174');
// }
// header("location:account.php?q=result&eid=$eid");
// }
// else
// {
// header("location:account.php?q=result&eid=$eid");
// }
// }

// //for admin quiz
// if(@$_GET['q']== 'quiz' && @$_GET['step']== 2 &&$_SESSION['key']=='admin') {
// $eid=@$_GET['eid'];
// $sn=@$_GET['n'];
// $total=@$_GET['t'];
// $ans=$_POST['ans'];
// $qid=@$_GET['qid'];
// $q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
// while($row=mysqli_fetch_array($q) )
// {
// $ansid=$row['ansid'];
// }
// if($ans == $ansid)
// {
// $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
// while($row=mysqli_fetch_array($q) )
// {
// $sahi=$row['sahi'];
// }
// if($sn == 1)
// {
// $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
// }
// $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');

// while($row=mysqli_fetch_array($q) )
// {
// $s=$row['score'];
// $r=$row['sahi'];
// }
// $r++;
// $s=$s+$sahi;
// $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');

// } 
// else
// {
// $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');

// while($row=mysqli_fetch_array($q) )
// {
// $wrong=$row['wrong'];
// }
// if($sn == 1)
// {
// $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
// }
// $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
// while($row=mysqli_fetch_array($q) )
// {
// $s=$row['score'];
// $w=$row['wrong'];
// }
// $w++;
// $s=$s-$wrong;
// $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
// }
// if($sn != $total)
// {
// $sn++;
// header("location:dash.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
// }
// }



// //add feedback
// if(@$_GET['q']== 'addfeedback') {
// //$name = $_POST['name'];
// //$name= ucwords(strtolower($name));
// $email = $_POST['email'];
// $subject = $_POST['subject'];
// $feedback = $_POST['feedback'];
// // $date = $_POST['date'];
// // $time = $_POST['time'];
// $id=$_POST['id'];
// $q3=mysqli_query($con,"INSERT INTO feedback(`email`,`subject`,`feedback`) VALUES ('$email','$subject','$feedback')");
// header("location:account.php?q=4");
// }

// //addnotice
// if(isset($_SESSION['key'])){
// if(@$_GET['q']== 'addnotice' && $_SESSION['key']=='admin') {
// $notice=$_POST['notice'];
// $uname=$_POST['uname'];
// $q3=mysqli_query($con,"INSERT INTO notice values('$notice','$uname')");
// header("location:dash.php?q=6");
// }
// }

// //restart quiz
// if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
// $eid=@$_GET['eid'];
// $n=@$_GET['n'];
// $t=@$_GET['t'];
// $q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
// while($row=mysqli_fetch_array($q) )
// {
// $s=$row['score'];
// }
// $q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
// $q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
// while($row=mysqli_fetch_array($q) )
// {
// $sun=$row['score'];
// }
// $sun=$sun-$s;
// $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
// header("location:account.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
// }

// ?>
//  -->



