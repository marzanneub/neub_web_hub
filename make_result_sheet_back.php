<?php
require('connect.php');
require('admin_check.php');
	
	$sql = "SELECT * FROM c_r_reg";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
		
	if(!$found)
	{
		$s_message="At first please complete the session!";
		header("location:course_offer_list.php?make_message=" . urlencode($s_message));
		exit();
	}
	
	$sql50 = "SELECT * FROM make_result_sheet WHERE publish='0'";
	$sql_query50 = mysqli_query($con, $sql50);
	$found = mysqli_num_rows($sql_query50);
		
	if($found)
	{
		$s_message="Please publish the previuos result first!";
		header("location:course_offer_list.php?make_message=" . urlencode($s_message));
		exit();
	}
	
	$sql = "SELECT * FROM course_on_c_o_l";
	$sql_query = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$session_id = $row['session_id'];
		$course_id = $row['course_id'];
		
		$sql2 = "SELECT * FROM taken WHERE session_id=$session_id AND course_id=$course_id";
		$sql_query2 = mysqli_query($con, $sql2);
		$found = mysqli_num_rows($sql_query2);
		
		if(!$found)
		{
			$s_message="You cannot make this syllabus because some course have no teacher in some program!";
			header("location:course_offer_list.php?make_message=" . urlencode($s_message));
			exit();
		}
	}
	
	$sql = "SELECT * FROM taken";
	$sql_query = mysqli_query($con, $sql);
	while($row=mysqli_fetch_assoc($sql_query))
	{
		$sql2 = "INSERT INTO taken_result VALUES('$row[t_id]', '$row[prog_id]', '$row[session_id]', '$row[course_id]')";
		$sql_query2 = mysqli_query($con, $sql2);
	}
	
	$sql = "SELECT * FROM current_session";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$enroll_session = $row['session_id'];
	
	$sql = "SELECT * FROM enroll";
	$sql_query = mysqli_query($con, $sql);
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$s_id = $row['s_id'];
		$course_id = $row['course_id'];
		$course_session = $row['session_id'];
		
		$sql2 = "SELECT * FROM student WHERE s_id=$s_id";
		$sql_query2 = mysqli_query($con, $sql2);
		$row2 = mysqli_fetch_assoc($sql_query2);
		
		$student_session = $row2['session_id'];
		
		$sql3 = "INSERT INTO result VALUES('$s_id', '$course_id', '$student_session', '$enroll_session', '$course_session', '0', '0', '0', '0', '0')";
		$sql_query3 = mysqli_query($con, $sql3);
	}
	
	$sql20 = "SELECT * FROM current_session";
	$sql_query20 = mysqli_query($con, $sql20);
	$row20 = mysqli_fetch_assoc($sql_query20);
	$current_session20 = $row20['session_id'];
	
	$sql20 = "INSERT INTO make_result_sheet VALUES($current_session20, '0')";
	$sql_query20 = mysqli_query($con, $sql20);
	
	$sql = "DELETE FROM enroll";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$s_message="Successfully made";
		header("location:course_offer_list.php?make_message=" . urlencode($s_message));
		exit();
	}
	else
	{
		$s_message="Error!";
		header("location:course_offer_list.php?make_message=" . urlencode($s_message));
		exit();
	}
?>