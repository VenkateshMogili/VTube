<?php
session_start();
error_reporting(0);
require_once 'connect.php';
if(isset($_SESSION['stuid'])==true)
{
	$stu=$_SESSION['stuid'];
	$cat=mysql_real_escape_string(htmlentities(htmlspecialchars_decode($_GET['cat'])));
	$id=mysql_real_escape_string(htmlentities(htmlspecialchars_decode($_GET['link'])));
	$sql=mysqli_query($con,"SELECT * FROM users where stuid='$stu' and category='admin'");
	if(mysqli_fetch_array($sql)==true)
	{
		if($cat=='videos')
		{
			$check=mysqli_query($con,"SELECT * FROM videos where id='$id'");
		if(mysqli_fetch_array($check)==true)
		{
		$deleted=mysqli_query($con,"DELETE FROM videos where id='$id'");
		if($deleted==true)
		{
			echo '<script>alert("Deleted Successfully...");window.location="etube.php"</script>';
		}
		else{
			echo '<script>alert("There is some error...Try again");window.location="index.php"</script>';
		}
		}
		else{
			echo '<script>alert("File not found");window.location="index.php"</script>';
		}
		}
		else if($cat=='users')
		{
			$check=mysqli_query($con,"SELECT * FROM users where id='$id'");
		if(mysqli_fetch_array($check)==true)
		{
		$deleted=mysqli_query($con,"DELETE FROM users where id='$id'");
		if($deleted==true)
		{
			echo '<script>alert("Deleted Successfully...");window.location="index.php"</script>';
		}
		else{
			echo '<script>alert("There is some error...Try again");window.location="index.php"</script>';
		}
		}
		else{
			echo '<script>alert("File not found");window.location="index.php"</script>';
		}
		}
		else if($cat=='comments')
		{
			$check=mysqli_query($con,"SELECT * FROM comments where id='$id'");
		if(mysqli_fetch_array($check)==true)
		{
		$deleted=mysqli_query($con,"DELETE FROM comments where id='$id'");
		if($deleted==true)
		{
			echo '<script>alert("Deleted Successfully...");window.close();</script>';
		}
		else{
			echo '<script>alert("There is some error...Try again");window.location="index.php"</script>';
		}
		}
		else{
			echo '<script>alert("File not found");window.location="index.php"</script>';
		}
		}
	}
		
	//If not admin	
	else{
		echo '<script>window.location="index.php";</script>';
	}
	
	if($cat=="" || $id="")
	{
		header("Location: etube.php");
	}
}
else{
	echo '<center><h1>You are not the admin</h1><script>window.location="index.php"</script>';
}

?>
