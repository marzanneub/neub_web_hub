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
	
	$sql = "SELECT * FROM dept_head WHERE t_id='$t_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$delete_message="You cannot delete this teacher because the teacher is head of a department!";
		header("location:teachers.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "SELECT * FROM taken_result WHERE t_id='$t_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$delete_message="You cannot delete this teacher because the teacher taken some courses!";
		header("location:teachers.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "SELECT * FROM course_advisor WHERE t_id='$t_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$delete_message="You cannot delete this teacher because the teacher is course advisor of some session!";
		header("location:teachers.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "SELECT * FROM taken WHERE t_id='$t_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$delete_message="You cannot delete this teacher because the teacher is taken some courses of some session!";
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