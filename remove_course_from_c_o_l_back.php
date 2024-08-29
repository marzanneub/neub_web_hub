<?php
require('connect.php');
require('admin_check.php');

	$prog_id = $_POST['prog_id'];
	$session_id3 = $_POST['session_id3'];
	$course_id3 = $_POST['course_id3'];
	
	if($course_id3==0)
	{
		$remove_course_message="Please select a course!";
		header("location:show_course_offer_list_admin.php?remove_course_message=$remove_course_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "DELETE FROM course_on_c_o_l WHERE prog_id='$prog_id' AND session_id='$session_id3' AND course_id='$course_id3'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM c_r_list WHERE course_id='$course_id3'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM taken WHERE course_id='$course_id3' AND prog_id='$prog_id' AND session_id='$session_id3'";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$remove_course_message="Successfully removed";
		header("location:show_course_offer_list_admin.php?remove_course_message=$remove_course_message&prog_id=$prog_id");
		exit();
	}
	else
	{
		$remove_course_message="Error!";
		header("location:show_course_offer_list_admin.php?remove_course_message=$remove_course_message&prog_id=$prog_id");
		exit();
	}
?>