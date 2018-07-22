<body style='background-color:whitesmoke;'>
<?php
session_start();
error_reporting(0);
require_once 'connect.php';
$ip=$_SERVER['REMOTE_ADDR'];
if(isset($_POST['register']))
{
$stuid=mysql_real_escape_string(strtoupper($_POST['stuid']));
$username=mysql_real_escape_string($_POST['username']);
$stupasswd=mysql_real_escape_string(md5($_POST['password']));
$sel_user="SELECT * FROM users WHERE stuid='$stuid'";
$run_user=mysqli_query($con,$sel_user);
$check_user=mysqli_fetch_array($run_user);
	if($check_user!=true)
	{
		$ins=mysqli_query($con,"INSERT INTO users (stuid,password,s_name,ip,category) VALUES ('$stuid','$stupasswd','$username','$ip','admin')");
		if($ins==true)
		{
		echo "<h3 style='font-family:georgia;color:green;'>You have registered admin account of ".$stuid." successfully....</h3>";
		echo "<script>alert('You have registered successfully....');window.open('index.php','_self')</script>";
		}
		else{
			echo "<script>alert('Error');window.location='index.php';</script>";
		}
	}
	else
	{
		echo "<h3 style='font-family:georgia;color:red;'>You have already registered...</h3>";
		echo "<script>alert('You have already registered');window.open('index.php','_self')</script>";
	}
}
else{
	echo "<h3 style='font-family:georgia;color:red;'>Enter something<img src='images/loading2.gif'></h3>";
	echo "<script>alert('Invalid Credentials');window.open('index.php','_self');</script>";
}
?>
