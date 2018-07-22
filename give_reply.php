<?php
session_start();
error_reporting(0);
require_once 'connect.php';
$video_ii=mysql_real_escape_string($_GET['video_ii']);
if(isset($_SESSION['stuid'])==true)
{
	$stu=$_SESSION['stuid'];
	$sql=mysqli_query($con,"SELECT * FROM users where stuid='$stu' and category='admin'");
	if(mysqli_num_rows($sql)==1)
	{
		$ko=mysqli_query($con,"SELECT * FROM comments where id='$video_ii'");
		while($koo=mysqli_fetch_array($ko))
		{
			$comment=$koo['comment'];
			$send_by=$koo['name'];
		}
?>
<link rel="stylesheet" href="css/bootstrap.css">
<title>Reply</title>
<body style="background-color:whitesmoke">
	<div class="container">
		<b>Posted By: <?php echo $send_by;?></b>
	<p style="text-indent:50px;font-size:18px;color:teal;">"<?php echo $comment;?>"</p>
</div>
<?php
echo '<form action="give_replys.php?video_ii='.$video_ii.'" method="post">';
?><br>
<center><textarea class="form-control" name="reply" placeholder="Write Your Reply Here...." required style='width:50%;height:300px;'></textarea></center>

<center><input type="submit" value="Send" class="btn btn-info" id="subb"></center>
</form>
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
<script src="js/jquery.js"></script>
<script src="js/myscript.js"></script>