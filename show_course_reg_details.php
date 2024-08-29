<!DOCTYPE html>
<html>
<head>
	<title>Course registration detalis</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="show_course_reg_details-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
	require('teacher_check.php');
?>
<div class="upper_buttons">
<a href="course_reg_approval.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>
<?php
	$s_id = $_GET['s_id'];
?>

<div class="informations">
<table class="table-style">
<?php
	$sql = "SELECT * FROM c_r_list JOIN course ON c_r_list.course_id=course.course_id WHERE s_id=$s_id";
	$sql_query = mysqli_query($con, $sql);
	
	$sql2 = "SELECT * FROM student WHERE s_id=$s_id";
	$sql_query2 = mysqli_query($con, $sql2);
	$row2 = mysqli_fetch_assoc($sql_query2);

	$sql3 = "SELECT SUM(course.credit) AS total_credit FROM c_r_list JOIN course ON c_r_list.course_id=course.course_id WHERE s_id=$s_id";
	$sql_query3 = mysqli_query($con, $sql3);
	$row3 = mysqli_fetch_assoc($sql_query3);
		
	echo "<tr><th colspan='3'>Total credit : " . $row3["total_credit"] . "</th></tr>";
	echo "<tr>
	<th> Course Code </th>
	<th> Course Title </th>
	<th> Credit </th>
	</tr>";
		
	while($row = mysqli_fetch_assoc($sql_query))
	{
		echo "<tr><td>" . $row["course_code"] . "</td><td>" . $row["course_title"] . "</td><td>" . $row["credit"] . "</td></tr>";
	}
?>
</table>
</div>
	
</body>
</html>