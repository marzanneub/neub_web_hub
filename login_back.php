<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="login-style.css">
</head>
<body>

<?php
require('connect.php');

	$id = $_POST['id'];
	$pw = $_POST['pw'];
	
	
	$sql = "SELECT * FROM admin WHERE admin_id='$id' AND password='$pw' ";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
		
	if($found)
	{
		$sql = "UPDATE admin SET login='1' WHERE admin_id='$id'";
		$sql_query = mysqli_query($con, $sql);
		
		header("location:admin_landing.php?admin_id="  . urlencode($id));
		exit();
	}
	
	$sql = "SELECT * FROM student WHERE s_id='$id' AND password='$pw' ";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$row = mysqli_fetch_assoc($sql_query);
		$x = $row['approve'];
		
		if($x==0)
		{
			$message="Admin still not approved your account!";
			header("Location: login.php?message=" . urlencode($message));
			exit();
		}
		
		
		$sql = "UPDATE student SET login='1' WHERE s_id='$id'";
		$sql_query = mysqli_query($con, $sql);
		
		header("location:student_landing.php?s_id="  . urlencode($id));
		exit();
	}
	
	$sql = "SELECT * FROM teacher WHERE t_id='$id' AND password='$pw' ";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
		
	if($found)
	{
		$row = mysqli_fetch_assoc($sql_query);
		$x = $row['approve'];
		
		if($x==0)
		{
			$message="Admin still not approved your account!";
			header("Location: login.php?message=" . urlencode($message));
			exit();
		}
		
		$sql = "UPDATE teacher SET login='1' WHERE t_id='$id'";
		$sql_query = mysqli_query($con, $sql);
		
		header("location:teacher_landing.php?t_id="  . urlencode($id));
		exit();
	}
	
	$message="Incorrect user id or password";
	header("Location: login.php?message=" . urlencode($message));
	exit();
	
?>


</body>
</html>