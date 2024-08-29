<?php
require('admin_check.php');
require('connect.php');

	$prog_id = $_GET['prog_id'];
	$x = date('m');
	if($x>=6) $x=2;
	else $x=1;
	$y = 0;
	$sql = "SELECT * FROM session WHERE prog_id='$prog_id' AND session_id>='$y'";
	
	//$sql = "SELECT * FROM session WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$data = array();
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$data[] = $row;
	}
	
	echo json_encode($data);
?>
