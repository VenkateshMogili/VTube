<?php
session_start();
error_reporting(0);
require_once 'connect.php';
	$question=mysql_real_escape_string($_POST['question']);
	$answer=mysql_real_escape_string($_POST['answer']);
	$stuid=mysql_real_escape_string($_POST['user']);
	$new=mysql_real_escape_string(md5($_POST['new']));
$sql=mysqli_query($con,"SELECT * FROM users where stuid='$stuid' and question='$question' and answer='$answer'");
if(mysqli_fetch_array($sql)==true)
{
	$k=mysqli_query($con,"UPDATE users SET password='$new' where stuid='$stuid' and question='$question' and answer='$answer'");
	if($k==true)
	{
	echo "<script>alert('Your Password has been recovered successfully...');window.location='index.php';</script>";
	}
	else{
		echo "<script>alert('Invalid Credentials');window.location='index.php';</script>";
	}
}
else{
		echo "<script>alert('Invalid Credentials');window.location='index.php';</script>";
	}
?>