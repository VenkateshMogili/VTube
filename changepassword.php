<?php
session_start();
error_reporting(0);
require_once 'connect.php';
if(isset($_SESSION['stuid']))
{
	?>
<center><h1 style="color:magenta;font-family:georgia;"><i class="fa fa-edit my"></i>Change Password</h1></center>
<center><form action="changepassworda.php" method="post">
	<input type="password" placeholder="Old Password" name="old" class="form-control" style="width:200px;" minlength="5" autofocus required><br>
	<input type="password" placeholder="New Password" name="new" class="form-control" style="width:200px" minlength="5" required><br>
	<input type="submit" class="btn btn-success" value="Change Password">
</form>
</center>
<?php
}
else{
	echo "<script>alert('Please Login');window.location='login.php';</script>";
}
?>