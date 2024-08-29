<?php
require('teacher_check.php');

	$prog_id = $_GET['prog_id'];
	$sql = "SELECT * FROM taken_result JOIN session ON taken_result.session_id=session.session_id WHERE prog_id='$prog_id' AND t_id=$t_id";
	
	//$sql = "SELECT * FROM session WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$data = array();
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$data[] = $row;
	}
	
	echo json_encode($data);
?>
