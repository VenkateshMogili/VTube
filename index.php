<?php
session_start();
error_reporting(0);
require_once 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Digital Learning</title>
  <link rel="icon" href="images/video3.png">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/vfont/css/font-awesome.min.css">
  <style>
  @font-face{
    font-family:vivek;
    src:url('css/Sansation-Regular.ttf');
  }
  #updates a{color:#C71585;transition:1s;}
  #updates a:hover{text-shadow:1px 2px 3px white;text-decoration: none;color:white;transition:0.8s;}
  .iconimg:hover{border-radius:100px;}
  </style>
  </head>
<body style="background-image:url('images/icon.jpg');background-size:100% 150%;background-attachment:fixed">
<nav class="navbar navbar-inverse" style="border-radius:0px;background-color:whitesmoke;border:0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar" style="background-color:#3399cc"></span>
        <span class="icon-bar" style="background-color:#3cc74e"></span>
        <span class="icon-bar" style="background-color:#3399cc"></span> 
      </button>
      <a class="navbar-brand" href="#" style="font-family:georgia;font-size:30px;"><font face="vivek" color="#3cc74e"><img src="images/video3.png" style="width:35px;height:35px;">Digital</font><font face="vivek" color="#3399cc">Learning</font></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style="border:0px;">
      <ul class="nav navbar-nav">
        <li><a href=""><button class="btn btn-default" title="Homepage"><i class="fa fa-home"></i></button></a></li>
        <li><a href="etube.php" target="_blank" title="Video Player"><button class="btn btn-default"><img src="images/video.png" style="width:16px;height:16px;"></button></a></li>
        <li><a href="#"><input type="text" placeholder="Search a keyword" class="form-control" style="width:300px;" id="keyword"></a></li>
        <li><a href="#"><button class="btn btn-info" id="search2">Search</button></a></li>
        
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
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><button class="btn btn-warning">Admin
          <span class="caret"></span></button></a>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="load_page('register_admin.php')">Create Admins</a></li>
            <li><a href="#" onclick="load_page('user_details.php')">Users Details</a></li>
            <li><a href="#" onclick="load_page('viewprofile.php')">View Profile</a></li>
            <li><a href="#" onclick="load_page('editprofile.php')">Edit Profile</a></li>
            <li><a href="#" onclick="load_page('changepassword.php')">Change Password</a></li>
            <li><a href="#" onclick="load_page('Adminv.php')">Upload Video</a></li>
            <li><a href="logout.php">Logout</a></li> 
          </ul>
        </li>
        <?php
        }
        else{
          ?>
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><button class="btn btn-primary"><?php echo $stu;?></button>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="load_page('viewprofile.php')">View Profile</a></li>
            <li><a href="#" onclick="load_page('editprofile.php')">Edit Profile</a></li>
            <li><a href="#" onclick="load_page('changepassword.php')">Change Password</a></li>
            <li><a href="logout.php">Logout</a></li> 
          </ul>
        </li>
          <?php
        }
      }
        else{
          ?>
        <li><a href="#" onclick="load_page('register.php');"><button class="btn btn-primary"><span class="fa fa-user"></span> Register</button></a></li>
        <li><a href="#" onclick="load_page('forget.php');"><button class="btn btn-primary"><span class="fa fa-key"></span> Forgot Password</button></a></li>
        <li><a href="#" onclick="load_page('login.php');"><button class="btn btn-primary"><span class="fa fa-unlock"></span> Login</button></a></li>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
<!--Body-->
<div class="col-md-12" id="vcontent">
</div>
<div class="col-md12" id="vcontent2">
  <div id="searchresult" class="col-md-12">
  </div>
  <div class="col-md-12" id="maincontent">
  <div class="col-md-8" id="vidd">
    <?php
    $sql=mysqli_query($con,"SELECT * FROM videos order by views ASC");
    while($dat=mysqli_fetch_array($sql))
    {
      $video=$dat['video'];
    }
 echo '<video src="Videos/'.$video.'" poster="'.$video.'" controls style="height:500px;width:100%;border-top:3px solid red;background-color:black;padding:10px;" id="vid">';
 ?>
</div>
<div class="col-md-1">
  </div>
<div class="col-md-3" style="box-shadow:1px 2px 3px lightgray;height:500px;overflow:auto;border:2px solid white;">
  <center><h3 style="border-bottom:3px solid orange;color:white;">Recent Updates</h3></center>
  <div style="height:430px;overflow:auto;">
    <ul class="list-group" style="background-color:transparent;">
      <?php
      $sql=mysqli_query($con,"SELECT * FROM videos ORDER BY id DESC LIMIT 8");
      while($r=mysqli_fetch_array($sql))
      {
        $video=$r['video'];
          $video_code=$r['video_code'];
          $album=$r['album'];
          $time=$r['time'];
          $views=$r['views'];
          $vtime=$r['videotime'];
          $related=$r['related'];
          $id=$r['id'];
      printf('<li class="list-group-item" id="updates" style="font-family:lucida sans;color:#C71585;background-color:transparent">
      <i class="fa fa-send my"></i> <a href="#" onclick="view_main_video(\'play.php?video='.$video_code.'\')">'.$related.'');
      if($dates==$today)
      {
        echo '<img src="images/new.gif">';
        }
      echo '</a> ';
      $ad=mysqli_query($con,"SELECT * FROM students where stuid='$stu' and category='admin'");
      if(mysqli_fetch_array($ad)==true)
      {
        echo '<span class="badge" style="color:red;text-shadow:none;border:1px solid black;background-color:#FF8C00;"><a href="del_link.php?cat=notices&&link='.$id.'">X</a></span>';
      }
      echo '<span class="badge" style="color:#3399cc;border:1px solid #3cc74e;background-color:white">'.$views.'</span>
      </li>';
      
      }
      echo '<center><br><a href="etube.php" target="_blank"><button class="btn btn-info">More Videos >> </button></a></center>';
      ?>
    </ul>
    </div>
</div>
</div>
</div>
<div style="position:fixed;bottom:0%;left:0%;width:100%;background-color:lightgray;padding:10px;">
  <center><b style="color:blue;font-family:lucida sans;">&copy;Developer Names</b></center>
  </div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/myscript.js"></script>