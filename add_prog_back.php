<?php
require('connect.php');
require('admin_check.php');

	$dept_name = $_POST['dept_name'];
	$prog_name = $_POST['prog_name'];
	$dept_name = strtolower($dept_name);
	$prog_name = strtolower($prog_name);
	
	if(!strlen($dept_name))
	{
		$prog_message="Please select the department!";
		header("location:programs.php?prog_message=" . urlencode($prog_message));
		exit();
	}
	
	if($dept_name==$prog_name)
	{
		$prog_message="Program and department name should not be same!";
		header("location:programs.php?prog_message=" . urlencode($prog_message));
		exit();
	}
	
	for($i=0; $i<strlen($prog_name); $i++)
	{
		if($prog_name[$i]<'a' || $prog_name[$i]>'z')
		{
			$prog_message="Program name is invalid!";
			header("location:programs.php?prog_message=" . urlencode($prog_message));
			exit();
		}
	}
	
	$sql = "SELECT * FROM dept WHERE dept_name='$dept_name'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	if(!$found)
	{
		$prog_message="Department does not exists!";
		header("location:programs.php?prog_message=" . urlencode($prog_message));
		exit();
	}
	
	$sql = "SELECT * FROM dept WHERE dept_name='$dept_name'";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$dept_id = $row["dept_id"];

	$sql = "SELECT * FROM prog WHERE dept_id='$dept_id' AND prog_name='$prog_name'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	

	if($found)
	{
		$prog_message="This program is already added under this department!";
		header("location:programs.php?prog_message=" . urlencode($prog_message));
		exit();
	}
	else
	{
		$sql = "INSERT INTO prog VALUES ('', '$dept_id', '$prog_name', '1')";
		$sql_query = mysqli_query($con, $sql);
		
		if($sql_query)
		{
			$sql = "SELECT * FROM prog WHERE dept_id='$dept_id' AND prog_name='$prog_name'";
			$sql_query = mysqli_query($con, $sql);
			$row = mysqli_fetch_assoc($sql_query);
			$prog_id = $row['prog_id'];
			
			$sql = "INSERT INTO syllabus VALUES ('', '$prog_id')";
			$sql_query = mysqli_query($con, $sql);
			
			$prog_message="Program is added successfully";
			header("location:programs.php?prog_message=" . urlencode($prog_message));
			exit();
		}
		else
		{
			$prog_message="Error!";
			header("location:programs.php?prog_message=" . urlencode($prog_message));
			exit();
		}
	}

?>