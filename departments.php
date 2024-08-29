<!DOCTYPE html>
<html>
<head>
	<title>Departments</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="departments-style.css">
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
<h3> Add department </h3>
<form action="add_dept_back.php" method="POST">
	<input type="text" name="dept_name" placeholder="Department name" required="">
	<button> Add department </button>
</form>
</div>
<?php if(isset($_GET['dept_message'])) { ?>
			<div class="message"><?php echo $_GET['dept_message']; ?></div>
<?php } ?>

</br>

<div class="form">
<h3> Update department name </h3>
<form action="update_dept_back.php" method="POST">
	<select id="dept_id3" name="dept_id3">
	<?php
		$sql = "SELECT * FROM dept";
		$sql_query = mysqli_query($con, $sql);
		
		echo "<option value='0'>--Select--</option>";
		if (mysqli_num_rows($sql_query))
		{
			while($row = mysqli_fetch_assoc($sql_query))
			{
				echo "<option value='" . $row["dept_id"] . "'>" . $row["dept_name"] . "</option>";
			}
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

<div class="form">
<h3> Update department head </h3>
<form action="update_dept_head_back.php" method="POST">
	<select id="dept_id2" name="dept_id2" method="POST" onchange="prog_changeOptions()">
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
	<select id="t_id2" name="t_id2" method="POST">
        <option value="0">--Select a teacher--</option>
    </select>
	<button> Update </button>
</form>
</div>
<?php if(isset($_GET['update_head_message'])) { ?>
			<div class="message"><?php echo $_GET['update_head_message']; ?></div>
<?php } ?>

<script>
function prog_changeOptions()
{
	var dept_id2 = document.getElementById("dept_id2").value;
	var t_id2 = document.getElementById("t_id2");
	t_id2.innerHTML = "";
    var ajax = new XMLHttpRequest();
	var method = "GET";
	var url = "get_head.php?dept_id=" + encodeURIComponent(dept_id2);
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
			t_id2.add(option);
			
			for(var i=0; i<data.length; i++)
			{
				var option = document.createElement("option");
				option.text = data[i].t_name;
				option.value = data[i].t_id;
				t_id2.add(option);
			}
			
			if(dept_id2>0)
			{
				var option = document.createElement("option");
				option.text = 'None';
				option.value = -1;
				t_id2.add(option);
			}
		}
	}
}

</script>

<div class="form">
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
</div>
<?php if(isset($_GET['delete_message'])) { ?>
			<div class="message"><?php echo $_GET['delete_message']; ?></div>
<?php } ?>

<div class="form">
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
</div>
<?php if(isset($_GET['change_message'])) { ?>
			<div class="message"><?php echo $_GET['change_message']; ?></div>
<?php } ?>

<div class="topic">
<h2>Department Table</h2>
</div>
<div class="informations">
<table class="table-style">
	<tr>
	<th>Department ID</th>
	<th>Department name</th>
	<th>Department head</th>
	<th>Enroll Status</th>
	</tr>
<?php
	$sql = "SELECT * FROM dept";
	$sql_query = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_assoc($sql_query))
	{
		if($row["dept_status"]) $dept_status = "on";
		else $dept_status = "off";
		echo "<tr><td>" . $row["dept_id"] . "</td><td>" . $row["dept_name"] . "</td>";
		
		$dept_id = $row['dept_id'];
		$sql = "SELECT * FROM dept_head WHERE dept_id=$dept_id";
		$sql_query2 = mysqli_query($con, $sql);
		
		if($row2 = mysqli_num_rows($sql_query2))
		{
			$sql = "SELECT * FROM dept_head JOIN teacher ON dept_head.t_id=teacher.t_id WHERE dept_head.dept_id=$dept_id";
			$sql_query3 = mysqli_query($con, $sql);
			
			$row3 = mysqli_fetch_assoc($sql_query3);
			echo "<td>" . $row3["t_name"] . "</td>";
		}
		else echo "<td> None </td>";
		
		echo "<td> $dept_status </td></tr>";
	}
?>
</table>
</div>

	
</body>
</html>