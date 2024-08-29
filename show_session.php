<!DOCTYPE html>
<html>
<head>
	<title>Session detalis</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="show_sessions-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
require('admin_check.php');
require('connect.php');
?>

<?php
	$session_id = $_GET['session_id'];
	/*$sql = "SELECT * FROM session WHERE sessi='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$syllabus_id = $row['syllabus_id'];*/
?>

<div class="upper_buttons">
<a href="sessions.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="form">
<h3>Add program on this session</h3>
<form action="add_prog_on_session_back.php" method="POST">
	<select id="dept_id" name="dept_id" method="POST" onchange="prog_changeOptions()">
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
	<select id="prog_id" name="prog_id" method="POST">
        <option value=0>--Select a program--</option>
	</select>
	<input type="hidden" id="session_id" name="session_id" value="<?php echo $session_id ?>">
	<button>Add</button>
</form>
</div>
<script>
function prog_changeOptions()
{
	var dept_id = document.getElementById("dept_id").value;
	var prog_id = document.getElementById("prog_id");
	prog_id.innerHTML = "";
    var ajax = new XMLHttpRequest();
	var method = "GET";
	var url = "get_prog.php?dept_id=" + encodeURIComponent(dept_id);
	var asynchronous = true;
	
	ajax.open(method, url, asynchronous);
	ajax.send();
	ajax.onreadystatechange = function()
	{
		if(this.readyState ==4 && this.status == 200)
		{
			
			var data = JSON.parse(this.responseText);
			
			var option = document.createElement("option");
			option.text = '--Select a program--';
			option.value = 0;
			prog_id.add(option);
			
			for(var i=0; i<data.length; i++)
			{
				var option = document.createElement("option");
				option.text = data[i].prog_name;
				option.value = data[i].prog_id;
				prog_id.add(option);
			}
		}
	}
}
</script>
<?php if(isset($_GET['prog_message'])) { ?>
			<div class="message"><?php echo $_GET['prog_message']; ?></div>
<?php } ?>

<div class="form">
<h3> Remove program from session: </h3>
<form action="remove_prog_from_session_back.php" method="POST">
	<select id="prog_id" name="prog_id">
	<?php
		$sql = $sql = "SELECT * FROM session WHERE session_id='$session_id'";
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value=0>--Program id--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["prog_id"] . "'>" . $row["prog_id"] . "</option>";
		}
	?>
	<input type="hidden" id ="session_id" name="session_id" value="<?php echo $session_id?>">
	</select>
	<button> Remove </button>
</form>
</div>
<?php if(isset($_GET['remove_message'])) { ?>
			<div class="message"><?php echo $_GET['remove_message']; ?></div>
<?php } ?>

<div class="topic">
<h2>Programs under this session</h2>
</div>

<div class="informations">
<table class="table-style">
	<tr>
	<th> Program ID </th>
	<th> Program name </th>
	<th> Department name </th>
	<th> Completed credit </th>
	</tr>
<?php
	$sql = "SELECT * FROM session JOIN prog ON session.prog_id=prog.prog_id JOIN dept ON prog.dept_id=dept.dept_id WHERE session.session_id='$session_id'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	while($row = mysqli_fetch_assoc($sql_query))
	{	
		echo "<tr><td>" . $row["prog_id"] . "</td><td>" . $row["prog_name"] . "</td><td>" . $row["dept_name"] . "</td><td>" . $row["completed_credit"] . "</td></tr>";
	}
?>
</table>
</div>
	
</body>
</html>