<?php
require('admin_check.php');
require('connect.php');

	$prog_id = $_GET['prog_id'];
	$sql = "SELECT * FROM session prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$data = array();
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$data[] = $row;
	}
	
	echo json_encode($data);
?>
