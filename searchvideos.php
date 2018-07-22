<table style="box-shadow:1px 2px 3px lightgray;width:100%;">
	<br><br><br><br><br><br>Results
<?php
session_start();
error_reporting(0);
require_once 'connect.php';
if(isset($_POST['pages'])):
	$paged=$_POST['pages'];
$keyword=mysql_real_escape_string(htmlentities(htmlspecialchars_decode($_GET['v'])));
echo $keyword;
$sql=mysqli_query($con,"SELECT * FROM videos");
while($r=mysqli_fetch_array($sql))
{
	$video=$r['video'];
					$video_code=$r['video_code'];
					$album=$r['album'];
					$time=$r['time'];
					$views=$r['views'];
					$vtime=$r['videotime'];
					$id=$r['id'];
				echo '<li><tr><td style="padding:10px;"><a href="#" onclick="view_video(\'play.php?video='.$video_code.'\')">';
				
			echo '<img src="images/video7.png" style="width:100px;height:100px;" class="iconimg"><p style="color:magenta;margin-top:-20px;margin-left:60px;z-index:999999;">'.$vtime.'</p></p></td>
					 <td style="width:300px;overflow:hidden;text-overflow:ellipsis;"><a href="#" onclick="view_video(\'play.php?video='.$video_code.'\')">'.$video.'</a></td><td>';
				
				echo '</td><td>';
				if(isset($_SESSION['stuid']))
				{
					$stu=$_SESSION['stuid'];
					$ad=mysqli_query($con,"SELECT * FROM students where stuid='$stu' and category='admin'");
					if(mysqli_fetch_array($ad)==true)
					{
						echo '<a href="del_link.php?cat=videos&&link='.$id.'" style="margin:5px;float:right;border:1px solid red;border-radius:100px;padding:5px;width:30px;height:30px;text-align:center;">X</a>';
					}
				}
				echo '</td></tr><tr>
					<td style="padding-left:10px;">Views: '.$views.'</td></tr></li>';
				}
?>
<?php
endif;
?>
</table>