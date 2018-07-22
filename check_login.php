<body style='background-color:whitesmoke;'>
<?php
session_start();
error_reporting(0);
require_once 'connect.php';
$ip=$_SERVER['REMOTE_ADDR'];
if(isset($_POST['user']) && isset($_POST['pass']))
{
$stuid=mysql_real_escape_string(strtoupper($_POST['user']));
$stupasswd=mysql_real_escape_string($_POST['pass']);
$stupasswd=md5($stupasswd);
$sel_user="SELECT * FROM users WHERE stuid='$stuid' AND password='$stupasswd'";
$run_user=mysqli_query($con,$sel_user);
$check_user=mysqli_num_rows($run_user);
	if($check_user>0)
	{
		$_SESSION['stuid']=$stuid;
		echo "<h3 style='font-family:georgia;color:yellow;'>Please wait....It's checking<img src='images/loading2.gif'></h3>";
		echo "<script>window.open('index.php','_self')</script>";
	}
	else
	{
		echo "<h3 style='font-family:georgia;color:red;'>Wrong UserId or Password...<img src='images/loading2.gif'></h3>";
		echo "<script>window.open('index.php','_self')</script>";
	}
}
else{
	echo "<h3 style='font-family:georgia;color:red;'>Wrong UserId or Password...<img src='images/loading2.gif'></h3>";
	echo "<script>alert('Invalid Credentials');window.open('index.php','_self');</script>";
}
?>
