<?php
require('connect.php');
require('admin_check.php');

	$prog_id = $_POST['prog_id'];
	$syllabus_id = $_POST['syllabus_id'];
	$course_code = $_POST['course_code'];
	$course_title = $_POST['course_title'];
	$credit = $_POST['credit'];
	$prerequisite = $_POST['prerequisite'];
	$course_code = strtolower($course_code);
	$course_title = strtolower($course_title);
	
	if($prerequisite==0)
	{
		$course_message="Prerequsite does not selected!";
		header("location:show_program.php?course_message=$course_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "SELECT * FROM course WHERE course_code='$course_code'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	if($found)
	{
		$course_message="This code is already exists";
		header("location:show_program.php?course_message=$course_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "SELECT * FROM course WHERE course_title='$course_title'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	if($found)
	{
		$course_message="This course is already added";
		header("location:show_program.php?course_message=$course_message&prog_id=$prog_id");
		exit();
	}
	else
	{
		$sql = "INSERT INTO course VALUES ('', '$syllabus_id', '$course_code', '$course_title', '$credit', '$prerequisite')";
		if($prerequisite<0)$sql = "INSERT INTO course VALUES ('', '$syllabus_id', '$course_code', '$course_title', '$credit', NULL)";
		if(!strlen($prerequisite)) $sql = "INSERT INTO course VALUES ('', '$syllabus_id', '$course_code', '$course_title', '$credit', NULL)";
		$sql_query = mysqli_query($con, $sql);
		if($sql_query)
		{
			$course_message="Course is added successfully";
			header("location:show_program.php?course_message=$course_message&prog_id=$prog_id");
			exit();
		}
		else
		{
			$course_message="Error";
			header("location:show_program.php?course_message=$course_message&prog_id=$prog_id");
			exit();
		}
	}
?>