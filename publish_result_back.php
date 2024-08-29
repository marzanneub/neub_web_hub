<?php
require('connect.php');
require('admin_check.php');
	
	$sql = "UPDATE result SET publish='1'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "UPDATE make_result_sheet SET publish='1'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM taken_result";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$s_message="Successfully published";
		header("location:course_offer_list.php?publish_message=" . urlencode($s_message));
		exit();
	}
	else
	{
		$s_message="Error!";
		header("location:course_offer_list.php?publish_message=" . urlencode($s_message));
		exit();
	}
?>