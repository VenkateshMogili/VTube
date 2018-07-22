<?php
session_start();
error_reporting(0);
require_once 'connect.php';
$today=date('Y-m-d');
$category=mysql_real_escape_string(htmlentities(htmlspecialchars_decode($_GET['v'])));
echo "<input value='".$category."' id='vgetlink' style='display:none'>";
if($category=="")
{
	header("Location:404.php");
}
else{
	$category=$category;
}
$total=mysqli_num_rows(mysqli_query($con,"SELECT * FROM videos where category='$category'"));
if($total!=true)
{
	header("Location:404.php");
}
?>
<!DOCTYPE html>
<html>
<title>Video Player</title>
<link rel="icon" href="images/logo.jpg">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/vfont/css/font-awesome.min.css">
<style>
a:hover{text-decoration:none;transition:0.5s;color:green;text-shadow:1px 2px 3px lime;}
img{transition:1s;border-radius:10px;}
img:hover{border-radius:100px;transition:0.5s;}
.videos_list2{
		list-style:none;
	}
	.loadmorevideos2{
		color:#FFF;
		border-radius:5px;
		width:50%;
		border:0px;
		height:40px;font-size:18px;background:#42B8DD;
		outline:0;
	}
	.loadbutton2{
		text-align:center;
		list-style: none;
	}
