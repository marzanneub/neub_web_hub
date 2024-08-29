<?php
require('admin_check.php');
require('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Students</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="students-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>

<div class="upper_buttons">
<a href="admin_landing.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="form">
<h3> Enroll student </h3>
<form action="add_student_back.php" method="POST">
	<input type="text" name="s_id" placeholder="Student ID" required="">
	<input type="text" name="name" placeholder="Student name" required="">
	<input type="text" name="phone_number" placeholder="Phone number" required="">
	<label>Passport size jpeg photo:</label>
	<input type="file" id="photo" name="photo">
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
	<select id="prog_id" name="prog_id" method="POST" onchange="session_changeOptions()">
        <option value="0">--Select a program--</option>
    </select>
	<select id="session_id" name="session_id">
        <option value="0">--Select a session--</option>
    </select>
	<input type="text" name="address" placeholder="Address" required="">
	<input type="text" name="email" placeholder="Email address(optional)">
	<button> Enroll </button>
</form>
</div>
<?php if(isset($_GET['s_message'])) { ?>
			<div class="message"><?php echo $_GET['s_message']; ?></div>
<?php } ?>

<div class="form">
<h3> Update student information</h3>
<form action="update_student_back.php" method="POST">
	<select id="s_id" name="s_id" method="POST">
		<?php
			$sql = "SELECT * FROM student";
			$sql_query = mysqli_query($con, $sql);
			
			echo "<option value='0'>--Student ID--</option>";
			if (mysqli_num_rows($sql_query))
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["s_id"] . "'>" . $row["s_id"] . "</option>";
			}
		?>
	</select>
	<input type="text" name="new_name" placeholder="New name">
	<input type="text" name="new_phone_number" placeholder="New phone number">
	<label>New passport size jpeg photo:</label>
	<input type="file" id="new_photo" name="new_photo">
	<input type="text" name="new_address" placeholder="New address">
	<input type="text" name="new_email" placeholder="New email">
	<button> Update </button>
</form>
</div>
<?php if(isset($_GET['update_message'])) { ?>
			<div class="message"><?php echo $_GET['update_message']; ?></div>
<?php } ?>
</br>

<div class="form">
<h3>Delete student</h3>
<form action="delete_student_back.php" method="POST">
	<select id="s_id" name="s_id" method="POST">
		<?php
			$sql = "SELECT * FROM student";
			$sql_query = mysqli_query($con, $sql);
			
			echo "<option value='0'>----------Select a student----------</option>";
			if (mysqli_num_rows($sql_query))
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["s_id"] . "'>" . $row["s_id"] . ' | '. $row["name"] . "</option>";
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

function session_changeOptions()
{
	var prog_id = document.getElementById("prog_id").value;
	var session_id = document.getElementById("session_id");
	session_id.innerHTML = "";
    var ajax = new XMLHttpRequest();
	var method = "GET";
	var url = "get_session.php?prog_id=" + encodeURIComponent(prog_id);
	var asynchronous = true;
	
	ajax.open(method, url, asynchronous);
	ajax.send();
	ajax.onreadystatechange = function()
	{
		if(this.readyState ==4 && this.status == 200)
		{
			
			var data = JSON.parse(this.responseText);
			
			var option = document.createElement("option");
			option.text = '--Select a session--';
			option.value = 0;
			session_id.add(option);
			
			for(var i=0; i<data.length; i++)
			{
				var option = document.createElement("option");
				option.text = data[i].session_name + " " + data[i].year;
				option.value = data[i].session_id;
				session_id.add(option);
			}
		}
	}
}


</script>

<div class="topic">
<h2>Student table</h2>
</div>

<table class="table-style">
	<tr>
	<th> Photo </th>
	<th> Student ID </th>
	<th> Name </th>
	<th> Program </th>
	<th> Department </th>
	<th> Session </th>
	<th> Phone number </th>
	<th> Address </th>
	<th> Email address </th>
	</tr>
<?php
	$sql = "SELECT * FROM student JOIN session ON (student.prog_id=session.prog_id AND student.session_id=session.session_id) JOIN prog ON student.prog_id=prog.prog_id JOIN dept ON prog.dept_id=dept.dept_id";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<tr><td><img src='student_images/" . $row['photo'] . "' width='120px' height='120px'></td><td>" . $row["s_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["prog_name"] . "</td><td>" . $row["dept_name"] . "</td><td>" . $row["session_name"] . ' ' . $row["year"] . "</td><td>" . $row["phone_number"] . "</td><td>" . $row["address"] . "</td><td>" . $row["email"] . "</td></tr>";
		}
	}
?>
</table>
	
</body>
</html>