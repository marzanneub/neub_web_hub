<?php
require('connect.php');
require('admin_check.php');

	$prog_id = $_POST['prog_id'];
	$course_id = $_POST['course_id'];

	$sql = "SELECT * FROM course WHERE course_id='$course_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if(!$found)
	{
		$delete_message="Please select a course id!";
		header("location:show_program.php?delete_message=$delete_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "SELECT * FROM course WHERE prerequisite='$course_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$delete_message="You cannot delete this course because it is the prerequisite of some another courses!";
		header("location:show_program.php?delete_message=$delete_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "SELECT * FROM course_on_c_o_l WHERE course_id='$course_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$delete_message="You cannot delete this course because it was offered in some sessions!";
		header("location:show_program.php?delete_message=$delete_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "SELECT * FROM result WHERE course_id='$course_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$delete_message="You cannot delete this course because it was offered in some sessions!";
		header("location:show_program.php?delete_message=$delete_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "SELECT * FROM c_r_list WHERE course_id='$course_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$delete_message="You cannot delete this course because it was offered in some sessions!";
		header("location:show_program.php?delete_message=$delete_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "SELECT * FROM tooken_course WHERE course_id='$course_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$delete_message="You cannot delete this course because it was offered in some sessions!";
		header("location:show_program.php?delete_message=$delete_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "SELECT * FROM enroll WHERE course_id='$course_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$delete_message="You cannot delete this course because some student are enrolled in this course!";
		header("location:show_program.php?delete_message=$delete_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "DELETE FROM course WHERE course_id='$course_id'";
	$sql_query = mysqli_query($con, $sql);
	if($sql_query)
	{	
		$delete_message="Successfully deleted";
		header("location:show_program.php?delete_message=$delete_message&prog_id=$prog_id");
		exit();
	}
	else
	{
		$delete_message="Error";
		header("location:show_program.php?delete_message=$delete_message&prog_id=$prog_id");
		exit();
	}
	
?>