<title>Accounts Details</title>
<link rel="icon" href="images/video.png">
<link rel="stylesheet" href="css/bootstrap.css">
<center><button class="btn btn-info" style="color:white;margin:10px;" id="admin">Admin Accounts</button> <button class="btn btn-success" style="color:white;margin:10px;" id="user">User Accounts</button></center>
<div class="container" id="content_view">
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