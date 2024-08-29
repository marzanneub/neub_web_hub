<!DOCTYPE html>
<html>
<head>
	<title>Programs</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="programs-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
require('admin_check.php');
require('connect.php');
?>

<div class="upper_buttons">
<a href="admin_landing.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="form">
<h3> Add program </h3>
<form action="add_prog_back.php" method="POST">
	<select id="dept_id" name="dept_name" method="POST">
		<?php
			$sql = "SELECT * FROM dept";
			$sql_query = mysqli_query($con, $sql);
			
			echo "<option value=''>--Select department--</option>";
			if (mysqli_num_rows($sql_query))
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["dept_name"] . "'>" . $row["dept_name"] . "</option>";
			}
		?>
	</select>
	<input type="text" name="prog_name" placeholder="Program name" required="">
	<button>Add program</button>
</form>
</div>

<?php if(isset($_GET['prog_message'])) { ?>
			<div class="message"><?php echo $_GET['prog_message']; ?></div>
<?php } ?>
</br>

<div class="form">
<h3> Update program name </h3>
<form action="update_prog_back.php" method="POST">
	<select id="prog_id" name="prog_id">
	<?php
		$sql = "SELECT * FROM prog JOIN dept ON prog.dept_id=dept.dept_id";;
		if(isset($_GET['dept_filter']))
		{
			$dept_name = $_GET['dept_filter'];
			$sql = "SELECT * FROM (prog JOIN dept ON prog.dept_id=dept.dept_id) WHERE dept_name='$dept_name'";
		}
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value=''>--Program id--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["prog_id"] . "'>" . $row["prog_id"] . "</option>";
		}
	?>
	</select>
	<input type="text" name="new_name" placeholder="New name" required="">
	<button> Update </button>
</form>
</div>
<?php if(isset($_GET['update_message'])) { ?>
			<div class="message"><?php echo $_GET['update_message']; ?></div>
<?php } ?>
</br>

<div class="form">
<h3> Delete program </h3>
<form action="delete_prog_back.php" method="POST">
	<select id="prog_id" name="prog_id">
	<?php
		$sql = $sql = "SELECT * FROM prog JOIN dept ON prog.dept_id=dept.dept_id";;
		if(isset($_GET['dept_filter']))
		{
			$dept_name = $_GET['dept_filter'];
			$sql = "SELECT * FROM (prog JOIN dept ON prog.dept_id=dept.dept_id) WHERE dept_name='$dept_name'";
		}
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value=''>--Program id--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["prog_id"] . "'>" . $row["prog_id"] . "</option>";
		}
	?>
	</select>
	<button> Delete </button>
</form>
</div>
<?php if(isset($_GET['delete_message'])) { ?>
			<div class="message"><?php echo $_GET['delete_message']; ?></div>
<?php } ?>

<div class="form">
<h3> Change enroll status </h3>
<form action="change_prog_enroll_back.php" method="POST">
	<select id="prog_id" name="prog_id">
	<?php
		$sql = $sql = "SELECT * FROM prog JOIN dept ON prog.dept_id=dept.dept_id";;
		if(isset($_GET['dept_filter']))
		{
			$dept_name = $_GET['dept_filter'];
			$sql = "SELECT * FROM (prog JOIN dept ON prog.dept_id=dept.dept_id) WHERE dept_name='$dept_name'";
		}
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value=''>--Program id--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["prog_id"] . "'>" . $row["prog_id"] . "</option>";
		}
	?>
	</select>
	<button> change </button>
</form>
</div>
<?php if(isset($_GET['change_message'])) { ?>
			<div class="message"><?php echo $_GET['change_message']; ?></div>
<?php } ?>

<div class="topic">
<h2>Program Table</h2>
</div>

<div class="informations">
<form action="dept_filter_back.php" method="POST">
	<label> Department name: <label>
	<select id="dept_name" name="dept_name">
	<?php
		$sql = "SELECT * FROM dept";
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value=''>--Select--</option>";
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
	<th>Program ID</th>
	<th>Program name</th>
	<th>Department name</th>
	<th>Status</th>
	<th>Details</th>
	</tr>
<?php
	$sql = "SELECT * FROM prog JOIN dept ON prog.dept_id=dept.dept_id";
	if(isset($_GET['dept_filter']))
	{
		$dept_name = $_GET['dept_filter'];
		$sql = "SELECT * FROM (prog JOIN dept ON prog.dept_id=dept.dept_id) WHERE dept_name='$dept_name'";
	}
	$sql_query = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$prog_id = $row["prog_id"];
		if($row["prog_status"]) $prog_status = "on";
		else $prog_status = "off";
		echo "<tr><td>" . $row["prog_id"] . "</td><td>" . $row["prog_name"] . "</td><td>" . $row["dept_name"] . "</td><td> $prog_status </td><td><a href='show_program.php?prog_id=$prog_id'> Show details</a></td></tr>";
	}
?>
</table>
</div>

	
</body>
</html>