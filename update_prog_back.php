<?php
require('connect.php');
require('admin_check.php');

	$prog_id = $_POST['prog_id'];
	$new_name = $_POST['new_name'];
	$new_name = strtolower($new_name);
	
	$sql = "SELECT * FROM prog WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$dept_id = $row["dept_id"];
	$old_name = $row["prog_name"];
	
	$sql = "SELECT * FROM prog WHERE prog_name='$new_name'";
	$sql_query = mysqli_query($con, $sql);
	$found =mysqli_num_rows($sql_query);
	
	$sql = "SELECT * FROM dept WHERE dept_id='$dept_id'";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$dept_name = $row["dept_name"];
	
	if($new_name==$dept_name)
	{
		$update_message="Program and department name should not be same!";
		header("location:programs.php?update_message=" . urlencode($update_message));
		exit();
	}
	
	if($new_name==$old_name)
	{
		$update_message="New name and old name name should not be same!";
		header("location:programs.php?update_message=" . urlencode($update_message));
		exit();
	}
	
	if($found)
	{
		$update_message="This name already exists under this department!";
		header("location:programs.php?update_message=" . urlencode($update_message));
		exit();
	}
	
	if(!strlen($new_name))
	{
		$update_message="Name is empty!";
		header("location:programs.php?update_message=" . urlencode($update_message));
		exit();
	}
	
	for($i=0; $i<strlen($new_name); $i++)
	{
		if($new_name[$i]<'a' || $new_name[$i]>'z')
		{
			$update_message="Program name is invalid";
			header("location:programs.php?update_message=" . urlencode($update_message));
			exit();
		}
	}
	
	$sql = "SELECT * FROM prog WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	$row = mysqli_fetch_assoc($sql_query);
	
	if($new_name==$row['prog_name'])
	{
		$update_message="New name and old name are same";
		header("location:programs.php?update_message=" . urlencode($update_message));
		exit();
	}
	else
	{
		$sql = "UPDATE prog SET prog_name='$new_name' WHERE prog_id='$prog_id'";
		$sql_query = mysqli_query($con, $sql);
		
		if($sql_query)
		{
			$update_message="Successfully updated";
			header("location:programs.php?update_message=" . urlencode($update_message));
			exit();
		}
		else
		{
			$update_message="Error";
			header("location:programs.php?update_message=" . urlencode($update_message));
			exit();
		}
	}
?>