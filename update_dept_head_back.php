<?php
require('connect.php');
require('admin_check.php');

	$dept_id = $_POST['dept_id2'];
	$t_id = $_POST['t_id2'];
	echo $dept_id, " ", $t_id;
	
	if($dept_id==0)
	{
		$update_head_message="Please select a department!";
		header("location:departments.php?update_head_message=" . urlencode($update_head_message));
		exit();
	}
	if($t_id==0)
	{
		$update_head_message="Please select a teacher!";
		header("location:departments.php?update_head_message=" . urlencode($update_head_message));
		exit();
	}
	
	$sql = "SELECT * FROM dept_head WHERE dept_id='$dept_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found==0 && $t_id==-1)
	{
		$update_head_message="Nothing updated!";
		header("location:departments.php?update_head_message=" . urlencode($update_head_message));
		exit();
	}
	
	$sql = "SELECT * FROM dept_head WHERE dept_id='$dept_id' AND t_id='$t_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	if($found)
	{
		$update_head_message="Nothing updated!";
		header("location:departments.php?update_head_message=" . urlencode($update_head_message));
		exit();
	}
	
	if($t_id==-1)
	{
		$sql = "DELETE FROM dept_head WHERE dept_id='$dept_id'";
		$sql_query = mysqli_query($con, $sql);
		$update_head_message="Successfully updated!";
		header("location:departments.php?update_head_message=" . urlencode($update_head_message));
		exit();
	}
	else
	{
		$sql = "DELETE FROM dept_head WHERE dept_id='$dept_id'";
		$sql_query = mysqli_query($con, $sql);
		
		$sql = "INSERT INTO dept_head VALUES ('$dept_id', '$t_id')";
		$sql_query = mysqli_query($con, $sql);
		$update_head_message="Successfully updated!";
		header("location:departments.php?update_head_message=" . urlencode($update_head_message));
		exit();
	}
?>