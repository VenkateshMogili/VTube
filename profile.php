<?php
session_start();
require_once("connect.php");
if(isset($_SESSION['stuid'])){
	$stuid=$_SESSION['stuid'];
?>
				<form enctype="multipart/form-data" method="post" action="profiles.php" class="role">
					 <center><i style="color:white">Choose your image*</i><input type="file" name="File" id="File" class="form-control" style="width:50%;" required minlength="1"></center>
				
					<center><br><br><input type="submit" value="Update Profile Picture" name="submit"  class="btn btn-success"></center>
					</form>
	 <?php
 }
 else{
 echo "<h1>Please login</h1>";
 }
 ?>

