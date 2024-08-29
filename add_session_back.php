<?php
require('connect.php');
require('admin_check.php');

	$session_name = $_POST['session_name'];
	$year = $_POST['year'];
	if($session_name=='spring') $session_id=(($year*10)+1);
	else $session_id=(($year*10)+2);

	$sql = "SELECT * FROM session WHERE session_id='$session_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$session_message="This session is already made!";
		header("location:sessions.php?session_message=$session_message");
		exit();
	}
	else
	{
		$sql = "SELECT * FROM prog";
		$sql_query = mysqli_query($con, $sql);
		$y=0;
		
		while($row = mysqli_fetch_assoc($sql_query))
		{
			$x = $row['prog_status'];
			if($x==1)
			{
				$prog_id = $row['prog_id'];
				$sql2 = "INSERT INTO session values('$session_id', '$session_name', '$year', '$prog_id', 0)";
				$sql_query2 = mysqli_query($con, $sql2);
				$y++;
			}
		}
	}
	
	if($y)
	{
		$session_message="Session make successful";
		header("location:sessions.php?session_message=$session_message");
		exit();
	}
	else
	{
		$session_message="Error!";
		header("location:sessions.php?session_message=$session_message");
		exit();
	}
	
?>