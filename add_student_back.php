<?php
require('connect.php');
require('admin_check.php');

	$s_id = $_POST['s_id'];
	$name = $_POST['name'];
	$photo = $_POST['photo'];
	$prog_id = $_POST['prog_id'];
	$session_id = $_POST['session_id'];
	$address = $_POST['address'];
	$phone_number = $_POST['phone_number'];
	$email = $_POST['email'];
	$name = strtolower($name);
	$address = strtolower($address);
	
	if(!strlen($photo))
	{
		$photo = 'default.png';
	}
	
	for($i=0; $i<strlen($name); $i++)
	{
		if(($name[$i]<'a' || $name[$i]>'z') && ($name[$i]!=' '))
		{
			$s_message="Name is invalid!";
			header("location:students.php?s_message=" . urlencode($s_message));
			exit();
		}
	}
	
	for($i=0; $i<strlen($s_id); $i++)
	{
		if($s_id[$i]<'0' || $s_id[$i]>'9')
		{
			$s_message="ID is invalid!";
			header("location:students.php?s_message=" . urlencode($s_message));
			exit();
		}
	}
	
	for($i=0; $i<strlen($phone_number); $i++)
	{
		if($phone_number[$i]<'0' || $phone_number[$i]>'9')
		{
			$s_message="Phone number is invalid!";
			header("location:students.php?s_message=" . urlencode($s_message));
			exit();
		}
	}
	
	if($phone_number[0]!='0' || $phone_number[1]!='1' || strlen($phone_number)!=11)
	{
		$s_message="Please provide a bangladeshi phone number!";
		header("location:students.php?s_message=" . urlencode($s_message));
		exit();
	}
	
	$sql = "SELECT * FROM student WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$s_message="This id is already exists!";
		header("location:students.php?s_message=" . urlencode($s_message));
		exit();
	}
	
	if($prog_id=='0')
	{
		$s_message="Please select a program!";
		header("location:students.php?s_message=" . urlencode($s_message));
		exit();
	}
	
	if($session_id=='0')
	{
		$s_message="Please select a session!";
		header("location:students.php?s_message=" . urlencode($s_message));
		exit();
	}
	
	$sql = "INSERT INTO student VALUES ('$s_id', '$name', '$photo', '$prog_id', '$session_id', '$address', '$phone_number', '$email', '0', '0', 0, 0)";
	$sql_query = mysqli_query($con, $sql);
	if(!$sql_query)
	{
		$s_message="Error!";
		header("location:students.php?s_message=" . urlencode($s_message));
		exit();
	}
	
	if($sql_query)
	{
		$sql = "INSERT INTO waiver VALUES ('$s_id', '0')";
		$sql_query = mysqli_query($con, $sql);
		
		if($sql_query)
		{
			$s_message="Successfully enrolled";
			header("location:students.php?s_message=" . urlencode($s_message));
			exit();
		}
		else
		{
			$s_message="Error!";
			header("location:students.php?s_message=" . urlencode($s_message));
			exit();
		}
	}
	else
	{
		$s_message="Error!";
		header("location:students.php?s_message=" . urlencode($s_message));
		exit();
	}
?>