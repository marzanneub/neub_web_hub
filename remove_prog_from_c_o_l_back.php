<?php
require('connect.php');
require('admin_check.php');

	$prog_id = $_POST['prog_id2'];
	
	if($prog_id==0)
	{
		$s_message="Please select a program!";
		header("location:course_offer_list.php?remove_message=" . urlencode($s_message));
		exit();
	}
	
	$sql = "SELECT * FROM session_on_c_o_l WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$s_message="You cannot remove this program bacause some in this list are under this program!";
		header("location:course_offer_list.php?remove_message=" . urlencode($s_message));
		exit();
	}

	$sql = "DELETE FROM c_o_l WHERE prog_id=$prog_id";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$s_message="Successfully removed";
		header("location:course_offer_list.php?remove_message=" . urlencode($s_message));
		exit();
	}
	else
	{
		$s_message="Error!";
		header("location:course_offer_list.php?remove_message=" . urlencode($s_message));
		exit();
	}
?>