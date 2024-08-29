<!DOCTYPE html>
<html>
<head>
	<title>Faculty</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="faculty-style.css">
</head>
<?php
require('connect.php');
?>
<body>
<a href="index.php"> Back </a>

<table class="faculty_table-style">
<?php
	$sql = "SELECT * FROM dept";
	$sql_query = mysqli_query($con, $sql);
	
	while($row=mysqli_fetch_assoc($sql_query))
	{
		$dept_id = $row['dept_id'];
		echo "<tr><th>Department of " . $row['dept_name'] . "</th></tr>";
		
		$sql2 = "SELECT * FROM teacher WHERE dept_id=$dept_id AND designation='professor'";
		$sql_query2 = mysqli_query($con, $sql2);
		
		while($row2 = mysqli_fetch_assoc($sql_query2))
		{
			echo "<tr><td><img src='teacher_images/" . $row2['photo'] . "' width='120px' height='120px'></td><td>" . $row2["t_name"] . "</td><td>" . $row2["designation"] . "</td><td>" . $row2["qualification"] . "</td></tr>";
		}
		
		$sql2 = "SELECT * FROM teacher WHERE dept_id=$dept_id AND designation='associate professor'";
		$sql_query2 = mysqli_query($con, $sql2);
		
		while($row2 = mysqli_fetch_assoc($sql_query2))
		{
			echo "<tr><td><img src='teacher_images/" . $row2['photo'] . "' width='120px' height='120px'></td><td>" . $row2["t_name"] . "</td><td>" . $row2["designation"] . "</td><td>" . $row2["qualification"] . "</td></tr>";
		}
		
		$sql2 = "SELECT * FROM teacher WHERE dept_id=$dept_id AND designation='assistant professor'";
		$sql_query2 = mysqli_query($con, $sql2);
		
		while($row2 = mysqli_fetch_assoc($sql_query2))
		{
			echo "<tr><td><img src='teacher_images/" . $row2['photo'] . "' width='120px' height='120px'></td><td>" . $row2["t_name"] . "</td><td>" . $row2["designation"] . "</td><td>" . $row2["qualification"] . "</td></tr>";
		}
		
		$sql2 = "SELECT * FROM teacher WHERE dept_id=$dept_id AND designation='lecturer'";
		$sql_query2 = mysqli_query($con, $sql2);
		
		while($row2 = mysqli_fetch_assoc($sql_query2))
		{
			echo "<tr><td><img src='teacher_images/" . $row2['photo'] . "' width='120px' height='120px'></td><td>" . $row2["t_name"] . "</td><td>" . $row2["designation"] . "</td><td>" . $row2["qualification"] . "</td></tr>";
		}
	}
?>
</table>


</body>
</html>