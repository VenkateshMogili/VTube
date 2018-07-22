<style>
.comments3_list{
		list-style:none;
	}
	.loadmorecomments{
		color:#FFF;
		border-radius:5px;
		width:30%;
		border:0px;
		height:40px;font-size:18px;background:#42B8DD;
		outline:0;
	}
	.loadbutton{
		text-align:center;
		list-style: none;
	}
.iconimg:hover{background-color:lightgray;padding:20px;-webkit-transform:rotate(360deg);-moz-transform:rotate(360deg);transform:rotate(360deg);}
.iconimg{transition:1s;}
</style>		
		<?php
		session_start();
		error_reporting(0);
		require_once 'connect.php';
		$student=$_SESSION['stuid'];
		echo '<div style="background-color:lightgray;padding:10px;border-radius:10px;" class="col-md-12">
<ul class="comments_list">';
		$video_i=mysql_real_escape_string($_GET['video']);
		$querycheck=mysqli_num_rows(mysqli_query($con,"SELECT * FROM comments where related_video_id='$video_i'"));
		if($querycheck==0)
		{
			echo "<center><h2 style='color:red'>No Comments</h2></center>";
		}
		else{
		$resultsPerPage=30;
		$query=mysqli_query($con,"SELECT * FROM comments where related_video_id='$video_i' ORDER BY id DESC LIMIT 0, $resultsPerPage");
		while($r=mysqli_fetch_array($query))
		{
			$id=$r['id'];
			$user=$r['user'];
			$name=$r['name'];
			$comment=$r['comment'];
			$reply=$r['reply'];
			$time=$r['time'];
			$related_video_id=$r['related_video_id'];
			echo '
			<div style="border:1px solid lightgray;padding:5px;"><img src="images/profile.png" style="border:2px solid white;width:50px;height:50px;border-radius:100px;"> <b style="color:#3399cc">'.$name.'</b><i style="float:right"><i class="fa fa-clock-o"></i> '.$time.'</i><br>
			<p style="text-indent:100px;text-align:justify">'.$comment.'</p>';
			if(isset($_SESSION['stuid']))
				{
					$stu=$_SESSION['stuid'];
					$ad=mysqli_query($con,"SELECT * FROM users where stuid='$stu' and category='admin'");
					if(mysqli_fetch_array($ad)==true)
					{
						echo '<a href="del_link.php?cat=comments&&link='.$id.'" target="_blank" style="margin-top:-35px;float:right;border:1px solid red;border-radius:100px;padding:5px;width:30px;height:30px;text-align:center;">X</a>';
					}
				}
			if(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM comments where id='$id'")))
			{
				if(strlen($reply)>0)
				{
					echo '<b style="color:blue;margin:50px;">Reply: </b><br><p style="text-indent:100px;color:green;text-align:justify">'.$reply.'</p>';
				}
			}
			if(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users where stuid='$student' and category='admin'")))
			{
				if(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM comments where id='$id'")))
				{
					if(strlen($reply)<1)
					{
						echo '<p align="right"><a href="give_reply.php?video_ii='.$id.'" target="_blank"><b style="color:#3399cc;cursor:pointer;">Reply</b></a></p>';
					}
				}
			}
		}

			echo '</div><br>';
				
			}
					?>
		<li class="loadbutton"><button class="loadmorecomments" data-page="2">Load More</button><span class="ld"></span></li>
	</ul>
</div>