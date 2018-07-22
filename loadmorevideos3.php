<table>
<?php
session_start();
error_reporting(0);
require_once 'connect.php';
$keyword=mysql_real_escape_string($_GET['keyword']);
if(isset($_POST['page'])):
	$resultsPerPage=10;
	$paged=$_POST['page'];
$sql="SELECT * FROM videos where related like '%$keyword%' ORDER BY id ASC";
if($paged>0){
	$page_limit=$resultsPerPage*($paged-1);
	$pagination_sql=" LIMIT $page_limit, $resultsPerPage";
}
else{
	$pagination_sql=" LIMIT 0, $resultsPerPage";
}
$result=mysqli_query($con,$sql.$pagination_sql);
$num_rows=mysqli_num_rows($result);
if($num_rows>0)
{
	while($r=mysqli_fetch_array($result))
	{
		$video=$r['video'];
		$video_code=$r['video_code'];
		$album=$r['album'];
		$time=$r['time'];
		$views=$r['views'];
		$vtime=$r['videotime'];
		$id=$r['id'];
		$cat=$r['category'];
		echo '<li>';
		echo '<tr><td style="padding:10px;"><a href="#" onclick="view_video(\'play.php?video='.$video_code.'\')">';
		echo '<img src="images/video7.png" style="width:100px;height:100px;" class="iconimg">';
			echo '<p style="color:magenta;margin-top:-20px;margin-left:60px;z-index:999999;">'.$vtime.'</p></p></td>
					 <td style="width:300px;overflow:hidden;text-overflow:ellipsis;"><a href="#" onclick="view_video(\'play.php?video='.$video_code.'\')">'.$video.'</a></td><td>';
				
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
	}
	?>
</table>
<?php
if($num_rows==$resultsPerPage){?>
<li class="loadbutton"><button class="loadmorevideos3" data-page=<?php echo $paged+1;?>>Load More</button></li>
<?php
}
endif;
?>