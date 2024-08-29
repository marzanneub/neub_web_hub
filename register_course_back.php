<?php
require('student_check.php');


	$sql2 = "INSERT INTO c_r_status values('$s_id', '0', $session_id)";
	$sql_query2 = mysqli_query($con, $sql2);
	
	if($sql_query2)
	{
		$add_course_message="Course registration successful";
		header("location:course_registartion.php?course_reg_message=$add_course_message");
		exit();
	}
	else
	{
		$add_course_message="Error!";
		header("location:course_registartion.php?course_reg_message=$add_course_message");
		exit();
	}
	
?>