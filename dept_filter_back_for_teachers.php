<?php
require('connect.php');
require('admin_check.php');

	$dept_name = $_POST['dept_name'];
	if(!strlen($dept_name))
	{
		header("location:teachers.php");
		exit();
	}
	else
	{
		header("location:teachers.php?dept_filter=" . urlencode($dept_name));
		exit();
	}
?>