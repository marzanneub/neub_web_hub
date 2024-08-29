<?php
require('admin_check.php');
require('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Notices</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="notice-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>

<div class="upper_buttons">
<a href="admin_landing.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="form2">
<h3> Add notice </h3>
<form action="add_notice_back.php" method="POST">
	<input type="text" name="notice_title" placeholder="Notice title" required="">
	</br><br/>
	<textarea id="notice_details" name="notice_details" style="height: 200px; width: 200px" placeholder="Detalis"></textarea></br><br/>
	<button> Add </button>
</form>
</div>
<?php if(isset($_GET['message'])) { ?>
			<div class="message"><?php echo $_GET['message']; ?></div>
<?php } ?>

<div class="form2">
<h3> Update notice information</h3>
<form action="update_notice_back.php" method="POST">
	<select id="notice_id" name="notice_id" method="POST">
		<?php
			$sql = "SELECT * FROM notice";
			$sql_query = mysqli_query($con, $sql);
					
			echo "<option value=0>--Notice ID--</option>";
			if (mysqli_num_rows($sql_query))
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["notice_id"] . "'>" . $row["notice_id"] . "</option>";
			}
		?>
	</select>
	<input type="text" name="notice_title" placeholder="Notice title">
	</br></br>
	<textarea id="notice_details" name="notice_details" style="height: 200px; width: 200px" placeholder="Detalis"></textarea></br><br/>
	<button> Update </button>
</form>
</div>
<?php if(isset($_GET['update_message'])) { ?>
			<div class="message"><?php echo $_GET['update_message']; ?></div>
<?php } ?>
</br>

<?php if(isset($_GET['delete_message'])) { ?>
			<div class="message"><?php echo $_GET['delete_message']; ?></div>
<?php } ?>
</br>

<div class="topic">
<h2>Notice table</h2>
</div>
<div class="informations">
<form action="delete_notice_back.php" method="POST">
	<label>Delete notice:</label>
	<select id="notice_id" name="notice_id" method="POST">
		<?php
			$sql = "SELECT * FROM notice";
			$sql_query = mysqli_query($con, $sql);
					
			echo "<option value=''>--Notice ID--</option>";
			if (mysqli_num_rows($sql_query))
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["notice_id"] . "'>" . $row["notice_id"] . "</option>";
			}
		?>
	</select>
	<button> Delete </button>
</form>
<table class="table-style">
	<tr>
	<th> Notice ID </th>
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
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<tr><td>" . $row["notice_id"] . "</td><td>" . $row["notice_title"] . "</td><td>" . $row["notice_details"] . "</td><td>" . $row["date"] . "</td></tr>";
		}
	}
?>
</table>
</div>
	
</body>
</html>