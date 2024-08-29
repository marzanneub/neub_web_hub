<?php
require('student_check.php');

	$course_id = $_POST['course_id13'];
	
	if($course_id==0)
	{
		$remove_course_message="Please select a course!";
		header("location:course_registartion.php?remove_course_message=$remove_course_message");
		exit();
	}

	$sql2 = "DELETE FROM c_r_list WHERE s_id=$s_id AND course_id=$course_id";
	$sql_query2 = mysqli_query($con, $sql2);
	$y++;
	
	if($y)
	{
		$remove_course_message="Successfully removed";
		header("location:course_registartion.php?remove_course_message=$remove_course_message");
		exit();
	}
	else
	{
		$remove_course_message="Error!";
		header("location:course_registartion.php?remove_course_message=$remove_course_message");
		exit();
	}
	
?>