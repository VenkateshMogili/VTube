<style>
b{color:white;transition:1s}
b:hover{color:yellow;text-shadow:1px 2px 3px green;transition:0.5s}
a:hover{text-decoration:none;transition:0.5s;color:green;text-shadow:1px 2px 3px lime;}
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
</style>
<body>
<?php
session_start();
error_reporting(0);
require_once 'connect.php';
$today=date('Y-m-d');
$stuid=$_SESSION['stuid'];
$video=mysql_real_escape_string(htmlentities(htmlspecialchars_decode($_GET['video'])));
$video=mysql_real_escape_string(str_replace(' ','%20',$video));
$ip=$_SERVER['REMOTE_ADDR'];
$sqlv=mysqli_query($con,"SELECT * FROM videos where video_code!='$video' ");
while($row=mysqli_fetch_array($sqlv))
{
$videos=$row['video_code'];
$views=$row['views'];
}
?>

<?php
if($videos!=true && $views==null)
{
?>
<?php
}
if($video=="")
{
	echo "<script>window.location='404.php';</script>";
}
$sql=mysqli_query($con,"SELECT * FROM videos where video_code='$video' ");
if(mysqli_fetch_array($sql)!=true)
{
	echo "<script>window.location='404.php';</script>";
}
$sql=mysqli_query($con,"SELECT * FROM videos where video_code='$video' ");
while($row=mysqli_fetch_array($sql))
{
$videos=$row['video'];
$videoname=$row['related'];
$subtitle=$row['subtitle'];
$views=$row['views'];
$id=$row['id'];
$views=$views+1;
}

