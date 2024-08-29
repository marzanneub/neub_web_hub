<?php
require('connect.php');
require('admin_check.php');

	$prog_id = $_POST['prog_id'];
	
	$sql = "SELECT * FROM prog WHERE prog.prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$x = $row['prog_status'];
	
	if($x==0) $x=1;
	else $x=0;
	
	$sql = "UPDATE prog SET prog_status='$x' WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$change_message="Successfully changed";
		header("location:programs.php?change_message=" . urlencode($change_message));
		exit();
	}
	else
	{
		$change_message="Error!";
		header("location:programs.php?change_message=" . urlencode($change_message));
		exit();
	}
?>