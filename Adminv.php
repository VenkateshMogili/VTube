<style>
.container{width:90%;}
input{width:300px;color:black;padding:10px;border-radius:5px;border:1px solid lightgray;transition:1s;}
#u{width:150px;background-color:#3399cc;color:white;border:0px;transition:2s;}
#u:hover{width:200px;box-shadow:10px 10px 30px 10px #3399ff;transition:0.4s;cursor:pointer;color:orange;background-color:black;-webkit-animation:v 1s 1;animation:v 1s 1;}
@-webkit-keyframes v{
	50%{width:100px;}
	52%{width:150px;}
}
input:hover{box-shadow:10px 10px 30px 10px #3399ff;}
</style>
<?php
session_start();
error_reporting(0);
require_once 'connect.php';
if(isset($_SESSION['stuid'])==true)
{
	$stu=$_SESSION['stuid'];
	$sql=mysqli_query($con,"SELECT * FROM users where stuid='$stu' and category='admin'");
	if(mysqli_num_rows($sql)==1)
	{
?>
<script src="js/jquery.js"></script>
<div class="container">
<h2 style="color:magenta"><center>Post Video</center></h2>
<div class="jumbotron">
<center><form action="post_noticev.php" method="post" enctype="multipart/form-data">
	<center><h5 style="color:green">Available formats: .mp4</h5></center>
    <select name="category" class="form-control" style="color:#404ffa;">
		<option value="">Select Category</option>
		<option value="CSE">CSE</option>
		<option value="ECE">ECE</option>
		<option value="Mechanical">Mechanical</option>
		<option value="Civil">Civil</option>
		<option value="Chemical">Chemical</option>
		<option value="MME">MME</option>
	</select>
    <b style="color:navy;font-family:arial;">Choose your Video file:</b>
    <input type="file" name="upload" id="fileToUpload" minlength="1"><br>
    <input type="submit" value="Post" name="submit" id="u" title="Post Video">
</form>
</center>
</div>
</div>
<?php
}
	else{
		echo "<script>window.location='404.php';</script>";
	}
}
else{
		echo "<script>window.location='404.php';</script>";
	}
?>
