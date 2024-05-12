<?php
require('connect.php');
require('admin_check.php');

	$old_name = $_POST['old_name'];
	$new_name = $_POST['new_name'];
	$new_name = strtolower($new_name);
	
	if(!strlen($new_name))
	{
		$update_message="Please select a department";
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
	
	if($new_name==$old_name)
	{
		$update_message="New name and old name are same";
		header("location:departments.php?update_message=" . urlencode($update_message));
		exit();
	}

	$sql = "SELECT * FROM dept WHERE dept_name='$old_name'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);


	if($found)
	{
		$sql = "UPDATE dept SET dept_name='$new_name' WHERE dept_name='$old_name'";
		$sql_query = mysqli_query($con, $sql);
		$update_message="Successfully updated";
		header("location:departments.php?update_message=" . urlencode($update_message));
		exit();
	}
	else
	{
		$update_message="Old department name does not exists";
		header("location:departments.php?update_message=" . urlencode($update_message));
		exit();
	}
	
?>