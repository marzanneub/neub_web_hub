<?php
require('connect.php');
	
	$sql = "SELECT * FROM admin WHERE login='1'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$row = mysqli_fetch_assoc($sql_query);
		$admin_id = $row['admin_id'];
		
		$message = "Please login to access this page";
		header("Location: admin_landing.php?admin_id=" . urlencode($admin_id));
		exit();
	}
	
	$sql = "SELECT * FROM student WHERE login='1'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$row = mysqli_fetch_assoc($sql_query);
		$s_id = $row['s_id'];
		
		$message = "Please login to access this page";
		header("Location: student_landing.php?s_id=" . urlencode($s_id));
		exit();
	}
	
	$sql = "SELECT * FROM teacher WHERE login='1'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$row = mysqli_fetch_assoc($sql_query);
		$t_id = $row['t_id'];
		
		$message = "Please login to access this page";
		header("Location: teacher_landing.php?t_id=" . urlencode($t_id));
		exit();
	}
?>
