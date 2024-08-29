<!DOCTYPE html>
<html>
<head>
	<title>Teacher approval</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="teacher_approval-style.css">
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
<h2>Teacher table</h2>
</div>

<table class="table-style">
	<tr>
	<th> Photo </th>
	<th> Teacher ID </th>
	<th> Name </th>
	<th> Department </th>
	<th> Designation </th>
	<th> Phone number </th>
	<th> Address </th>
	<th> Email address </th>
	<th> Approval </th>
	</tr>
<?php
	$sql = "SELECT * FROM teacher JOIN dept ON teacher.dept_id=dept.dept_id WHERE teacher.approve='0' AND teacher.registration='1'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		while($row = mysqli_fetch_assoc($sql_query))
		{
			
			echo "<tr><td><img src='teacher_images/" . $row['photo'] . "' width='50px' height='50px'></td><td>" . $row["t_id"] . "</td><td>" . $row["t_name"] . "</td><td>" . $row["dept_name"] . "</td><td>" . $row["designation"] . "</td><td>" . $row["phone_number"] . "</td><td>" . $row["address"] . "</td><td>" . $row["email"] . "</td><td><a href='teacher_approve_back.php?t_id=" . $row["t_id"] . "'?> Approve </a></td></tr>";
		}
	}
	
	$sql = "SELECT * FROM teacher JOIN dept ON teacher.dept_id=dept.dept_id WHERE teacher.approve='1' AND teacher.registration='1'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		while($row = mysqli_fetch_assoc($sql_query))
		{
			
			echo "<tr><td><img src='teacher_images/" . $row['photo'] . "' width='50px' height='50px'></td><td>" . $row["t_id"] . "</td><td>" . $row["t_name"] . "</td><td>" . $row["dept_name"] . "</td><td>" . $row["designation"] . "</td><td>" . $row["phone_number"] . "</td><td>" . $row["address"] . "</td><td>" . $row["email"] . "</td><td><a href='teacher_disapprove_back.php?t_id=" . $row["t_id"] . "'?> Disapprove </a></td></tr>";
		}
	}
?>
</table>

	
</body>
</html>