<?php
session_start();
error_reporting(0);
require_once 'connect.php';
if(isset($_SESSION['stuid'])) 
{
$stuid=strip_tags($_SESSION['stuid']);
$givd=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users WHERE stuid='$stuid'"));
if($givd==true)
{
if(isset($_POST['submit'])) 
{
	//file variables
     $filename = $_FILES['File']['name'];
     $venkateshfname = $_FILES['File']['name'];
    $tmpname  = $_FILES['File']['tmp_name'];
    $filesize = $_FILES['File']['size'];
    $ftype = $_FILES['File']['type'];
    $extension=strpbrk($_FILES['File']['name'],".");
     $vpb_file_extensions = pathinfo($filename, PATHINFO_EXTENSION); // File Extension
	$vpb_allowed_file_extensions = array("jpg","jpeg","gif","png");
	$startdate = strtotime("Monday");
	$enddate = strtotime("+6 weeks",$startdate);
	$d2=ceil(($d1-time())/60/60);
	$d3=strrev("ABCDEFGHIJKLMNOPQSRTUVXYZ");
	$date=date('Y-m-d').time();
	$venkateshfname=$stuid."-".$date."_".$d3.".".$vpb_file_extensions;
    $fp = fopen($tmpname, 'r');
    $file = fread($fp, filesize($tmpname));
    $file = addslashes($file);
    fclose($fp);
    $uploadDir = 'profiles/';
		
		  if (!in_array($vpb_file_extensions, $vpb_allowed_file_extensions)) 
	{
		//Display file type error error
		echo "<script>alert('only jpg,jpeg,gif,png are allowed');window.location='index.php';</script>";
	}
	else 
	{
			$filePath = $uploadDir . $venkateshfname;
$result = move_uploaded_file($tmpname, $filePath);
if (!$result) {
echo "<script>alert('Error uploading file..or file is too large or file is not an image format');window.location='index.php';</script>";
exit;
}


$query = mysqli_query($con,"UPDATE users SET profile='profiles/$venkateshfname' where stuid='$stuid' ") or die(mysql_error());
if ($query==true){
	echo "<script>alert('Your Profile Picture has been updated successfully..!!!');window.location='index.php';</script>";
}
    }
 }
}
}

else
{
	echo "<script>alert('Invalid');window.location='index.php';</script>";
}
?>
