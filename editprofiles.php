<?php
session_start();
error_reporting(0);
require 'connect.php';
if(isset($_SESSION['stuid'])==true)
{
$stuid=$_SESSION['stuid'];
$block=mysql_real_escape_string($_POST['block']);
$room=mysql_real_escape_string($_POST['room']);
$year=mysql_real_escape_string($_POST['year']);
$dorm=mysql_real_escape_string($_POST['dorm']);
$mobile=mysql_real_escape_string($_POST['mobile']);
$branch=mysql_real_escape_string($_POST['branch']);
$question=mysql_real_escape_string($_POST['squestion']);
$answer=mysql_real_escape_string($_POST['sanswer']);
$gender=mysql_real_escape_string($_POST['gender']);

$cls=$block."".$room;
$ip=$_SERVER['REMOTE_ADDR'];

$sql=mysqli_query($con,"SELECT * FROM users where stuid='$stuid' ");
while($row=mysqli_fetch_array($sql))
{
	$noofedits=$row['noofedits'];
}
$k=mysqli_query($con,"UPDATE users SET s_gender='$gender',s_branch='$branch',s_class='$cls',s_year='$year',s_dorm='$dorm',s_phone='$mobile',lastupdate=NOW(),lastupdateip='$ip',question='$question',answer='$answer',noofedits=noofedits+1 WHERE stuid='$stuid'");
if($k==true)
{
	echo "<script>alert('Profile updated successfully...');window.location='index.php';</script>";
}
else{
	echo "<script>alert('There are some errors..Please fill correctly...');window.history.back();</script>";
}
}
else{
	echo "<script>alert('Please Login');window.location='index.php';window.location='login.php';</script>";
}
?>