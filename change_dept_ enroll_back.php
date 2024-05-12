<?php
require('connect.php');
require('admin_check.php');

	$dept_name = $_POST['dept_name'];
	
	if(!strlen($dept_name))
	{
		$change_message="Please select a department!";
		header("location:departments.php?change_message=" . urlencode($change_message));
		exit();
	}

	$sql = "SELECT * FROM dept WHERE dept_name='$dept_name'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);


	if($found)
	{
		$sql = "SELECT * FROM dept WHERE dept_name='$dept_name'";
		$sql_query = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($sql_query);
		$dept_id = $row['dept_id'];
		
		$sql = "SELECT * FROM dept WHERE dept_id='$dept_id'";
		$sql_query = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($sql_query);
		$x = $row['dept_status'];
		
		$sql = "SELECT * FROM prog WHERE dept_id='$dept_id' AND prog_status='1'";
		$sql_query = mysqli_query($con, $sql);
		$found = mysqli_num_rows($sql_query);
		if($found && $x==1)
		{
			$change_message="This department status cannot be turn off because the status of some programs under this department are on!";
			header("location:departments.php?change_message=" . urlencode($change_message));
			exit();
		}
		
		if($x==1) $x=0;
		else $x=1;
		
		$sql = "UPDATE dept SET dept_status='$x' WHERE dept_id='$dept_id'";
		$sql_query = mysqli_query($con, $sql);
		
		
		$change_message="Successfully changed";
		header("location:departments.php?change_message=" . urlencode($change_message));
		exit();
	}
	else
	{
		$change_message="Error";
		header("location:departments.php?change_message=" . urlencode($change_message));
		exit();
	}
	
?>