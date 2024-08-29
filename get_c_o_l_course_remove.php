<?php
require('admin_check.php');
require('connect.php');

	$session_id3 = $_GET['session_id3'];
	$prog_id = $_GET['prog_id'];
	//echo $dept_id;
	
	
	$sql = "SELECT * FROM syllabus WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$syllabus_id = $row['syllabus_id'];
	
	$sql = "SELECT * FROM course_on_c_o_l JOIN course ON course_on_c_o_l.course_id=course.course_id WHERE course_on_c_o_l.session_id=$session_id3 AND course_on_c_o_l.prog_id=$prog_id";
	$sql_query = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_assoc($sql_query))
	{	
		if($found) $data[] = $row;
	}
	
	echo json_encode($data);
?>
