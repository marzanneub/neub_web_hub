<?php
	require('teacher_check.php');
?>

<?php
	$s_id = $_GET['s_id'];
	
	$sql = "UPDATE c_r_status SET status='1' WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql2 = "SELECT * FROM c_r_list WHERE s_id='$s_id'";
	$sql_query2 = mysqli_query($con, $sql2);
	while($row=mysqli_fetch_assoc($sql_query2))
	{
		$s_id2 = $row['s_id'];
		$course_id2 = $row['course_id'];
		$session_id2 = $row['session_id'];
		
		$sql3 = "INSERT INTO enroll VALUES ('$s_id2', '$course_id2', '$session_id2')";
		$sql_query3 = mysqli_query($con, $sql3);
		
	}
		
	if($sql_query)
	{
		$message = "Sucessfully approved";
		header("location:course_reg_approval.php?message="  . urlencode($message));
		exit();
	}
	else
	{
		$message = "Error!";
		header("location:course_reg_approval.php?message="  . urlencode($message));
		exit();
	}
	
?>