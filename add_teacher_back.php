<?php
require('connect.php');
require('admin_check.php');

	$t_name = $_POST['t_name'];
	$phone_number = $_POST['phone_number'];
	$photo = $_POST['photo'];
	$dept_id = $_POST['dept_id'];
	$designation = $_POST['designation'];
	$qualification = $_POST['qualification'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$t_name = strtolower($t_name);
	$address = strtolower($address);
	
	
	for($i=0; $i<strlen($t_name); $i++)
	{
		if(($t_name[$i]<'a' || $t_name[$i]>'z') && ($t_name[$i]!=' ') && ($t_name[$i]!='.') && ($t_name[$i]!='-'))
		{
			$t_message="Name is invalid!";
			header("location:teachers.php?t_message=" . urlencode($t_message));
			exit();
		}
	}
	
	for($i=0; $i<strlen($phone_number); $i++)
	{
		if($phone_number[$i]<'0' || $phone_number[$i]>'9')
		{
			$t_message="Phone number is invalid!";
			header("location:teachers.php?t_message=" . urlencode($t_message));
			exit();
		}
	}
	
	if($phone_number[0]!='0' || $phone_number[1]!='1' || strlen($phone_number)!=11)
	{
		$t_message="Please provide a bangladeshi phone number!";
		header("location:teachers.php?t_message=" . urlencode($t_message));
		exit();
	}
	if($designation=='0')
	{
		$t_message="Please select a designation!";
		header("location:teachers.php?t_message=" . urlencode($t_message));
		exit();
	}
	if(!strlen($photo))
	{
		$photo = 'default.png';
	}

	$sql = "INSERT INTO teacher VALUES ('', '$t_name', '$photo', '$dept_id', '$designation', '$qualification', '$address', '$phone_number', '$email', '0', '0', 0, 0)";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$t_message="Successfully added";
		header("location:teachers.php?t_message=" . urlencode($t_message));
		exit();
	}
	else
	{
		$t_message="Error!";
		header("location:teachers.php?t_message=" . urlencode($t_message));
		exit();
	}
?>