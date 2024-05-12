<?php
require('connect.php');
require('admin_check.php');

	$prog_id = $_POST['prog_id'];
	$course_id = $_POST['course_id'];
	$new_code = $_POST['new_code'];
	$new_title = $_POST['new_title'];
	$new_credit = $_POST['new_credit'];
	$prerequisite = $_POST['prerequisite'];
	$new_code = strtolower($new_code);
	$new_title = strtolower($new_title);
	$x = 0;
	
	$sql = "SELECT * FROM course WHERE course_id='$course_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if(!$found)
	{
		$update_message="Please select a course id!";
		header("location:show_program.php?update_message=$update_message&prog_id=$prog_id");
		exit();
	}
	
	if($course_id==$prerequisite)
	{
		$update_message="Course and its prerequisite will not be same!";
		header("location:show_program.php?update_message=$update_message&prog_id=$prog_id");
		exit();
	}
	
	if(strlen($new_code))
	{
		$sql = "UPDATE course SET course_code='$new_code' WHERE course_id='$course_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($new_title))
	{
		$sql = "UPDATE course SET course_title='$new_title' WHERE course_id='$course_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($new_credit))
	{
		$sql = "UPDATE course SET credit='$new_credit' WHERE course_id='$course_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if($prerequisite)
	{
		$sql = "UPDATE course SET prerequisite='$prerequisite' WHERE course_id='$course_id'";
		if($prerequisite<0) $sql = "UPDATE course SET prerequisite=NULL WHERE course_id='$course_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if($x) $update_message="Successfully updated";
	else $update_message="Nothing updated";
	header("location:show_program.php?update_message=$update_message&prog_id=$prog_id");
	exit();
?>