.iconimg:hover{background-color:lightgray;padding:20px;-webkit-transform:rotate(360deg);}
.iconimg{transition:1s;}
</style>
<body style="background-color:whitesmoke">
<div class="col-md-12" id="vcontent" style="overflow:auto">
	<nav class="navbar navbar-inverse" style="border-radius:0px;background-color:white;border:0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#" style="color:white;font-family:georgia;"><i class="fa fa-bars my" style="cursor:pointer;color:black" id="vmenu"></i><b style="text-shadow:1px 2px 5px lightgray;font-size:17px;color:#3399cc;border-radius:100px;font-family:lucida sans"> Video<b style="padding:5px;background-color:black;color:white;margin:1px;border-radius:10px;">Player</b></b></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><input type="text" class="form-control" id="keyword" placeholder="Search" style="border-radius:0px;width:600px;margin:15px;"></li>
        <li><a href="#"><button class="btn btn-default" id="search" style="border-radius:100px;width:35px;text-align:center;height:35px;border:0px;background-color:black;color:white;" placeholder="Search" value="Search"><center><i class='fa fa-search my'></i></center></button></a></li>
    </ul>

      <ul class="nav navbar-nav navbar-right">
      	<?php
        if(isset($_SESSION['stuid']))
        {
          $stu=$_SESSION['stuid'];
        if(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users where stuid='$stu' and category='admin'")))
        {
          ?>
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><button class="btn btn-default">Admin
          <span class="caret"></span></button></a>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="load_page('Adminv.php')">Upload Video</a></li>
            <li><a href="logout.php">Logout</a></li> 
          </ul>
        </li>
        <?php
        }
        else{
          ?>
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><button class="btn btn-default"><?php echo $stu;?></button>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php">Logout</a></li> 
          </ul>
        </li>
          <?php
        }
      }
        else{
          ?>
        <li><a href="#" onclick="load_page('login.php');"><button class="btn btn-primary"><span class="fa fa-unlock"></span> Login</button></a></li>
          <?php
        }
        ?>
      </ul>
</div>
</div>
</nav>	<div class="col-md-3" style="display:none;border:0px;margin:1.5px;height:556px;position:fixed;left:1%;top:9%;z-index:99999;background-color:white;" id="vmenuvb">
	<h4>Categories</h4>
	<ul class="list-group">
	<a href="etube.php"><li class="list-group-item"><i class="fa fa-home my"></i> Home</li></a>
	<a href="list_etube.php?v=CSE"><li class="list-group-item"><i class="fa fa-user my"></i> CSE</li></a>
	<a href="list_etube.php?v=ECE"><li class="list-group-item"><i class="fa fa-globe my"></i> ECE</li></a>
	<a href="list_etube.php?v=Mechanical"><li class="list-group-item"><i class="fa fa-comments my"></i> Mechanical</li></a>
	<a href="list_etube.php?v=Civil"><li class="list-group-item"><i class="fa fa-user-plus my"></i> Civil</li></a>
	<a href="list_etube.php?v=Chemical"><li class="list-group-item"><i class="fa fa-book my"></i> Chemical</li></a>
	<a href="list_etube.php?v=MME"><li class="list-group-item"><i class="fa fa-pencil my"></i> MME</li></a>
	</ul>
	</div>
		<div class="col-md-12" id="searchresult" style="height:100%;display:none">
	</div>
	<div id="maincontent">
	<div class="col-md-8" id='vidd'>
	<?php
    $sql=mysqli_query($con,"SELECT * FROM videos where category='$category' order by views ASC");
    while($dat=mysqli_fetch_array($sql))
    {
      $video=$dat['video'];
    }
 echo '<video src="Videos/'.$video.'" poster="'.$video.'" controls style="height:480px;width:100%;border-top:3px solid red;background-color:black;padding:10px;" id="vid">';
 ?>
	<div class="col-md-12" style="background-color:white;box-shadow:1px 2px 3px lightgray;">
		<h2>Discussion</h2>
	</div>
		</div>
	<div class="col-md-4" id='viddm' style="background-color:white;">
		<center><h3><?php echo $category." <button style='color:#3399cc;border:0px;width:40px;height:40px;border-radius:100px;'>".$total."</button>";?></h3></center>
			<ul class="videos_list2">
			<table>
				<?php
		$resultsPerPage=10;
		$sql=mysqli_query($con,"SELECT * FROM videos where category='$category' ORDER BY id ASC LIMIT 0, $resultsPerPage");
				if(mysqli_fetch_array($sql)!=true)
				{
					echo "<center><h3 style='color:red'>No Files Found</h3></center>";
				}
				else{
		$resultsPerPage=10;
		$sql=mysqli_query($con,"SELECT * FROM videos where category='$category' ORDER BY id ASC LIMIT 0, $resultsPerPage");
				while($r=mysqli_fetch_array($sql))
				{
					$video=$r['video'];
					$video_code=$r['video_code'];
					$album=$r['album'];
					$time=$r['time'];
					$views=$r['views'];
					$vtime=$r['videotime'];
					$id=$r['id'];
					$cat=$r['category'];
					$related=$r['related'];
					echo '<li>';
				echo '<tr><td style="padding:10px;"><a href="#" onclick="view_video(\'play.php?video='.$video_code.'\')">';
				
				if($cat=="CSE")
				{
		echo '<img src="images/video.png" style="width:100px;height:100px;" class="iconimg">';
	}
	else if($cat=="ECE")
	{
		echo '<img src="images/video2.png" style="width:100px;height:100px;" class="iconimg">';
	}
	else if($cat=="Mechanical")
	{
		echo '<img src="images/video3.png" style="width:100px;height:100px;" class="iconimg">';
	}
	else if($cat=="Civil")
	{
		echo '<img src="images/video4.png" style="width:100px;height:100px;" class="iconimg">';
	}
	else if($cat=="Chemical")
	{
		echo '<img src="images/video5.png" style="width:100px;height:100px;" class="iconimg">';
	}
	else if($cat=="MME")
	{
		echo '<img src="images/video6.png" style="width:100px;height:100px;" class="iconimg">';
	}
	else{
		echo '<img src="images/video8.png" style="width:100px;height:100px;" class="iconimg">';
	}
				echo '</p></td>
					 <td style="width:300px;overflow:hidden;text-overflow:ellipsis;"><a href="#" onclick="view_video(\'play.php?video='.$video_code.'\')">'.$related.'';
					 if($today==$time)
					 	{
					 		echo "<img src='images/new.gif'>";
					 	}
					 	echo '</a></td><td>';
					 $seen=mysqli_query($con,"SELECT * FROM videovisitors where video='$video'");
					if(mysqli_fetch_array($seen)==true)
					{
						echo "<i class='fa fa-check'></i>";
					}
					else{
						echo "<i class='fa fa-hand-o-right'></i>";
					}
					 if(isset($_SESSION['stuid']))
			{
		$stu=$_SESSION['stuid'];
				$ad=mysqli_query($con,"SELECT * FROM users where stuid='$stu' and category='admin'");
			if(mysqli_fetch_array($ad)==true)
			{
				echo '<a href="del_link.php?cat=videos&&link='.$id.'" style="margin:5px;float:right;border:1px solid red;border-radius:100px;padding:5px;width:30px;height:30px;text-align:center;">X</a>';
			}
		}echo '</td></tr><tr>
					<td style="padding-left:10px;">Views: '.$views.'</td></tr></li>';
				}
			}
				?>
			</table>
		</ul>
		<li class="loadbutton2"><button class="loadmorevideos2" data-pages="2">Load More</button></li><br>
	</div>
</div>
</div>
<div style="position:fixed;bottom:0px;left:0px;width:100%;height:20px;background-color:black;color:white">
	<center><b style="margin:50px;">&copy;Developer Name</b></center>
	</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/myscript.js"></script>
