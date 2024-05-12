<?php
require('connect.php');
require('admin_check.php');

	$session_id = $_POST['session_id'];
	$prog_id = $_POST['prog_id'];
	if($session_id%2) $session_name = 'spring';
	else $session_name = 'summer';
	$year = $session_id/10;
	
	if($prog_id==0)
	{
		$prog_message="Please select a program!";
		header("location:show_session.php?prog_message=$prog_message&session_id=$session_id");
		exit();
	}
	
	
	$sql = "SELECT * FROM session WHERE session_id='$session_id' AND prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$prog_message="This program is already have under this session!";
		header("location:show_session.php?prog_message=$prog_message&session_id=$session_id");
		exit();
	}
	
	$sql = "INSERT INTO session VALUES ('$session_id', '$session_name', '$year', '$prog_id', 0)";
	$sql_query = mysqli_query($con, $sql);
		
	if($sql_query)
	{
		$prog_message="Program is added successfully";
		header("location:show_session.php?prog_message=$prog_message&session_id=$session_id");
		exit();
	}
	else
	{
		$prog_message="Error!";
		header("location:show_session.php?prog_message=$prog_message&session_id=$session_id");
		exit();
	}
?>