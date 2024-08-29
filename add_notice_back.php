<?php
require('connect.php');
require('admin_check.php');
	echo date("l, F j, Y");

	$notice_title = $_POST['notice_title'];
	$notice_details = $_POST['notice_details'];
	$date = date("l, j F, Y");
	

	$sql = "INSERT INTO notice VALUES ('', '$notice_title', '$notice_details', '$date')";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$message="Successfully added";
		header("location:notice.php?message=" . urlencode($message));
		exit();
	}
	else
	{
		$message="Error!";
		header("location:notice.php?message=" . urlencode($message));
		exit();
	}
?>