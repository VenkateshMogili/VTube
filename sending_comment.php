			<?php
		session_start();
		error_reporting(0);
		require_once 'connect.php';
		$comment=mysql_real_escape_string($_GET['comment']);
		$video_id=mysql_real_escape_string($_GET['video_i']);
		$user=$_SESSION['stuid'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql=mysqli_query($con,"SELECT * FROM comments where comment='$comment' and user='$user'");
		if(mysqli_fetch_array($sql)==true)
		{
		}
		else{
			$s=mysqli_query($con,"SELECT * FROM users where stuid='$user'");
			while($k=mysqli_fetch_array($s))
			{
				$name=$k['s_name'];
			}
			$send=mysqli_query($con,"INSERT INTO comments(user,name,comment,ip,related_video_id) VALUES ('$user','$name','$comment','$ip','$video_id')");
			if($send==true)
			{
				echo "<b id='sent' style='color:green'>Sent Successfully...</b>";
			}
			else{
				echo "<script>alert('Error');</script>";
			}
		}
		?>
		<script src="js/jquery.js"></script>
		<script>
		$(document).ready(function(){
			$("#sent").fadeToggle(3000);
		});
		</script>