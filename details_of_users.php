<title>Admins Details</title>
<link rel="icon" href="images/video.png">
<link rel="stylesheet" href="css/bootstrap.css">
<div class="container" id="content_view">
<table class="table table-hover">
<?php
session_start();
error_reporting(0);
require_once 'connect.php';
if(isset($_SESSION['stuid']))
{
	$s=$_SESSION['stuid'];
	$admin=mysqli_query($con,"SELECT * FROM users where stuid='$s' and category='admin'");
	if(mysqli_fetch_array($admin)==true)
	{
?>

	<thead><tr style="background-color:lightgreen"><th>Name</th><th>ID_Number</th><th>Branch</th><th>Year</th><th>Class</th><th>Gender</th><th>Category</th><th>Delete</th></tr></thead>
<tbody>
	<?php
$sql=mysqli_query($con,"SELECT * FROM users where category!='admin' order by id limit 100");
while($r=mysqli_fetch_array($sql))
{
	$name=$r['s_name'];
	$id=$r['stuid'];
	$branch=$r['s_branch'];
	$year=$r['s_year'];
	$class=$r['s_class'];
	$gender=$r['s_gender'];
	$cat=$r['category'];

	echo "<tr style='color:blue;'><td>".$name."</td><td>".$id."</td><td>".$branch."</td><td>".$year."</td><td>".$class."</td><td>".$gender."</td><td>".$cat."</td><td><a href='del_link.php?cat=users&&link=".$id."'><button class='btn btn-danger'>X</button></a></td></tr>";
}
echo "</tbody>";
	}
else{
echo "<div class='btn bg-danger'>You are not the admin.</div>";
}
}
else{
echo "<script>window.location='login.php';</script>";
}
?>
</table>
</div>
<script src="js/jquery.js"></script>
<script>
$(document).ready(function(){
	$("#admin").click(function(){
		$("#content_view").load("details_of_admins.php");
	});
	$("#user").click(function(){
		$("#content_view").load("details_of_users.php");
	});
});
</script>