<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="result-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
	require('student_check.php');
?>
<div class="upper_buttons">
<a href="student_landing.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="informations">
<table class="table-style">
<?php
	$sql = "SELECT DISTINCT enroll_session FROM result WHERE s_id=$s_id AND publish='1'";
	$sql_query = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$session_id2 = $row['enroll_session'];
		
		$sql2 = "SELECT * FROM session WHERE session_id='$session_id2'";
		$sql_query2 = mysqli_query($con, $sql2);
		$row2 = mysqli_fetch_assoc($sql_query2);
		
		echo "<tr><th colspan='2'>Session : " . $row2["session_name"] . ' ' . $row2["year"] . "</th>";
		$sql4 = "SELECT SUM(course.credit) AS total_credit FROM result JOIN course ON result.course_id=course.course_id WHERE enroll_session=$session_id2 AND s_id=$s_id";
		$sql_query4 = mysqli_query($con, $sql4);
		$row4 = mysqli_fetch_assoc($sql_query4);
		echo "<th colspan='2'>Total credit : " . $row4["total_credit"] . "</th></tr>";
		
		echo "<tr><th>Course code</th><th>Course title</th><th>Credit</th><th>CGPA</th></tr>";
		
		
		$sql2 = "SELECT * FROM result JOIN course ON result.course_id=course.course_id WHERE enroll_session='$session_id2' AND s_id=$s_id AND publish='1'";
		$sql_query2 = mysqli_query($con, $sql2);
		
		while($row2 = mysqli_fetch_assoc($sql_query2))
		{
			$course_id = $row2["course_id"];
			
			$sql3 = "SELECT * FROM course WHERE course_id=$course_id";
			$sql_query3 = mysqli_query($con, $sql3);
			$row3 = mysqli_fetch_assoc($sql_query3);
			
			echo "<tr><td>" . $row2["course_code"] . "</td><td>" . $row2["course_title"] . "</td><td>" . $row2["credit"] . "</td>";
			
			$mid_term = $row2["mid_term"];
			$final = $row2["final"];
			$attendance = $row2["attendance"];
			$other = $row2["other"];
			$total = ($mid_term+$final+$attendance+$other);
			
			if($total>=80) echo "<td>4.00</td></tr>";
			else if($total>=75) echo "<td>3.75</td></tr>";
			else if($total>=70) echo "<td>3.50</td></tr>";
			else if($total>=65) echo "<td>3.25</td></tr>";
			else if($total>=60) echo "<td>3.00</td></tr>";
			else if($total>=55) echo "<td>2.75</td></tr>";
			else if($total>=50) echo "<td>2.50</td></tr>";
			else if($total>=45) echo "<td>2.25</td></tr>";
			else if($total>=40) echo "<td>2.00</td></tr>";
			else echo "<td>0.00</td></tr>";
		}
	}
?>
</table>
</div>
	
</body>
</html>