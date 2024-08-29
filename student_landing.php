<!DOCTYPE html>
<html>
<head>
	<title>Student account</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="student_landing-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
	require('student_check.php');
?>
<?php if(isset($_GET['reg_message'])) { ?>
			<div class="message"><?php echo $_GET['reg_message']; ?></div>
<?php } ?>
<div class="upper_buttons">
<a href="index.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="informations">
<?php
	$sql = "SELECT * FROM student JOIN session ON student.session_id=session.session_id JOIN prog ON student.prog_id=prog.prog_id JOIN dept on prog.dept_id=dept.dept_id WHERE s_id = $s_id";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$imageData = $row['photo'];
	
	echo "<img src='student_images/" . $row['photo'] . "' width='200px' height='200px'></br>"; 
	echo "Name : $row[name]</br>"; 
	echo "Student ID : $s_id</br>";
	echo "Phone number : $row[phone_number]</br>";
	echo "Program : $row[prog_name] in $row[dept_name]</br>";
	echo "Session : $row[session_name] $row[year]</br>";
?>
<div>

<div class="buttons">
<a href="course_registartion.php"> Course registration </a>
</br>
<a href="result.php"> Result </a>
</div>

<div class="topic">
<h2>Notice board</h2>
</div>

<div class="informations">
<table class="table-style">
	<tr>
	<th> Notice title</th>
	<th> Details </th>
	<th> Publish date </th>
	</tr>
<?php
	$sql = "SELECT * FROM notice ORDER BY notice_id DESC";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$x=0;
		while($row = mysqli_fetch_assoc($sql_query))
		{
			$x++;
			if($x==4) break;
			echo "<tr><td>" . $row["notice_title"] . "</td><td>" . $row["notice_details"] . "</td><td>" . $row["date"] . "</td></tr>";
		}
	}
?>
</table>
</div>
	
</body>
</html>