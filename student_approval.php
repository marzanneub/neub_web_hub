<!DOCTYPE html>
<html>
<head>
	<title>Student approval</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="student_approval-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
	require('admin_check.php');
?>

<div class="upper_buttons">
<a href="admin_landing.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<?php if(isset($_GET['message'])) { ?>
			<div class="message"><?php echo $_GET['message']; ?></div>
<?php } ?>

<div class="topic">
<h2>Student table</h2>
</div>

<table class="table-style">
	<tr>
	<th> Photo </th>
	<th> Student ID </th>
	<th> Name </th>
	<th> Program </th>
	<th> Department </th>
	<th> Session </th>
	<th> Phone number </th>
	<th> Address </th>
	<th> Email address </th>
	<th> Approval </th>
	</tr>
<?php
	$sql = "SELECT * FROM student JOIN session ON (student.prog_id=session.prog_id AND student.session_id=session.session_id) JOIN prog ON student.prog_id=prog.prog_id JOIN dept ON prog.dept_id=dept.dept_id WHERE student.approve='0' AND student.registration='1'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<tr><td><img src='student_images/" . $row['photo'] . "' width='50px' height='50px'></td><td>" . $row["s_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["prog_name"] . "</td><td>" . $row["dept_name"] . "</td><td>" . $row["session_name"] . ' ' . $row["year"] . "</td><td>" . $row["phone_number"] . "</td><td>" . $row["address"] . "</td><td>" . $row["email"] . "</td><td><a href='student_approve_back.php?s_id=" . $row["s_id"] . "'?> Approve </a></td></tr>";
		}
	}
?>

<?php
	$sql = "SELECT * FROM student JOIN session ON (student.prog_id=session.prog_id AND student.session_id=session.session_id) JOIN prog ON student.prog_id=prog.prog_id JOIN dept ON prog.dept_id=dept.dept_id WHERE student.approve='1' AND student.registration='1'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<tr><td><img src='student_images/" . $row['photo'] . "' width='50px' height='50px'></td><td>" . $row["s_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["prog_name"] . "</td><td>" . $row["dept_name"] . "</td><td>" . $row["session_name"] . ' ' . $row["year"] . "</td><td>" . $row["phone_number"] . "</td><td>" . $row["address"] . "</td><td>" . $row["email"] . "</td><td><a href='student_disapprove_back.php?s_id=" . $row["s_id"] . "'?> Dispparove </a></td></tr>";
		}
	}
?>
</table>

	
</body>
</html>