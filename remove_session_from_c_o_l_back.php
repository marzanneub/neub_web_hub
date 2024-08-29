<?php
require('connect.php');
require('admin_check.php');

	$prog_id = $_POST['prog_id'];
	$session_id = $_POST['session_id4'];
	
	if($session_id==0)
	{
		$s_message="Please select a session!";
		header("location:show_course_offer_list_admin.php?s_remove_message=$s_message&prog_id=$prog_id");
		exit();
	}
	
	$sql = "SELECT * FROM course_on_c_o_l WHERE prog_id='$prog_id' AND session_id='$session_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$s_message="You cannot delete this session because some courses are taken in this session!";
		header("location:show_course_offer_list_admin.php?s_remove_message=$s_message&prog_id=$prog_id");
		exit();
	}

	$sql = "DELETE FROM taken WHERE prog_id=$prog_id AND session_id=$session_id";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM session_on_c_o_l WHERE prog_id=$prog_id AND session_id=$session_id";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM course_advisor WHERE prog_id=$prog_id AND session_id=$session_id";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$s_message="Successfully removed";
		header("location:show_course_offer_list_admin.php?s_remove_message=$s_message&prog_id=$prog_id");
		exit();
	}
	else
	{
		$s_message="Error!";
		header("location:show_course_offer_list_admin.php?s_remove_message=$s_message&prog_id=$prog_id");
		exit();
	}
?>