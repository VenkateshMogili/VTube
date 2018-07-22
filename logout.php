<?php
session_start();
error_reporting(0);
require_once("connect.php");
if (isset($_SESSION['stuid']))
{
$stuid=$_SESSION['stuid'];
$ip=$_SERVER['REMOTE_ADDR'];
session_unset("stuid");
session_destroy();
header("location:index.php");
}
else{
	header('Location: index.php');
}
?>
