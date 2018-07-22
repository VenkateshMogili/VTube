<link rel="stylesheet" href="css/bootstrap.css">
<?php
session_start();
error_reporting(0);
require_once 'connect.php';
	?>
<center><h1 style="color:white">Forgot Password</h1></center>
<center><form action="forgetp.php" method="post">
	<input type="text" placeholder="ID No: N130010" name="user" class="form-control" style="width:50%;" required><br>
	
	<select name="question" class="form-control" required style="width:50%;">
		<option value="">Select security question</option>
							<option value="What is your tenth Hallticket number?">What is your tenth Hallticket number?</option>
							<option value="Who is your first teacher?">Who is your first teacher?</option>
							<option value="What is your pet name?">What is your pet name?</option>
							<option value="Who is your best friend?">Who is your best friend?</option>
							<option value="What primary school did you attend?">What primary school did you attend?</option>
						</select>
	<input type="password" placeholder="Security Answer" name="answer" class="form-control" style="width:50%;" required><br>
	<input type="password" placeholder="New Password" name="new" class="form-control" style="width:50%;" required><br>
	
	<input type="submit" class="btn btn-success" value="Forget Password">
</form>
</center>
<style>
body{background:url('images/2.jpg');background-size:100% 100%;background-attachment:fixed;}
</style>