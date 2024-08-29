<?php
require('admin_check.php');
require('connect.php');

	$session_id2 = $_GET['session_id2'];
	$prog_id = $_GET['prog_id'];
	//echo $dept_id;
	
	
	$sql = "SELECT * FROM syllabus WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$syllabus_id = $row['syllabus_id'];
	
	$sql = "SELECT * FROM course WHERE syllabus_id='$syllabus_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$data = array();
	if($session_id2!=0)
	{
		while($row = mysqli_fetch_assoc($sql_query))
		{	
			$course_id = $row['course_id'];
			$sql2 = "SELECT * FROM course_on_c_o_l WHERE session_id=$session_id2 AND prog_id=$prog_id AND course_id=$course_id";
			$sql_query2 = mysqli_query($con, $sql2);
			$found = mysqli_num_rows($sql_query2);
			if($found) continue;
			
			$sql2 = "SELECT * FROM tooken_course WHERE session_id=$session_id2 AND prog_id=$prog_id AND course_id=$course_id";
			$sql_query2 = mysqli_query($con, $sql2);
			$found = mysqli_num_rows($sql_query2);
			if($found) continue;
			
			if($row['prerequisite']==NULL)	$data[] = $row;
			else
			{	$prerequisite = $row['prerequisite'];
				$sql2 = "SELECT * FROM tooken_course WHERE session_id=$session_id2 AND prog_id=$prog_id AND course_id=$prerequisite";
				$sql_query2 = mysqli_query($con, $sql2);
				$found = mysqli_num_rows($sql_query2);
				
				if($found) $data[] = $row;
			}
		}
	}
	
	echo json_encode($data);
?>
