<?php
require('connect.php');
require('admin_check.php');

	$prog_id = $_POST['prog_id'];
	
	$sql = "SELECT * FROM student where prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	if($found)
	{
		$delete_message="You cannnot delete this program bacause some students are enrolled under this program!";
		header("location:programs.php?delete_message=" . urlencode($delete_message));
		exit();
	}
	
	$sql = "SELECT * FROM prog JOIN syllabus ON prog.prog_id=syllabus.prog_id JOIN course ON syllabus.syllabus_id=course.syllabus_id WHERE prog.prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$syllabus_id = $row['syllabus_id'];
	
	$sql = "DELETE FROM course WHERE syllabus_id='$syllabus_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM session WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM taken WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM course_advisor WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM syllabus WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM prog WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$delete_message="Successfully deleted";
		header("location:programs.php?delete_message=" . urlencode($delete_message));
		exit();
	}
	else
	{
		$delete_message="Error!";
		header("location:programs.php?delete_message=" . urlencode($delete_message));
		exit();
	}
?>