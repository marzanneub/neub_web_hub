<?php
require('connect.php');
require('admin_check.php');

	$s_id = $_POST['s_id'];

	$sql = "SELECT * FROM student WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if(!$found)
	{
		$delete_message="Please select a student!";
		header("location:students.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "DELETE FROM student WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	if($sql_query)
	{	
		$delete_message="Successfully deleted";
		header("location:students.php?delete_message=$delete_message");
		exit();
	}
	else
	{
		$delete_message="Error";
		header("location:students.php?delete_message=$delete_message");
		exit();
	}
	
?>