if($videos==true){
$sl=mysqli_query($con,"SELECT * FROM users where stuid='$stuid' ");
while($r=mysqli_fetch_array($sl))
{
	$username=$r['s_name'];
}
mysqli_query($con,"UPDATE videos SET views='$views' where video_code='$video' ");
mysqli_query($con,"INSERT INTO videovisitors(login_by,username,ip,time,video) VALUES ('$stuid','$username','$ip',NOW(),'$videos') ");
?>
<?php
echo '<video id="vid" src="Videos/'.$videos.'" style="border-top:2px solid red;background-color:black;width:100%;height:480px;box-shadow:1px 2px 3px lightgray;" type="video/mp4" controls autoplay="true"></video>';
		?>
		<i class="fa fa-play mym" onclick="document.getElementById('vid').play()" style="float:right;margin:10px;cursor:pointer;display:none" id="play" accesskey="p"></i>
<i class="fa fa-pause mym" onclick="document.getElementById('vid').pause()" style="float:right;margin:10px;cursor:pointer;display:none" id="pause" accesskey="o"></i>

		<div style="width:100%;z-index:99999;background-color:black;opacity:0.5;padding:10px;" id='menu'>
			<b onclick="document.getElementById('vid').play();" style="margin:5px;" title="Play"><i class='fa fa-play my'></i></b>
			<b onclick="document.getElementById('vid').pause()" style="margin:5px;" title="Pause"><i class='fa fa-pause my'></i></b>
			<b onclick="document.getElementById('vidd').style.width='100%';document.getElementById('viddm').style.width='100%'" style="margin:10px;">Wideview</b>
			<b onclick="document.getElementById('vidd').style.width='66.6%';document.getElementById('viddm').style.width='33.4%';" style="margin:10px;">Compactview</b>
	<i style="border:1px solid red;padding:10px;margin:50px;"><i>Playback Speed:</i>
	<button onclick='slow()' style='background-color:teal;color:white;border:0px;border-radius:100px;text-align:center;width:30px;height:30px;'>0.5</button>
	<button onclick='normal()' style='background-color:teal;color:white;border:0px;border-radius:100px;width:30px;height:30px;'>1.0</button>
	<button onclick='speed2()' style='background-color:teal;color:white;border:0px;border-radius:100px;width:30px;height:30px;'>1.5</button>
	<button onclick='speed()' style='background-color:teal;color:white;border:0px;border-radius:100px;width:30px;height:30px;'>2.0</button>
<span class="badge" onclick="repeat()" style="cursor:pointer;background-color:black;color:white;">Repeat</span>
</i>
<?php
echo '<a href="Videos/'.$videos.'" download='.$videos.'><span class="badge" style="cursor:pointer;background-color:black;color:#3cc74e;float:right"><i class="fa fa-download my"></i> Download</span></a>';
?>
		</div>
		<?php
		echo "<div class='col-md-12' style='background-color:white;padding:10px;box-shadow:1px 2px 3px lightgray'><h3>".$videoname."<b style='color:black;float:right;font-size:15px;'><i class='fa fa-eye' style='font-size:1em;'></i>Views: ".$views."</b></h3></div>";
		?>
			<?php
			if(isset($_SESSION['stuid']))
			{
			?>
		<div class="col-md-12" style="background-color:white;padding:5px;">
			<h4>Comments ( <?php echo mysqli_num_rows(mysqli_query($con,"SELECT * FROM comments where related_video_id=".$id.""));?> )</h4>
			<div class="col-md-1"><img src="images/profile.png" style="width:50px;height:50px;border-radius:100px;"></div>
			<div class="col-md-11"><textarea style="height:50px;" class="form-control" id="comment" placeholder="Write your comment here..."></textarea><br>
			 <button id="send_comment" style="float:right" class="btn btn-primary">Comment</button>
			<center><span id="sending_comment"></span></center>
			<input type="text" value="<?php echo $id;?>" id="video_i" style="display:none">
		</div>
	</div>
			<div class="col-md-12" id="comments_page" style="height:100%;background-color:white;">
				<?php
				echo '<div style="background-color:lightgray;padding:10px;border-radius:10px;" class="col-md-12">
<ul class="comments_list">';
		$querycheck=mysqli_num_rows(mysqli_query($con,"SELECT * FROM comments where related_video_id='$id'"));
		if($querycheck==0)
		{
			echo "<center><h2 style='color:red'>No Comments</h2></center>";
		}
		  		else{
		$resultsPerPage=10;
		$query=mysqli_query($con,"SELECT * FROM comments where related_video_id='$id' ORDER BY id DESC LIMIT 0, $resultsPerPage");
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
			if(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM comments where id='$id'")))
			{
				if(strlen($reply)>0)
				{
					echo '<b style="color:blue;margin:50px;">Reply: </b><br><p style="text-indent:100px;color:green;text-align:justify">'.$reply.'</p>';
				}
				else{
					
				}
			}
			if(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users where stuid='$student' and category='admin'")))
			{
				if(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM comments where id='$id'")))
				{
					if(strlen($reply)<1)
					{
						echo '<p align="right"><b onclick="give_reply(\'give_reply.php?video_ii='.$id.'\')" style="color:#3399cc;cursor:pointer;">Reply</b></p>';
					}
				}
			}

			echo '</div><br>';
				/*if(isset($_SESSION['stuid']))
				{
					$stu=$_SESSION['stuid'];
					$ad=mysqli_query($con,"SELECT * FROM users where stuid='$stu' and category='admin'");
					if(mysqli_fetch_array($ad)==true)
					{
						echo '<a href="del_link.php?cat=videos&&link='.$id.'" style="margin:5px;float:right;border:1px solid red;border-radius:100px;padding:5px;width:30px;height:30px;text-align:center;">X</a>';
					}
				}*/
			}
					?>
		<li class="loadbutton"><button class="loadmorecomments" data-page="2">Load More</button><span class="ld"></span></li>
	</ul>
				<br><br><br>
			<br><br><br>
</div>
<div style="position:fixed;top:30%;left:30%;width:600px;background-color:whitesmoke;height:400px;box-shadow:1px 2px 100px 40px black;z-index:99999;border-radius:10px;display:none" id="replies">
	</div>
<?php
}
?>
			</div>
			<?php
		}
		else{
			echo "<h2 style='color:red;text-align:center;'>Please Login to See Discussion<br><button class='btn btn-primary' onclick=\"load_page('login.php')\">Login</button></h2>";
		}
		?>
			<br><br><br>

<?php
}
?>

			<br><br><br>
			<br><br><br>
<script src="js/jquery.js"></script>
<script src="js/myscript.js"></script>
<script>
vid=document.getElementById("vid");
function repeat(){
	vid.loop = "true";
}
function speed(){
	vid.playbackRate = 2;
}
function speed2(){
	vid.playbackRate = 1.5;
}

function slow(){
	vid.playbackRate=0.5;
}
function normal(){
	vid.playbackRate=1;
}
</script>
<br><br>
