<?php
require('connect.php');
require('admin_check.php');

	$dept_name = $_POST['dept_name'];
	
	if(!strlen($dept_name))
	{
		$delete_message="Please select a department!";
		header("location:departments.php?delete_message=" . urlencode($delete_message));
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
		
		$sql = "SELECT * FROM prog WHERE dept_id='$dept_id'";
		$sql_query = mysqli_query($con, $sql);
		$found = mysqli_num_rows($sql_query);
		if($found)
		{
			$delete_message="This department cannot be deleted because some programs are under this department!";
			header("location:departments.php?delete_message=" . urlencode($delete_message));
			exit();
		}
		
		$sql = "DELETE FROM dept_head WHERE dept_id='$dept_id'";
		$sql_query = mysqli_query($con, $sql);
		
		$sql = "DELETE FROM dept WHERE dept_id='$dept_id'";
		$sql_query = mysqli_query($con, $sql);
		
		
		$delete_message="Successfully deleted";
		header("location:departments.php?delete_message=" . urlencode($delete_message));
		exit();
	}
	else
	{
		$delete_message="Error";
		header("location:departments.php?delete_message=" . urlencode($delete_message));
		exit();
	}
	
?>