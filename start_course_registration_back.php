<?php
require('connect.php');
require('admin_check.php');
	
	
	$sql = "SELECT * FROM session_on_c_o_l";
	$sql_query = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$prog_id = $row['prog_id'];
		$session_id = $row['session_id'];
		
		$sql2 = "SELECT * FROM course_advisor WHERE session_id='$session_id' AND prog_id='$prog_id'";
		$sql_query2 = mysqli_query($con, $sql2);
		$found2 = mysqli_num_rows($sql_query2);
		
		if(!$found2)
		{
			$s_message="Please contact department heads to fulfill course offer list properly before starting registration!";
			header("location:course_offer_list.php?end_message=" . urlencode($s_message));
			exit();
		}
	}
	
	$sql = "SELECT * FROM course_on_c_o_l";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if(!$found2)
	{
		$s_message="Please add programms and courses!";
		header("location:course_offer_list.php?end_message=" . urlencode($s_message));
		exit();
	}
	
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$prog_id = $row['prog_id'];
		$session_id = $row['session_id'];
		$course_id = $row['course_id'];
		
		$sql2 = "SELECT * FROM taken WHERE session_id='$session_id' AND prog_id='$prog_id' AND course_id='$course_id'";
		$sql_query2 = mysqli_query($con, $sql2);
		$found2 = mysqli_num_rows($sql_query2);
		
		if(!$found2)
		{
			$s_message="Please contact department heads to fulfill course offer list properly before starting registration!";
			header("location:course_offer_list.php?end_message=" . urlencode($s_message));
			exit();
		}
	}
	
	$sql = "INSERT INTO c_r_reg VALUES('1')";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$s_message="Successfully started";
		header("location:course_offer_list.php?end_message=" . urlencode($s_message));
		exit();
	}
	else
	{
		$s_message="Error!";
		header("location:course_offer_list.php?end_message=" . urlencode($s_message));
		exit();
	}
?>