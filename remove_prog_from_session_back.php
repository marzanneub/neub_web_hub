<?php
require('admin_check.php');
require('connect.php');

	$session_id = $_POST['session_id'];
	$prog_id = $_POST['prog_id'];
	
	if($prog_id==0)
	{
		$remove_message="Please select a program!";
		header("location:show_session.php?remove_message=$remove_message&session_id=$session_id");
		exit();
	}
	
	$sql = "SELECT * FROM session WHERE session_id='$session_id' AND prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	$row5 = mysqli_fetch_assoc($sql_query);
	$completed_credit = $row5['completed_credit'];
	
	if($found>0 && $completed_credit>0)
	{
		$remove_message="You cannot remove the program, because some credit completed under this program in this session!";
		header("location:show_session.php?remove_message=$remove_message&session_id=$session_id");
		exit();
	}
	
	$sql = "SELECT * FROM course_on_c_o_l WHERE session_id='$session_id' AND prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$remove_message="You cannot remove the program, because some courses under this program in this session!";
		header("location:show_session.php?remove_message=$remove_message&session_id=$session_id");
		exit();
	}
	
	$sql = $sql = "SELECT * FROM student WHERE session_id='$session_id' AND prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$remove_message="You cannot remove the program, because some student enrolled under this program in this session!";
		header("location:show_session.php?remove_message=$remove_message&session_id=$session_id");
		exit();
	}
	
	$sql = $sql = "DELETE FROM session WHERE session_id='$session_id' AND prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$remove_message="Remove successful";
		header("location:show_session.php?remove_message=$remove_message&session_id=$session_id");
		exit();
	}
	else
	{
		$remove_message="Error!";
		header("location:show_session.php?remove_message=$remove_message&session_id=$session_id");
		exit();
	}
?>