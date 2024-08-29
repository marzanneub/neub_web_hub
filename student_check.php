<?php
require('connect.php');
	
	$sql = "SELECT * FROM student WHERE login='1'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if(!$found)
	{
		$message="Please login to access this page";
		header("Location: login.php?message=" . urlencode($message));
		exit();
	}
	
	
	$row = mysqli_fetch_assoc($sql_query);
	$x = $row['approve'];
	$s_id = $row['s_id'];
	$prog_id = $row['prog_id'];
	$session_id = $row['session_id'];
		
	if($x==0)
	{
		$message="Admin still not approved your account!";
		header("Location: login.php?message=" . urlencode($message));
		exit();
	}
?>