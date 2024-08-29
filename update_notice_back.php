<?php
require('connect.php');
require('admin_check.php');

	$notice_id = $_POST['notice_id'];
	$notice_title = $_POST['notice_title'];
	$notice_details = $_POST['notice_details'];
	
	
	if($notice_id==0)
	{
		$message="Please select a notice id!";
		header("location:notice.php?update_message=" . urlencode($message));
		exit();
	}

	$x=0;
	
	if(strlen($notice_title))
	{
		$sql = "UPDATE notice SET notice_title='$notice_title' WHERE notice_id='$notice_id'";
		$sql_query = mysqli_query($con, $sql);
		
		if(!$sql_query)
		{
			$message="Error!";
			header("location:notice.php?update_message=" . urlencode($message));
			exit();
		}
		
		$x++;
	}
	
	if(strlen($notice_details))
	{
		$sql = "UPDATE notice SET notice_details='$notice_details' WHERE notice_id='$notice_id'";
		$sql_query = mysqli_query($con, $sql);
		
		if(!$sql_query)
		{
			$message="Error!";
			header("location:notice.php?update_message=" . urlencode($message));
			exit();
		}
		
		$x++;
	}
	
	if($x)
	{
		$message="Successfully updated";
		header("location:notice.php?update_message=" . urlencode($message));
		exit();
	}
	else
	{
		$message="Nothing updated!";
		header("location:notice.php?update_message=" . urlencode($message));
		exit();
	}
?>