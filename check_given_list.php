<?php
require('student_check.php');
	
	$sql = "SELECT * FROM given_list WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	$sql = "SELECT * FROM c_r_reg";
	$sql_query = mysqli_query($con, $sql);
	$found2 = mysqli_num_rows($sql_query);
	
	if($found==0 && $found2==1)
	{
		$sql = "INSERT INTO given_list VALUES ('$s_id', 1)";
		$sql_query = mysqli_query($con, $sql);
		
		if($sql_query)
		{
			$sql = "SELECT * FROM student WHERE s_id=$s_id";
			$sql_query = mysqli_query($con, $sql);
			$row = mysqli_fetch_assoc($sql_query);
			
			$prog_id = $row['prog_id'];
			$session_id = $row['session_id'];
			
			$sql = "SELECT * FROM course_on_c_o_l WHERE prog_id=$prog_id AND session_id=$session_id";
			$sql_query = mysqli_query($con, $sql);
			
			$sql3 = "SELECT * FROM current_session";
			$sql_query3 = mysqli_query($con, $sql3);
			$row3 = mysqli_fetch_assoc($sql_query3);
			$current_session = $row3['session_id'];
			
			while($row = mysqli_fetch_assoc($sql_query))
			{
				$course_id = $row['course_id'];
				$session_id = $row['session_id'];
				$sql2 = "INSERT INTO c_r_list VALUES('$s_id', '$course_id', $session_id)";
				$sql_query2 = mysqli_query($con, $sql2);
			}
		}
	}
	
?>