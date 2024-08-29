<!DOCTYPE html>
<html>
<head>
	<title>Course registration approval</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="course_reg_approval-style.css">
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

<?php if(isset($_GET['message'])) { ?>
	<div class="message"><?php echo $_GET['message']; ?></div>
<?php } ?>

<div class="topic">
<h2>Approval table</h2>
</div>

<div class="informations">
<table class="table-style">
	<tr>
	<th> Photo </th>
	<th> Student ID </th>
	<th> Name </th>
	<th> Program </th>
	<th> Session </th>
	<th> Show details </th>
	<th> Approval </th>
	</tr>
<?php
	$sql0 = "SELECT * FROM course_advisor WHERE t_id=$t_id";
	$sql_query0 = mysqli_query($con, $sql0);
	
	while($row0=mysqli_fetch_array($sql_query0))
	{
		$session_id5 = $row0['session_id'];
		$prog_id5 = $row0['prog_id'];
		
		$sql = "SELECT * FROM c_r_status JOIN student ON c_r_status.s_id=student.s_id WHERE status='0' AND prog_id=$prog_id5 AND student.session_id=$session_id5";
		$sql_query = mysqli_query($con, $sql);
		$found = mysqli_num_rows($sql_query);
		
		if($found)
		{
			while($row = mysqli_fetch_assoc($sql_query))
			{
				$session_id=$row['session_id'];
				$prog_id=$row['prog_id'];
				
				$sql2 = "SELECT * FROM course_advisor WHERE session_id=$session_id AND t_id=$t_id";
				$sql_query2 = mysqli_query($con, $sql2);
				$found2 = mysqli_num_rows($sql_query2);
				
				$sql3 = "SELECT * FROM session WHERE session_id=$session_id";
				$sql_query3 = mysqli_query($con, $sql3);
				$row3 = mysqli_fetch_assoc($sql_query3);
				
				$sql4 = "SELECT * FROM prog WHERE prog_id=$prog_id";
				$sql_query4 = mysqli_query($con, $sql4);
				$row4 = mysqli_fetch_assoc($sql_query4);
				
				if($found2==0) continue;
				
				echo "<tr><td><img src='student_images/" . $row['photo'] . "' width='50px' height='50px'></td><td>" . $row["s_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row4["prog_name"] . "</td><td>" . $row3["session_name"] . ' ' . $row3["year"] . "</td><td><a href='show_course_reg_details.php?s_id=" . $row["s_id"] . "'?> Detalis </a></td><td><a href='course_reg_approve_back.php?s_id=" . $row["s_id"] . "'?> Approve </a></td></tr>";
			}
		}
	}
?>

<?php
	$sql0 = "SELECT * FROM course_advisor WHERE t_id=$t_id";
	$sql_query0 = mysqli_query($con, $sql0);
	
	while($row0=mysqli_fetch_array($sql_query0))
	{
		$session_id5 = $row0['session_id'];
		$prog_id5 = $row0['prog_id'];
		
		$sql = "SELECT * FROM c_r_status JOIN student ON c_r_status.s_id=student.s_id WHERE status='1' AND prog_id=$prog_id5 AND student.session_id=$session_id5";
		$sql_query = mysqli_query($con, $sql);
		$found = mysqli_num_rows($sql_query);
		
		if($found)
		{
			while($row = mysqli_fetch_assoc($sql_query))
			{
				$session_id=$row['session_id'];
				$prog_id=$row['prog_id'];
				
				$sql2 = "SELECT * FROM course_advisor WHERE session_id=$session_id AND t_id=$t_id";
				$sql_query2 = mysqli_query($con, $sql2);
				$found2 = mysqli_num_rows($sql_query2);
				
				$sql3 = "SELECT * FROM session WHERE session_id=$session_id";
				$sql_query3 = mysqli_query($con, $sql3);
				$row3 = mysqli_fetch_assoc($sql_query3);
				
				$sql4 = "SELECT * FROM prog WHERE prog_id=$prog_id";
				$sql_query4 = mysqli_query($con, $sql4);
				$row4 = mysqli_fetch_assoc($sql_query4);
				
				if($found2==0) continue;
				
				echo "<tr><td><img src='student_images/" . $row['photo'] . "' width='50px' height='50px'></td><td>" . $row["s_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row4["prog_name"] . "</td><td>" . $row3["session_name"] . ' ' . $row3["year"] . "</td><td><a href='show_course_reg_details.php?s_id=" . $row["s_id"] . "'?> Detalis </a></td><td><a href='course_reg_disapprove_back.php?s_id=" . $row["s_id"] . "'?> Disapprove </a></td></tr>";
			}
		}
	}
?>


</table>
</div>
	
</body>
</html>