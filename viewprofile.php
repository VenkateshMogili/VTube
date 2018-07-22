<?php
session_start();
error_reporting(0);
require_once 'connect.php';
if(isset($_SESSION['stuid'])){
	$id=$_SESSION['stuid'];
	$sql=mysqli_query($con,"SELECT * FROM users where stuid='$id' ");
	while ($row=mysqli_fetch_array($sql))
	{
	$stuid=$row['s_id'];
	$name=$row['s_name'];
	$gender=$row['s_gender'];
	$branch=$row['s_branch'];
	$class=$row['s_class'];
	$year=$row['s_year'];
	$dorm=$row['s_dorm'];
	$mobile=$row['s_phone'];
	$dateof_reg=$row['date_registered'];
	$profile=$row['profile'];
	}

echo "<center><table style='background-color:lightgray;padding:10px;'><tr>";
if ($profile==""){
	echo "<a href='#' onclick='load_page(\"profile.php?stuid=".$stuid."\")' title='click here to change your profile picture'><img src='images/profile.png' width='200' height='200' style='border-radius:100px;'></a>";
}else{
	echo "<a href='#' onclick='load_page(\"profile.php?stuid=".$stuid."\")' title='click here to change your profile picture'><img src=".$profile." width='200' height='200' style='margin-left:-30px;border-radius:100px;box-shadow:1px 2px 30px 2px #FF4500;'></a>";
	}
	echo "<b style='font-size:30px;margin-left:100px;text-align:center;color:white;text-shadow:1px 2px 3px #3399cc'>".$id."</b></tr></table></center><center><table><tr><td>";
	echo "Name: </td><td>".$name."</td></tr><tr><td>";
	echo "Gender: </td><td>".$gender."</td></tr><tr><td>";
	echo "Branch: </td><td>".$branch."</td></tr><tr><td>";
	echo "Class: </td><td>".$class."</td></tr><tr><td>";
	echo "Year: </td><td>".$year."</td></tr><tr><td>";
	echo "Dorm: </td><td>".$dorm."</td></tr><tr><td>";
	echo "Mobile: </td><td>".$mobile."</td></tr><tr><td>";
	echo "Date of registration: </td><td>".$dateof_reg."</tr></table></div></center><br><br><br><br>";
}
else{
	echo "<script>alert('Please login to see your profile');window.location='login.php';</script>";
}
?>
<style>
table{width:50%;box-shadow:1px 2px 3px black;background-color:#3399ff;opacity:0.8;}
table:hover{opacity:1;transition:0.4s;}
#t1{background-color:#FF6000;opacity:0.9;width:50%;box-shadow:1px 2px 3px black;}
#t1:hover{opacity:1;transition:0.4s;}
th{background-color:#FF6000;padding:10px;color:white;}
td{padding:10px;width:30%;font-family:arial;text-shadow:0px 0px 3px black;color:white;}
</style>
