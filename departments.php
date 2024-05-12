<!DOCTYPE html>
<html>
<head>
	<title>Departments</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="departments-style.css">
</head>
<body>
<?php
require('admin_check.php');
require('connect.php');
?>

<a href="admin_landing.php"> Back </a>
</br>
<a href="logout.php"> Logout </a>
</br>

<h3> Add department </h3>
<form action="add_dept_back.php" method="POST">
	<input type="text" name="dept_name" placeholder="Department name" required="">
	<button> Add department </button>
</form>
<?php if(isset($_GET['dept_message'])) { ?>
			<div class="message"><?php echo $_GET['dept_message']; ?></div>
<?php } ?>

</br>

<h3> Update department name </h3>
<form action="update_dept_back.php" method="POST">
	<select id="dept_id" name="old_name">
	<?php
		$sql = "SELECT * FROM dept";
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value=''>--Select--</option>";
		if (mysqli_num_rows($sql_query))
		{
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["dept_name"] . "'>" . $row["dept_name"] . "</option>";
			}
		}
	?>
	</select>
	<input type="text" name="new_name" placeholder="New name" required="">
	<button> Update </button>
</form>
<?php if(isset($_GET['update_message'])) { ?>
			<div class="message"><?php echo $_GET['update_message']; ?></div>
<?php } ?>

<h3> Delete department </h3>
<form action="delete_dept_back.php" method="POST">
	<select id="dept_id" name="dept_name">
	<?php
		$sql = "SELECT * FROM dept";
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value=''>--Select--</option>";
		if (mysqli_num_rows($sql_query))
		{
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["dept_name"] . "'>" . $row["dept_name"] . "</option>";
			}
		}
	?>
	</select>
	<button> Delete </button>
</form>
<?php if(isset($_GET['delete_message'])) { ?>
			<div class="message"><?php echo $_GET['delete_message']; ?></div>
<?php } ?>

<h3> Change enroll status </h3>
<form action="change_dept_ enroll_back.php" method="POST">
	<select id="dept_id" name="dept_name">
	<?php
		$sql = "SELECT * FROM dept";
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value=''>--Select--</option>";
		if (mysqli_num_rows($sql_query))
		{
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["dept_name"] . "'>" . $row["dept_name"] . "</option>";
			}
		}
	?>
	</select>
	<button> Change </button>
</form>
<?php if(isset($_GET['change_message'])) { ?>
			<div class="message"><?php echo $_GET['change_message']; ?></div>
<?php } ?>

<h2>Department Table</h2>
<table>
	<tr>
	<th>Department ID</th>
	<th>Department name</th>
	<th>Enroll Status</th>
	</tr>
<?php
	$sql = "SELECT * FROM dept";
	$sql_query = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_assoc($sql_query))
	{
		if($row["dept_status"]) $dept_status = "on";
		else $dept_status = "off";
		echo "<tr><td>" . $row["dept_id"] . "</td><td>" . $row["dept_name"] . "</td><td> $dept_status </td></tr>";
	}
?>
</table>

	
</body>
</html>