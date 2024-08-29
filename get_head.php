<?php
require('admin_check.php');
require('connect.php');

	$dept_id = $_GET['dept_id'];
	
	$sql = "SELECT * FROM teacher WHERE dept_id='$dept_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$data = array();
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$data[] = $row;
	}
	
	echo json_encode($data);
?>
