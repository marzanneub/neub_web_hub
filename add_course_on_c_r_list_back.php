<?php
require('student_check.php');

	$course_id = $_POST['course_id11'];
	
	if($course_id==0)
	{
		$add_course_message="Please select a course!";
		header("location:course_registartion.php?add_course_message=$add_course_message");
		exit();
	}
	
	$sql3 = "SELECT * FROM course_on_c_o_l WHERE course_id='$course_id'";
	$sql_query3 = mysqli_query($con, $sql3);
	$row3 = mysqli_fetch_assoc($sql_query3);
	$session_id3 = $row3['session_id'];

	$sql2 = "INSERT INTO c_r_list values('$s_id', '$course_id', '$session_id3')";
	$sql_query2 = mysqli_query($con, $sql2);
	$y++;
	
	if($y)
	{
		$add_course_message="Successfully added";
		header("location:course_registartion.php?add_course_message=$add_course_message");
		exit();
	}
	else
	{
		$add_course_message="Error!";
		header("location:course_registartion.php?add_course_message=$add_course_message");
		exit();
	}
	
?>