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
	
	$sql = "SELECT * FROM enroll WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	if($found)
	{
		$delete_message="You cannot delete this student because this student enrolled some courses!";
		header("location:students.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "SELECT * FROM result WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	if($found)
	{
		$delete_message="You cannot delete this student because this student enrolled some courses!";
		header("location:students.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "SELECT * FROM course_registration WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	if($found)
	{
		$delete_message="You cannot delete this student because this student registered in this sessions!";
		header("location:students.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "SELECT * FROM c_r_status WHERE s_id='$s_id' AND status='1'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	if($found)
	{
		$delete_message="You cannot delete this student because this student registered some courses!";
		header("location:students.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "DELETE FROM given_list WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	if(!$sql_query)
	{
		$delete_message="Error";
		header("location:students.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "DELETE FROM c_r_list WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	if(!$sql_query)
	{
		$delete_message="Error";
		header("location:students.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "DELETE FROM apply_waiver WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	if(!$sql_query)
	{
		$delete_message="Error";
		header("location:students.php?delete_message=$delete_message");
		exit();
	}
	
	$sql = "DELETE FROM c_r_status WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM waiver WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	if($sql_query)
	{	
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
	}
	else
	{
		$delete_message="Error";
		header("location:students.php?delete_message=$delete_message");
		exit();
	}
	
?>