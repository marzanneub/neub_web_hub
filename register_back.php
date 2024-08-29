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
require('auto_login.php');

	$prof = $_POST['prof'];
	$id = $_POST['id'];
	$dept_id = $_POST['dept_id'];
	$phone_number = $_POST['phone_number'];
	$pw1 = $_POST['pw1'];
	$pw2 = $_POST['pw2'];
	
	if($prof==0)
	{
		$message="Please select a profession!";
		header("Location: register.php?message=$message");
		exit();
	}
	
	if(strlen($pw1)<8)
	{
		$message="Password contains at least 8 characters!";
		header("Location: register.php?message=$message");
		exit();
	}
	
	if($pw1!=$pw2)
	{
		$message="Password doesn't matched!";
		header("Location: register.php?message=$message");
		exit();
	}
	
	
	if($prof=='s')
	{
		$sql = "SELECT * FROM student JOIN prog ON student.prog_id=prog.prog_id WHERE student.s_id='$id' AND student.phone_number='$phone_number' AND prog.dept_id='$dept_id'";
		$sql_query = mysqli_query($con, $sql);
		$found = mysqli_num_rows($sql_query);
		
		if(!$found)
		{
			$message="Information doesn't matched!";
			header("Location: register.php?message=$message");
			exit();
		}
		else
		{
			$rows = mysqli_fetch_assoc($sql_query);
			if($rows['registration']==1)
			{
				$message="This id is already registered!";
				header("Location: register.php?message=$message");
				exit();
			}
			
			$sql = "UPDATE student SET password = '$pw1', registration = '1' WHERE s_id = '$id'";
			$sql_query = mysqli_query($con, $sql);
			
			if($sql_query)
			{
				$message="Successfully registered";
				header("Location: login.php?message=" . urlencode($message));
				exit();
			}
			else
			{
				$message="Error!";
				header("Location: register.php?message=$message");
				exit();
			}
		}
	}
	
	if($prof=='t')
	{
		$sql = "SELECT * FROM teacher WHERE t_id='$id' AND phone_number='$phone_number' AND dept_id='$dept_id'";
		$sql_query = mysqli_query($con, $sql);
		$found = mysqli_num_rows($sql_query);
		
		if(!$found)
		{
			$message="Information doesn't matched!";
			header("Location: register.php?message=$message");
			exit();
		}
		else
		{
			$rows = mysqli_fetch_assoc($sql_query);
			if($rows['registration']==1)
			{
				$message="This id is already registered!";
				header("Location: register.php?message=$message");
				exit();
			}
			
			$sql = "UPDATE teacher SET password = '$pw1', registration = '1' WHERE t_id = '$id'";
			$sql_query = mysqli_query($con, $sql);
			
			if($sql_query)
			{
				$message="Successfully registered";
				header("Location: login.php?message=" . urlencode($message));
				exit();
			}
			else
			{
				$message="Error!";
				header("Location: register.php?message=$message");
				exit();
			}
		}
	}
?>


</body>
</html>