<?php
require('connect.php');
require('admin_check.php');

	$prog_id = $_POST['prog_id'];
	$session_id2 = $_POST['session_id2'];
	$course_id = $_POST['course_id'];
	echo $course_id;
	
	if($course_id==0)
	{
		$add_course_message="Please select a course!";
		header("location:show_course_offer_list.php?add_course_message=$add_course_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "SELECT * FROM course_on_c_o_l WHERE prog_id='$prog_id' AND session_id='$session_id2' AND course_id='$course_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$add_course_message="This already is already exists under this session!";
		header("location:show_course_offer_list.php?add_course_message=$add_course_message&prog_id=$prog_id");
		exit();
	}
	
	if($course_id==0)
	{
		$add_course_message="Please select a course!";
		header("location:show_course_offer_list.php?add_course_message=$add_course_message&prog_id=$prog_id");
		exit();
	}

	$sql = "INSERT INTO course_on_c_o_l VALUES ('$prog_id', '$session_id2', '$course_id')";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$add_course_message="Successfully added";
		header("location:show_course_offer_list.php?add_course_message=$add_course_message&prog_id=$prog_id");
		exit();
	}
	else
	{
		$add_course_message="Error!";
		header("location:show_course_offer_list.php?add_course_message=$add_course_message&prog_id=$prog_id");
		exit();
	}
?>