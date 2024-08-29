<?php
require('connect.php');
require('admin_check.php');
	
	$sql = "SELECT * FROM current_session";
	$sql_query = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$current_session = $row['session_id'];
	}
	
	$sql = "SELECT * FROM make_result_sheet WHERE session_id=$current_session";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if(!$found)
	{
		$s_message="You cannot end this semester because result sheet is not made for this semester!";
		header("location:course_offer_list.php?end_message=" . urlencode($s_message));
		exit();
	}
	
	$sql = "SELECT * FROM course_on_c_o_l";
	$sql_query = mysqli_query($con, $sql);
	
	while($row=mysqli_fetch_assoc($sql_query))
	{
		$prog_id=$row['prog_id'];
		$session_id=$row['session_id'];
		$course_id=$row['course_id'];
		$sql2 = "INSERT INTO tooken_course VALUES ('$prog_id', '$session_id', '$course_id')";
		$sql_query2 = mysqli_query($con, $sql2);
		
	}
	
	$sql = "SELECT * FROM course_on_c_o_l JOIN course ON course_on_c_o_l.course_id=course.course_id";
	$sql_query = mysqli_query($con, $sql);
	
	$credit=0;
	while($row=mysqli_fetch_assoc($sql_query))
	{
		$prog_id=$row['prog_id'];
		$session_id=$row['session_id'];
		$course_id=$row['course_id'];
		$credit=$row['credit'];
		
		$sql2 = "SELECT * FROM session WHERE session_id=$session_id AND prog_id=$prog_id";
		$sql_query2 = mysqli_query($con, $sql2);
		$row2 = mysqli_fetch_assoc($sql_query2);
		$credit2=$row2['completed_credit'];
		$credit = $credit+$credit2;
		
		$sql2 = "UPDATE session SET completed_credit=$credit WHERE session_id=$session_id AND prog_id=$prog_id";
		$sql_query2 = mysqli_query($con, $sql2);
	}
	
	$sql = "DELETE FROM given_list";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM taken";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM course_on_c_o_l";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM session_on_c_o_l";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM c_o_l";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM c_r_list";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM c_r_status";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM enroll";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM course_advisor";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM course_registration";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "SELECT * FROM current_session";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	
	$current_session1 = $row['session_id'];
	if($current_session1%10==1) $current_session1+=1; 
	else $current_session1+=9;
	
	$sql = "DELETE FROM current_session";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "DELETE FROM c_r_reg";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "INSERT INTO current_session VALUES('$current_session1')";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$s_message="Successfully ended";
		header("location:course_offer_list.php?end_message=" . urlencode($s_message));
		exit();
	}
	else
	{
		$s_message="Error!";
		header("location:course_offer_list.php?end_message=" . urlencode($s_message));
		exit();
	}
?>