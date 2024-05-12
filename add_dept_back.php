<?php
require('connect.php');
require('admin_check.php');

	$dept_name = $_POST['dept_name'];
	$dept_name = strtolower($dept_name);
	
	for($i=0; $i<strlen($dept_name); $i++)
	{
		if($dept_name[$i]<'a' || $dept_name[$i]>'z')
		{
			$dept_message="Department name is invalid";
			header("location:departments.php?dept_message=" . urlencode($dept_message));
			exit();
		}
	}

	$sql = "SELECT * FROM dept WHERE dept_name='$dept_name'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);


	if($found)
	{
		$dept_message="This department is already added";
		header("location:departments.php?dept_message=" . urlencode($dept_message));
		exit();
	}
	else
	{
		$sql = "INSERT INTO dept VALUES ('', '$dept_name', '1')";
		$sql_query = mysqli_query($con, $sql);
		if($sql_query)
		{
			$dept_message="Department is added successfully";
			header("location:departments.php?dept_message=" . urlencode($dept_message));
			exit();
		}
		else
		{
			$dept_message="Error";
			header("location:departments.php?dept_message=" . urlencode($dept_message));
			exit();
		}
	}
	
?>