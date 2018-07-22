<title>Post Video</title>
<?php
session_start();
require_once 'connect.php';
if(isset($_SESSION['stuid']))
{
	$stu=$_SESSION['stuid'];
	$sql=mysqli_query($con,"SELECT * FROM users where stuid='$stu' and category='admin'");
	if(mysqli_num_rows($sql)==1)
	{
$stuid=$_SESSION['stuid'];
	$cat=mysql_real_escape_string(htmlspecialchars(htmlspecialchars_decode(stripcslashes($_POST['category']))));
	$sd=$_SESSION['stuid'];
//video file uploading...
     $filename = mysql_real_escape_string($_FILES['upload']['name']);
     $venkateshfname = $_FILES['upload']['name'];
     $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
    $tmpname  = $_FILES['upload']['tmp_name'];
    $filesize = $_FILES['upload']['size'];
    $ftype = $_FILES['upload']['type'];
    $extension=strpbrk($_FILES['upload']['name'],".");
     $vpb_file_extensions = pathinfo($filename, PATHINFO_EXTENSION); // File Extension
    $vpb_allowed_file_extensions = array("mp4","avi","mpeg","m4a");
    $date=date('d-m-Y');
    $time=time();
    $ip=$_SERVER['REMOTE_ADDR'];
    $venkateshfname=mysql_real_escape_string($filename);
    $fp = fopen($tmpname, 'r');
    fclose($fp);
    $uploadDir = 'Videos/';
        
          if (!in_array($vpb_file_extensions, $vpb_allowed_file_extensions)) 
    {
        //Display file type error error
        echo "<script>alert('only .mp4 or .avi or .mpeg files are allowed');window.location='index.php';</script>";
    }
    else 
    {
            $filePath = $uploadDir . $venkateshfname;
$result = move_uploaded_file($tmpname, $filePath);
if (!$result) {
echo "<script>alert('Error uploading file..File is too large');window.location='index.php';</script>";
exit;
}
else{
					mysqli_query($con,"INSERT INTO videos(video_by,video,video_code,ip,time,full_time,related,category) values('$stuid','$venkateshfname',md5('$venkateshfname'),'$ip',NOW(),'$date','$withoutExt','$cat')");
 echo "<center><div style='width:100%;height:100%;background-color:lightgray;'><h2 style='color:#3cc74e;background-color:white;padding:10px;font-family:georgia;border:2px solid green;'>Video Uploaded Successfully...</h2><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><a href='index.php' style='color:teal;font-size:20px;font-family:arial;text-decoration:none;border:2px solid red;background-color:white;padding:10px;border-radius:100px;'><--Go back to Homepage</a></div></center>";
				}
}
}
}
else{
	echo "<h1>Please Login</h1>";
}
?>
