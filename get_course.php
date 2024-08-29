<?php
require('teacher_check.php');

	$session_id = $_GET['session_id'];
	
	$sql = "SELECT * FROM current_program";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$prog_id = $row['prog_id'];
	
	$sql = "SELECT * FROM course_on_c_o_l JOIN course ON course_on_c_o_l.course_id=course.course_id WHERE session_id='$session_id' AND prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$data = array();
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$data[] = $row;
	}
	
	echo json_encode($data);
?>
