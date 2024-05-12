<?php
require('connect.php');
	
	$sql = "SELECT * FROM admin WHERE login='1'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if(!$found)
	{
		$message="Please login to access this page";
		header("Location: login.php?message=" . urlencode($message));
		exit();
	}
?>