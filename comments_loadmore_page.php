<table>
<?php
session_start();
error_reporting(0);
require_once 'connect.php';
$video_id=mysql_real_escape_string($_GET['video']);
if(isset($_POST['page'])):
	$resultsPerPage=30;
	$paged=$_POST['page'];
$sql="SELECT * FROM comments where related_video_id='$video_id' ORDER BY id ASC";
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
		$id=$r['id'];
			$user=$r['user'];
			$name=$r['name'];
			$comment=$r['comment'];
			$reply=$r['reply'];
			$time=$r['time'];
			$related_video_id=$r['related_video_id'];
		echo '<li style="list-style:none">';
		echo '
			<div style="border:1px solid lightgray;padding:5px;"><img src="images/profile.png" style="border:2px solid white;width:50px;height:50px;border-radius:100px;"> <b style="color:#3399cc">'.$name.'</b><i style="float:right"><i class="fa fa-clock-o"></i> '.$time.'</i><br>
			<p style="text-indent:100px;text-align:justify">'.$comment.'</p>';
			if(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM comments where reply!='' and id='$id'")))
			{
				echo '<b style="color:blue;margin:50px;">Reply: </b><br><p style="text-indent:100px;color:green;text-align:justify">'.$reply.'</p>';
			}
			if(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users where stuid='$student' and category='admin'"))==true && mysqli_fetch_array(mysqli_query($con,"SELECT * FROM comments where reply='' and id='$id'")))
			{
			echo '<p align="right"><b onclick="give_reply(\'give_reply.php?video_ii='.$id.'\')" style="color:#3399cc;cursor:pointer;">Reply</b></p>';
		}

			echo '</div></li>';
				}
				?>
	<?php
	}
	?>
<?php
if($num_rows==$resultsPerPage){?>
<li class="loadbutton"><button class="loadmorecomments" data-page=<?php echo $paged+1;?>>Load More</button></li>
<?php
}
endif;
?>