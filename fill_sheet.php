<!DOCTYPE html>
<html>
<head>
	<title>Fill result sheet</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="fill_sheet-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
	require('teacher_check.php');
?>
<div class="upper_buttons">
<a href="get_result_sheet.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<?php
	$session_id = $_GET['session_id'];
	$course_id = $_GET['course_id'];
?>

<div class="form">
<h3> Update student information</h3>
<form action="update_result_back.php?session_id=<?php echo"$session_id"; ?>&course_id=<?php echo"$course_id"; ?>" method="POST">
	<input type="s_id" name="s_id" placeholder="Student ID">
	<input type="mid_term" name="mid_term" placeholder="mid_term">
	<input type="final" name="final" placeholder="final">
	<input type="attendance" name="attendance" placeholder="attendance">
	<input type="other" name="other" placeholder="other">
	<button> Update </button>
</form>
</div>
<?php if(isset($_GET['update_message'])) { ?>
			<div class="message"><?php echo $_GET['update_message']; ?></div>
<?php } ?>
</br>

<div class="informations">
<table class="table-style">
	<tr>
	<th> Student ID</th>
	<th> Mid term </th>
	<th> Final </th>
	<th> Attendance </th>
	<th> Other </th>
	</tr>
<?php
	$sql = "SELECT * FROM result WHERE course_session=$session_id AND course_id=$course_id AND publish='0'";
	$sql_query = mysqli_query($con, $sql);
	while($row = mysqli_fetch_assoc($sql_query))
	{	
		echo "<tr><td>" . $row['s_id'] . "</td><td>" . $row['mid_term'] . "</td><td>" . $row['final'] . "</td><td>" . $row['attendance'] . "</td><td>" . $row['other'] . "</td></tr>";
	}
?>
</table>
</div>
	
</body>
</html>