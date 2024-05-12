<?php
require('connect.php');
require('admin_check.php');
	
	$sql = "SELECT * FROM course_on_c_o_l";
	$sql_query = mysqli_query($con, $sql);
	
	while($row=mysqli_fetch_assoc($sql_query))
	{
		$prog_id=$row['prog_id'];
		$session_id=$row['session_id'];
		$course_id=$row['course_id'];
		$sql2 = "INSERT INTO tooken_course VALUES ('$prog_id', '$session_id', '$course_id')";
		$sql_query2 = mysqli_query($con, $sql2);
		
	}
	
	$sql = "DELETE FROM course_on_c_o_l";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM session_on_c_o_l";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM c_o_l";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$s_message="Successfully ended";
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