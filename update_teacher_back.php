<?php
require('connect.php');
require('admin_check.php');

	$t_id = $_POST['t_id'];
	$new_name = $_POST['new_name'];
	$new_phone_number = $_POST['new_phone_number'];
	$designation = $_POST['designation'];
	$new_qualification = $_POST['new_qualification'];
	$new_photo = $_POST['new_photo'];
	$new_address = $_POST['new_address'];
	$new_email = $_POST['new_email'];
	echo $new_photo;
	
	$new_name = strtolower($new_name);
	$new_address = strtolower($new_address);
	$x = 0;
	
	$sql = "SELECT * FROM teacher WHERE t_id='$t_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if(!$found)
	{
		$update_message="Please select a teacher id!";
		header("location:teachers.php?update_message=$update_message");
		exit();
	}
	
	if(strlen($new_phone_number))
	{
		for($i=0; $i<strlen($new_phone_number); $i++)
		{
			if($new_phone_number[$i]<'0' || $new_phone_number[$i]>'9')
			{
				$update_message="Phone number is invalid!";
				header("location:teachers.php?update_message=" . urlencode($update_message));
				exit();
			}
		}
		
		if($new_phone_number[0]!='0' || $new_phone_number[1]!='1' || strlen($new_phone_number)!=11)
		{
			$update_message="Please provide a bangladeshi phone number!";
			header("location:teachers.php?update_message=" . urlencode($update_message));
			exit();
		}
	}
	
	if(strlen($new_name))
	{
		$sql = "UPDATE teacher SET t_name='$new_name' WHERE t_id='$t_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($new_qualification))
	{
		$sql = "UPDATE teacher SET qualification='$new_qualification' WHERE t_id='$t_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($new_phone_number))
	{
		$sql = "UPDATE teacher SET phone_number='$new_phone_number' WHERE t_id='$t_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($designation) && $designation!='0')
	{
		$sql = "UPDATE teacher SET designation='$designation' WHERE t_id='$t_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if($new_photo)
	{
		$sql = "UPDATE teacher SET photo='$new_photo' WHERE t_id='$t_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($new_address))
	{
		$sql = "UPDATE teacher SET address='$new_address' WHERE t_id='$t_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($new_email))
	{
		$sql = "UPDATE teacher SET email='$new_email' WHERE t_id='$t_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if($x) $update_message="Successfully updated";
	else $update_message="Nothing updated";
	header("location:teachers.php?update_message=$update_message");
	exit();
?>