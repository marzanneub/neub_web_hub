<?php
require('connect.php');
require('admin_check.php');

	$t_id = $_POST['t_id'];

	$sql = "SELECT * FROM teacher WHERE t_id='$t_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if(!$found)
	{
		$delete_message="Please select a teacher!";
		header("location:teachers.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "DELETE FROM teacher WHERE t_id='$t_id'";
	$sql_query = mysqli_query($con, $sql);
	if($sql_query)
	{	
		$delete_message="Successfully deleted";
		header("location:teachers.php?delete_message=$delete_message");
		exit();
	}
	else
	{
		$delete_message="Error";
		header("location:teachers.php?delete_message=$delete_message");
		exit();
	}
	
?>