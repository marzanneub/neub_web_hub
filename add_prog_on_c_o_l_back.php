<?php
require('connect.php');
require('admin_check.php');

	$prog_id = $_POST['prog_id'];
	
	$sql = "SELECT * FROM c_o_l WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($prog_id=='0')
	{
		$s_message="Please select a program!";
		header("location:course_offer_list.php?s_message=" . urlencode($s_message));
		exit();
	}
	
	if($found)
	{
		$s_message="This program is already exists!";
		header("location:course_offer_list.php?s_message=" . urlencode($s_message));
		exit();
	}

	$sql = "INSERT INTO c_o_l VALUES ('$prog_id')";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$s_message="Successfully added";
		header("location:course_offer_list.php?s_message=" . urlencode($s_message));
		exit();
	}
	else
	{
		$s_message="Error!";
		header("location:course_offer_list.php?s_message=" . urlencode($s_message));
		exit();
	}
?>