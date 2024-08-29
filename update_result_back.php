<?php
require('teacher_check.php');

	$s_id = $_POST['s_id'];
	$session_id = $_GET['session_id'];
	$course_id = $_GET['course_id'];
	$mid_term = $_POST['mid_term'];
	$final = $_POST['final'];
	$attendance = $_POST['attendance'];
	$other = $_POST['other'];
	
	//$new_name = $_POST['new_name'];
	//$new_phone_number = $_POST['new_phone_number'];
	//$new_photo = $_POST['new_photo'];
	//$new_address = $_POST['new_address'];
	//$new_email = $_POST['new_email'];
	
	//$new_name = strtolower($new_name);
	//$new_address = strtolower($new_address);
	//$x = 0;
	
	
	if(strlen($s_id)==0)
	{
		$update_message="Please provide the student id!";
		header("location:fill_sheet.php?session_id=$session_id&course_id=$course_id&update_message=$update_message");
		exit();
	}
	
	$sql = "SELECT * FROM result WHERE s_id='$s_id' AND course_session=$session_id AND course_id=$course_id";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if(!$found)
	{
		$update_message="Invalid student id!";
		header("location:fill_sheet.php?session_id=$session_id&course_id=$course_id&update_message=$update_message");
		exit();
	}
	
	if(strlen($mid_term) && ($mid_term>30 || $mid_term<0))
	{
		$update_message="Invalid marks!";
		header("location:fill_sheet.php?session_id=$session_id&course_id=$course_id&update_message=$update_message");
		exit();
	}
	
	if(strlen($final) && ($final>40 || $final<0))
	{
		$update_message="Invalid marks!";
		header("location:fill_sheet.php?session_id=$session_id&course_id=$course_id&update_message=$update_message");
		exit();
	}
	
	if(strlen($attendance) && ($attendance>10 || $attendance<0))
	{
		$update_message="Invalid marks!";
		header("location:fill_sheet.php?session_id=$session_id&course_id=$course_id&update_message=$update_message");
		exit();
	}
	
	if(strlen($other) && ($other>20 || $other<0))
	{
		$update_message="Invalid marks!";
		header("location:fill_sheet.php?session_id=$session_id&course_id=$course_id&update_message=$update_message");
		exit();
	}
	
	$x=0;
	if(strlen($mid_term))
	{
		$sql = "UPDATE result SET mid_term='$mid_term' WHERE s_id='$s_id' AND course_session='$session_id' AND course_id='$course_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($final))
	{
		$sql = "UPDATE result SET final='$final' WHERE s_id='$s_id' AND course_session='$session_id' AND course_id='$course_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($attendance))
	{
		$sql = "UPDATE result SET attendance='$attendance' WHERE s_id='$s_id' AND course_session='$session_id' AND course_id='$course_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if(strlen($other))
	{
		$sql = "UPDATE result SET other='$other' WHERE s_id='$s_id' AND course_session='$session_id' AND course_id='$course_id'";
		$sql_query = mysqli_query($con, $sql);
		$x++;
	}
	
	if($x) $update_message="Successfully updated";
	else $update_message="Nothing updated";
	header("location:fill_sheet.php?session_id=$session_id&course_id=$course_id&update_message=$update_message");
	exit();
?>