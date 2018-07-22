<style>
.videos3_list{
		list-style:none;
	}
	.loadmorevideos3{
		color:#FFF;
		border-radius:5px;
		width:20%;
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
		echo '<center><div style="background-color:white;width:80%;padding:10px;border-radius:10px;">
<ul class="videos3_list">
<table>';
		$keyword=mysql_real_escape_string($_GET['keyword']);
		if(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM videos where related like '%$keyword%'"))==false)
		{
		echo '<h2>Search result of <b style="color:green;font-size:15px;">'.$keyword.'</b></h2><br><h3 style="color:red">No Results Found</h3></center>';
		}
		else{
		echo '<h2>Search result of <b style="color:green;font-size:15px;">'.$keyword.'</b></h2></center>';
		$resultsPerPage=10;
		$query=mysqli_query($con,"SELECT * FROM videos where related like '%$keyword%' ORDER BY id ASC LIMIT 0, $resultsPerPage");
		while($r=mysqli_fetch_array($query))
		{
			$video=$r['video'];
					$video_code=$r['video_code'];
					$album=$r['album'];
					$time=$r['time'];
					$views=$r['views'];
					$vtime=$r['videotime'];
					$related=$r['related'];
					$id=$r['id'];
			echo '<tr><td style="padding:10px;"><a href="#" onclick="view_video(\'play.php?video='.$video_code.'\')">';
				
			echo '<img src="images/video7.png" class="iconimg" style="width:100px;height:100px;"><p style="color:magenta;margin-top:-20px;margin-left:60px;z-index:999999;">'.$vtime.'</p></p></td>
					 <td style="width:300px;overflow:hidden;text-overflow:ellipsis;"><a href="#" onclick="view_video(\'play.php?video='.$video_code.'\')">'.$related.'</a></td><td>';
				
				echo '</td><td>';
				if(isset($_SESSION['stuid']))
				{
					$stu=$_SESSION['stuid'];
					$ad=mysqli_query($con,"SELECT * FROM users where stuid='$stu' and category='admin'");
					if(mysqli_fetch_array($ad)==true)
					{
						echo '<a href="del_link.php?cat=videos&&link='.$id.'" style="margin:5px;float:right;border:1px solid red;border-radius:100px;padding:5px;width:30px;height:30px;text-align:center;">X</a>';
					}
				}
				echo '</td></tr><tr>
					<td style="padding-left:10px;">Views: '.$views.'</td></tr></li>';
				}
					?>
</table>
		<li class="loadbutton"><button class="loadmorevideos3" data-page="2">Load More</button>
			<span id="ld"></span></li>
			<?php
		}
		?>
	</ul>
</div>
</center>