<?php
require('admin_check.php');
require('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Teachers</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="teachers-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<div class="upper_buttons">
<a href="admin_landing.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="form">
<h3> Add teacher </h3>
<form action="add_teacher_back.php" method="POST">
	<input type="text" name="t_name" placeholder="Name" required="">
	<input type="text" name="phone_number" placeholder="Phone number" required="">
	<label>Passport size jpeg photo:</label>
	<input type="file" id="photo" name="photo">
	<select id="dept_id" name="dept_id" method="POST">
	<?php
		$sql = "SELECT * FROM dept";
		$sql_query = mysqli_query($con, $sql);
			
		echo "<option value='0'>--Select a department--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["dept_id"] . "'>" . $row["dept_name"] . "</option>";
		}
	?>
	</select>
	<select id="designation" name="designation" method="POST">
		<option value='0'>--Select designation--</option>
		<option value='professor'>Professor</option>
		<option value='associate professor'>Associate professor</option>
		<option value='assistant professor'>Assistant professor</option>
		<option value='lecturer'>Lecturer</option>
	</select>
	<input type="text" name="qualification" placeholder="Qualification" required="">
	<input type="text" name="address" placeholder="Address" required="">
	<input type="text" name="email" placeholder="Email address(optional)">
	<button> Add </button>
</form>
</div>
<?php if(isset($_GET['t_message'])) { ?>
			<div class="message"><?php echo $_GET['t_message']; ?></div>
<?php } ?>

<div class="form">
<h3> Update teacher information</h3>
<form action="update_teacher_back.php" method="POST">
	<select id="t_id" name="t_id" method="POST">
		<?php
			$sql = "SELECT * FROM teacher";
			$sql_query = mysqli_query($con, $sql);
			
			echo "<option value='0'>--Select teacher--</option>";
			if (mysqli_num_rows($sql_query))
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["t_id"] . "'>" . $row["t_id"] . ' | '. $row["t_name"] . "</option>";
			}
		?>
	</select>
	<input type="text" name="new_name" placeholder="New name">
	<label>Update designation:</label>
	<select id="designation" name="designation" method="POST">
		<option value='0'>--Select--</option>
		<option value='professor'>Professor</option>
		<option value='associate professor'>Associate professor</option>
		<option value='assistant professor'>Assistant professor</option>
		<option value='lecturer'>Lecturer</option>
	</select>
	</br></br>
	<input type="text" name="new_qualification" placeholder="Qualification">
	<input type="text" name="new_phone_number" placeholder="New phone number">
	<label>New passport size jpeg photo:</label>
	</br></br>
	<input type="file" id="new_photo" name="new_photo">
	<input type="text" name="new_address" placeholder="New address">
	<input type="text" name="new_email" placeholder="New email">
	<button> Update </button>
</form>
</div>
<?php if(isset($_GET['update_message'])) { ?>
			<div class="message"><?php echo $_GET['update_message']; ?></div>
<?php } ?>

<div class="form">
<h3>Delete teacher</h3>
<form action="delete_teacher_back.php" method="POST">
	<select id="t_id" name="t_id" method="POST">
		<?php
			$sql = "SELECT * FROM teacher";
			$sql_query = mysqli_query($con, $sql);
			
			echo "<option value='0'>----------Select a teacher----------</option>";
			if (mysqli_num_rows($sql_query))
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["t_id"] . "'>" . $row["t_id"] . ' | '. $row["t_name"] . "</option>";
			}
		?>
	</select>
	<button> Delete </button>
</form>
</div>
<?php if(isset($_GET['delete_message'])) { ?>
			<div class="message"><?php echo $_GET['delete_message']; ?></div>
<?php } ?>
</br>

<div class="topic">
<h2>Teacher table</h2>
</div>

<form action="dept_filter_back_for_teachers.php" method="POST">
	<label>Department filter:<label>
	<select id="dept_name" name="dept_name">
	<?php
		$sql = "SELECT * FROM dept";
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value=''>--Select department--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["dept_name"] . "'>" . $row["dept_name"] . "</option>";
		}
	?>
	</select>
	<button> Filter </button>
</form>

<table class="table-style">
	<tr>
	<th> Photo </th>
	<th> Teacher ID </th>
	<th> Name </th>
	<th> Department </th>
	<th> Designation </th>
	<th> Qualification </th>
	<th> Phone number </th>
	<th> Address </th>
	<th> Email address </th>
	</tr>
<?php
	$sql = "SELECT * FROM teacher JOIN dept ON teacher.dept_id=dept.dept_id order by t_id asc";
	if(isset($_GET['dept_filter']))
	{
		$dept_name = $_GET['dept_filter'];
		$sql = "SELECT * FROM teacher JOIN dept ON teacher.dept_id=dept.dept_id WHERE dept_name='$dept_name' order by t_id asc";
	}
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<tr><td><img src='teacher_images/" . $row['photo'] . "' width='120px' height='120px'></td><td>" . $row["t_id"] . "</td><td>" . $row["t_name"] . "</td><td>" . $row["dept_name"] . "</td><td>" . $row["designation"] . "</td><td>" . $row["qualification"] . "</td><td>" . $row["phone_number"] . "</td><td>" . $row["address"] . "</td><td>" . $row["email"] . "</td></tr>";
		}
	}
?>
</table>

	
</body>
</html>