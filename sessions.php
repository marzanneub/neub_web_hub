<!DOCTYPE html>
<html>
<head>
	<title>Sessions</title>
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

<h3> Make session </h3>
<form action="add_session_back.php" method="POST">
	<select name="session_name" method="POST">
        <option value="spring">Spring</option>
        <option value="summer">Summer</option>
    </select>
	<input type="text" name="year" placeholder="Year" required="">
	<button> Make </button>
</form>
<?php if(isset($_GET['session_message'])) { ?>
			<div class="message"><?php echo $_GET['session_message']; ?></div>
<?php } ?>

</br>

<h2>Session Table</h2>
<table>
	<tr>
	<th>Session ID</th>
	<th>Session name</th>
	<th>Year</th>
	</tr>
<?php
	$sql = "SELECT DISTINCT session_id FROM session";
	$sql_query = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_assoc($sql_query))
	{
		$session_id = $row['session_id'];
		$sql2 = "SELECT * FROM session WHERE session_id=$session_id";
		$sql_query2 = mysqli_query($con, $sql2);
		$row2 = mysqli_fetch_assoc($sql_query2);
		
		echo "<tr><td>" . $row2["session_id"] . "</td><td>" . $row2["session_name"] . "</td><td>" . $row2["year"] . "</td><td><a href='show_session.php?session_id=$session_id'> Show details</a></td></tr>";
	}
?>
</table>

	
</body>
</html>