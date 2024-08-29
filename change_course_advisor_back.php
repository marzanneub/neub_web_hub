<?php
	require('teacher_check.php');

	$prog_id = $_GET['prog_id'];
	$session_id = $_POST['session_id'];
	$t_id = $_POST['t_id2'];
	
	//echo "$prog_id $session_id $t_id";
	
	
	$sql = "DELETE FROM course_advisor WHERE prog_id=$prog_id AND session_id=$session_id";
	$sql_query = mysqli_query($con, $sql);
	
	if($t_id>0)
	{
		$sql = "INSERT INTO course_advisor VALUES('$t_id', '$prog_id', '$session_id')";
		$sql_query = mysqli_query($con, $sql);
	}
	else if($t_id==0)
	{
		$change_advisor_message="Please select an advisor!";
		header("location:show_course_offer_list_teacher.php?prog_id=$prog_id&change_advisor_message=" . urlencode($change_advisor_message));
		exit();
	}
	
	
	if($sql_query)
	{
		$change_advisor_message="Successfully changed";
		header("location:show_course_offer_list_teacher.php?prog_id=$prog_id&change_advisor_message=" . urlencode($change_advisor_message));
		exit();
	}
	else
	{
		$change_advisor_message="Error!";
		header("location:show_course_offer_list_teacher.php?prog_id=$prog_id&change_advisor_message=" . urlencode($change_advisor_message));
		exit();
	}
?>