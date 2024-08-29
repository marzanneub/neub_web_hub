<?php
require('connect.php');
require('admin_check.php');

	$notice_id = $_POST['notice_id'];
	
	
	if($notice_id==0)
	{
		$message="Please select a notice id!";
		header("location:notice.php?update_message=" . urlencode($message));
		exit();
	}
	
	$sql = "DELETE FROM notice WHERE notice_id='$notice_id'";
	$sql_query = mysqli_query($con, $sql);
		
	if($sql_query)
	{
		$message="Successfully deleted";
		header("location:notice.php?delete_message=" . urlencode($message));
		exit();
	}
	else
	{
		$message="Error!";
		header("location:notice.php?delete_message=" . urlencode($message));
		exit();
	}
?>