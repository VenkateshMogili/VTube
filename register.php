<?php
session_start();
error_reporting(0);
require_once 'connect.php';
?>
<!DOCTYPE html>
<body>
	<center><i class="fa fa-user-plus mine"></i><br><h3 style="color:#3399cc;font-family:lucida sans;">Registration Area</h3></center>
	<form action="check_register.php" method="post">
	<center>
	<input type="text" placeholder="UserId: Ex:N130010" name="stuid" id="userid" minlength="7" autofocus required><br>
	<input type="text" placeholder="UserName: Ex:Venkatesh Mogili" name="username" id="pass" minlength="5" required><br>
	<input type="password" placeholder="Password: ******" name="password" id="pass" minlength="5" required><br>
	<button id="log" name="register">Register</button>
</form>
</center>
<div style="position:fixed;bottom:0%;left:0%;width:100%;background-color:teal;padding:10px;">
	<center><b style="color:white;font-family:lucida sans;">&copy;Developer Names</b></center>
	</div>
</body>
<style>
i.mine{font-size:6em;color:white;width:150px;height:150px;text-align:center;transition:1s;background-color:#3399cc;padding:20px;border:4px solid #171790;border-radius:150px;}
i.mine:hover{transition:1s;border:4px solid #3399cc;background-color:#171790;color:orange;}
#userid,#pass{padding:10px;border-radius:5px;transition:0.8s;color:#3399cc;margin:10px;border:2px solid #3399cc;font-family:lucida sans;}
#userid:hover,#pass:hover{border:2px solid white;transition:1s;}
#userid:focus,#pass:focus{transition:1s;border:2px solid white;}
#log{padding:10px;width:100px;margin:10px;border:0px;border-radius:100px;transition:1s;color:white;border:2px solid white;background-color:#3399cc;font-family:georgia;}
#log:hover{background-color:white;color:#3399cc;transition:1s;cursor:pointer;border:2px solid #3399cc;}
</style>