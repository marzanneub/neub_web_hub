<?php
	require('teacher_check.php');

	$prog_id = $_GET['prog_id'];
	$session_id = $_POST['session_id3'];
	$course_id = $_POST['course_id3'];
	$t_id = $_POST['t_id3'];
	
	//echo "$prog_id $session_id $t_id";
	
	
	$sql = "DELETE FROM taken WHERE prog_id=$prog_id AND session_id=$session_id AND course_id=$course_id";
	$sql_query = mysqli_query($con, $sql);
	
	if($t_id>0)
	{
		$sql = "INSERT INTO taken VALUES('$t_id', '$prog_id', '$session_id', $course_id)";
		$sql_query = mysqli_query($con, $sql);
	}
	else if($t_id==0)
	{
		$change_teacher_message="Please select a teacher!";
		header("location:show_course_offer_list_teacher.php?prog_id=$prog_id&change_teacher_message=" . urlencode($change_teacher_message));
		exit();
	}
	
	if($course_id==0)
	{
		$change_teacher_message="Please select a course!";
		header("location:show_course_offer_list_teacher.php?prog_id=$prog_id&change_teacher_message=" . urlencode($change_teacher_message));
		exit();
	}
	
	
	if($sql_query)
	{
		$change_teacher_message="Successfully changed";
		header("location:show_course_offer_list_teacher.php?prog_id=$prog_id&change_teacher_message=" . urlencode($change_teacher_message));
		exit();
	}
	else
	{
		$change_teacher_message="Error!";
		header("location:show_course_offer_list_teacher.php?prog_id=$prog_id&change_teacher_message=" . urlencode($change_teacher_message));
		exit();
	}
?>