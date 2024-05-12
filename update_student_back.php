<?php
require('connect.php');
require('admin_check.php');

	$s_id = $_POST['s_id'];
	$new_name = $_POST['new_name'];
	$new_phone_number = $_POST['new_phone_number'];
	$new_photo = $_POST['new_photo'];
	$new_address = $_POST['new_address'];
	$new_email = $_POST['new_email'];
	
	$new_name = strtolower($new_name);
	$new_address = strtolower($new_address);
	$x = 0;
	
	$sql = "SELECT * FROM student WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if(!$found)
	{
		$update_message="Please select a student id!";
		header("location:students.php?update_message=$update_message");
		exit();
	}
	
	if(strlen($new_phone_number))
	{
		for($i=0; $i<strlen($new_phone_number); $i++)
		{
			if($new_phone_number[$i]<'0' || $new_phone_number[$i]>'9')
			{
				$update_message="Phone number is invalid!";
				header("location:students.php?update_message=" . urlencode($update_message));
				exit();
			}
		}
		
		if($new_phone_number[0]!='0' || $new_phone_number[1]!='1' || strlen($new_phone_number)!=11)
		{
			$update_message="Please provide a bangladeshi phone number!";
			header("location:students.php?update_message=" . urlencode($update_message));
			exit();
		}
	}
	
	if(strlen($new_name))
	{
		$sql = "UPDATE student SET name='$new_name' WHERE s_id='$s_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($new_phone_number))
	{
		$sql = "UPDATE student SET phone_number='$new_phone_number' WHERE s_id='$s_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if($new_photo)
	{
		$sql = "UPDATE student SET photo='$new_photo' WHERE s_id='$s_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($new_address))
	{
		$sql = "UPDATE student SET address='$new_address' WHERE s_id='$s_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($new_email))
	{
		$sql = "UPDATE student SET email='$new_email' WHERE s_id='$s_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if($x) $update_message="Successfully updated";
	else $update_message="Nothing updated";
	header("location:students.php?update_message=$update_message");
	exit();
?>