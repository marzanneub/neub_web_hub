<!DOCTYPE html>
<html>
<head>
	<title>Teacher account</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="teacher_landing-style2.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
	require('teacher_check.php');
?>
<div class="upper_buttons">
<a href="index.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="informations">
<?php
	$sql = "SELECT * FROM teacher JOIN dept on teacher.dept_id=dept.dept_id WHERE t_id = $t_id";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$imageData = $row['photo'];
	
	echo "<img src='teacher_images/" . $row['photo'] . "' width='200px' height='200px'></br>";
	$name = strtoupper($row['t_name']);
	echo "Name : $name</br>"; 
	echo "Teacher ID : $t_id</br>";
	echo "Phone number : $row[phone_number]</br>";
	echo "Department : $row[dept_name]</br>";
	echo "Qualification : $row[qualification]</br>";
?>
</div>
<div class="buttons">
<?php 
	$sql3 = "SELECT * FROM course_advisor WHERE t_id = $t_id";
	$sql_query3 = mysqli_query($con, $sql3);
	$row3 = mysqli_num_rows($sql_query3);
	
	$sql4 = "SELECT * FROM c_r_reg";
	$sql_query4 = mysqli_query($con, $sql4);
	$row4 = mysqli_num_rows($sql_query4);

	if($row3 && $row4) { ?>
		<a href="course_reg_approval.php"> Course registration approval </a>
<?php } ?>
</div>

<div class="buttons">
<?php 
	$sql3 = "SELECT * FROM taken_result WHERE t_id=$t_id";
	$sql_query3 = mysqli_query($con, $sql3);
	$row3 = mysqli_num_rows($sql_query3);

	if($row3) { ?>
		<a href="get_result_sheet.php"> Fill result sheet </a>
<?php } ?>
</div>

<div class="buttons">
<div class="topic">
<h2>Course offer list</h2>
</div>
<div class="informations">
<table class="table-style">
	<tr>
	<th> Program </th>
	<th> Show list </th>
	</tr>
<?php
	//$sql = "SELECT * FROM teacher JOIN dept_head on teacher.dept_id=dept_head.dept_id WHERE dept_head.t_id = $t_id";
	//$sql_query = mysqli_query($con, $sql);
	//$row=mysqli_num_rows($sql_query);
	//if($row)
	//{
		$sql2 = "SELECT * FROM teacher WHERE t_id=$t_id";
		$sql_query2 = mysqli_query($con, $sql2);
		$row2 = mysqli_fetch_assoc($sql_query2);
		$dept_id = $row2['dept_id'];
		
		//echo "<a href='show_course_offer_list_dept_head.php'> Modify course offer list </a>";
		$sql = "SELECT * FROM c_o_l JOIN prog ON c_o_l.prog_id=prog.prog_id JOIN dept ON prog.dept_id=dept.dept_id WHERE dept.dept_id=$dept_id";
		$sql_query = mysqli_query($con, $sql);
		while($row = mysqli_fetch_assoc($sql_query))
		{
			$prog_id = $row['prog_id'];
			echo "<tr><td>" . $row['prog_name'] . "</td><td><a href='show_course_offer_list_teacher.php?prog_id=$prog_id'> Show</a></td></tr>";
		}
	//}
?>
</table>
</div>
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