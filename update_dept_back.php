<?php
require('connect.php');
require('admin_check.php');

	$dept_id = $_POST['dept_id3'];
	$new_name = $_POST['new_name'];
	$new_name = strtolower($new_name);
	
	if(!strlen($new_name))
	{
		$update_message="Please give the department name!";
		header("location:departments.php?update_message=" . urlencode($update_message));
		exit();
	}
	
	if($dept_id==0)
	{
		$update_message="Please select a department!";
		header("location:departments.php?update_message=" . urlencode($update_message));
		exit();
	}
	
	for($i=0; $i<strlen($new_name); $i++)
	{
		if($new_name[$i]<'a' || $new_name[$i]>'z')
		{
			$update_message="Department name is invalid";
			header("location:departments.php?update_message=" . urlencode($update_message));
			exit();
		}
	}
	
	$sql = "SELECT * FROM dept WHERE dept_name='$new_name'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$update_message="This name already exists!";
		header("location:departments.php?update_message=" . urlencode($update_message));
		exit();
	}
	else
	{
		$sql = "UPDATE dept SET dept_name='$new_name' WHERE dept_id='$dept_id'";
		$sql_query = mysqli_query($con, $sql);
		$update_message="Successfully updated";
		header("location:departments.php?update_message=" . urlencode($update_message));
		exit();
	}
	
?>