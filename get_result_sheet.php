<!DOCTYPE html>
<html>
<head>
	<title>Get result sheet</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="get_result_sheet-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
	require('teacher_check.php');
?>
<div class="upper_buttons">
<a href="teacher_landing.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="informations">
<table class="table-style">
	<tr>
	<th> Program </th>
	<th> Session </th>
	<th> Course title </th>
	<th> Fill sheet </th>
	</tr>
<?php
	$sql = "SELECT * FROM taken_result WHERE t_id=$t_id";
	$sql_query = mysqli_query($con, $sql);
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$prog_id = $row['prog_id'];
		$session_id = $row['session_id'];
		$course_id = $row['course_id'];
		
		$sql1 = "SELECT * FROM prog WHERE prog_id=$prog_id";
		$sql_query1 = mysqli_query($con, $sql1);
		$row1 = mysqli_fetch_assoc($sql_query1);
		
		$sql2 = "SELECT * FROM session WHERE session_id=$session_id";
		$sql_query2 = mysqli_query($con, $sql2);
		$row2 = mysqli_fetch_assoc($sql_query2);
		
		$sql3 = "SELECT * FROM course WHERE course_id=$course_id";
		$sql_query3 = mysqli_query($con, $sql3);
		$row3 = mysqli_fetch_assoc($sql_query3);
		
		echo "<tr><td>" . $row1['prog_name'] . "</td><td>" . $row2['session_name'] . ' ' . $row2['year'] . "</td><td>" . $row3['course_title'] . "</td><td><a href='fill_sheet.php?session_id=" . $session_id . "&course_id=" . $course_id . "'?> Click here </a></td></tr>";
	}
?>
</table>
</div>
	
</body>
</html>