<!DOCTYPE html>
<html>
<head>
	<title>Program detalis</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="show_program-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
require('admin_check.php');
require('connect.php');
?>

<?php
	$prog_id = $_GET['prog_id'];
	$sql = "SELECT * FROM syllabus WHERE prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$syllabus_id = $row['syllabus_id'];
?>

<div class="upper_buttons">
<a href="programs.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="form">
<h3>Add course</h3>
<form action="add_course_back.php" method="POST">
	<input type="text" name="course_code" placeholder="Course code" required="">
	<input type="text" name="course_title" placeholder="Course title" required="">
	<input type="text" name="credit" placeholder="Credit" required="">
	<select id="course_id" name="prerequisite">
	<?php
		$sql = "SELECT * FROM syllabus JOIN course ON syllabus.syllabus_id=course.syllabus_id WHERE course.syllabus_id='$syllabus_id'";
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value='0'>---------- Prerequisite ----------</option>";
		echo "<option value='-1'> None </option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["course_id"] . "'>" . $row["course_code"] . ' | '. $row["course_title"] . "</option>";
		}
	?>
	</select>
	<input type="hidden" name="syllabus_id" value="<?php echo $syllabus_id; ?>">
	<input type="hidden" name="prog_id" value="<?php echo $prog_id; ?>">
	<button>Add</button>
</form>
</div>
<?php if(isset($_GET['course_message'])) { ?>
			<div class="message"><?php echo $_GET['course_message']; ?></div>
<?php } ?>
</br>

<div class="form">
<h3> Update course information</h3>
<form action="update_course_back.php" method="POST">
	<select id="course_id" name="course_id" method="POST">
		<?php
			$sql = "SELECT * FROM prog JOIN syllabus ON prog.prog_id=syllabus.prog_id JOIN course ON syllabus.syllabus_id=course.syllabus_id WHERE prog.prog_id='$prog_id'";
			$sql_query = mysqli_query($con, $sql);
			
			echo "<option value='0'>--Course ID--</option>";
			if (mysqli_num_rows($sql_query))
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["course_id"] . "'>" . $row["course_id"] . "</option>";
			}
		?>
	</select>
	<input type="text" name="new_code" placeholder="New code">
	<input type="text" name="new_title" placeholder="New title">
	<input type="text" name="new_credit" placeholder="New credit">
	<select id="course_id" name="prerequisite">
	<?php
		$sql = "SELECT * FROM syllabus JOIN course ON syllabus.syllabus_id=course.syllabus_id WHERE course.syllabus_id='$syllabus_id'";
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value='0'>---------- Change Prerequisite ----------</option>";
		echo "<option value='-1'> None </option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["course_id"] . "'>" . $row["course_code"] . ' | '. $row["course_title"] . "</option>";
		}
	?>
	</select>
	<input type="hidden" name="prog_id" value="<?php echo $prog_id; ?>">
	<button> Update </button>
</form>
</div>
<?php if(isset($_GET['update_message'])) { ?>
			<div class="message"><?php echo $_GET['update_message']; ?></div>
<?php } ?>
</br>

<div class="form">
<h3>Delete course</h3>
<form action="delete_course_back.php" method="POST">
	<select id="course_id" name="course_id" method="POST">
		<?php
			$sql = "SELECT * FROM prog JOIN syllabus ON prog.prog_id=syllabus.prog_id JOIN course ON syllabus.syllabus_id=course.syllabus_id WHERE prog.prog_id='$prog_id'";
			$sql_query = mysqli_query($con, $sql);
			
			echo "<option value='0'>----------Select a course----------</option>";
			if (mysqli_num_rows($sql_query))
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["course_id"] . "'>" . $row["course_code"] . ' | '. $row["course_title"] . "</option>";
			}
		?>
	</select>
	<input type="hidden" name="prog_id" value="<?php echo $prog_id; ?>">
	<button> Delete </button>
</form>
</div>
<?php if(isset($_GET['delete_message'])) { ?>
			<div class="message"><?php echo $_GET['delete_message']; ?></div>
<?php } ?>
</br>

<div class="topic">
<h2>Courses under this program</h2>
</div>

<div class="informations">
<table class="table-style">
<?php
	$sql = "SELECT SUM(course.credit) AS total_credit FROM prog JOIN syllabus ON prog.prog_id=syllabus.prog_id JOIN course ON syllabus.syllabus_id=course.syllabus_id WHERE prog.prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	echo "<tr><th colspan=3></th><th  colspan=2>";
	echo 'Total credit: ' . $row['total_credit'];
	echo "</th></tr>";
?>
	<tr>
	<th> Course ID </th>
	<th> Course Code </th>
	<th> Course Title </th>
	<th> Credit </th>
	<th> Prerequisite </th>
	</tr>
<?php
	$sql = "SELECT * FROM prog JOIN syllabus ON prog.prog_id=syllabus.prog_id JOIN course ON syllabus.syllabus_id=course.syllabus_id WHERE prog.prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		while($row = mysqli_fetch_assoc($sql_query))
		{
			$x = $row["prerequisite"];
			if($x)
			{
				$sql2 = "SELECT * FROM course WHERE course_id='$x'";
				$sql_query2 = mysqli_query($con, $sql2);
				$row2 = mysqli_fetch_assoc($sql_query2);
				$x = $row2["course_code"];
			}
			else $x=NULL;
			
			echo "<tr><td>" . $row["course_id"] . "</td><td>" . $row["course_code"] . "</td><td>" . $row["course_title"] . "</td><td>" . $row["credit"] . "</td><td>" . $x . "</td></tr>";
		}
	}
?>
</table>
</div>
	
</body>
</html>