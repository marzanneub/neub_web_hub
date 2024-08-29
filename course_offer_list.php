<?php
require('admin_check.php');
require('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Course offer list</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="course_offer_list-style2.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<div class="upper_buttons">
<a href="admin_landing.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<?php
	$sql = "SELECT * FROM c_r_reg";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found==0){ ?>
<div class="form">
<h3> Add program </h3>
<form action="add_prog_on_c_o_l_back.php" method="POST">
	<select id="dept_id" name="dept_id" method="POST" onchange="prog_changeOptions()">
	<?php
		$sql = "SELECT * FROM dept WHERE dept.dept_status='1'";
		$sql_query = mysqli_query($con, $sql);
			
		echo "<option value='0'>--Select a department--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["dept_id"] . "'>" . $row["dept_name"] . "</option>";
		}
	?>
	</select>
	<select id="prog_id" name="prog_id" method="POST">
        <option value="0">--Select a program--</option>
    </select>
	<button> Add </button>
</form>
</div>
<?php if(isset($_GET['s_message'])) { ?>
			<div class="message"><?php echo $_GET['s_message']; ?></div>
<?php } ?>

<div class="form">
<h3> Remove program </h3>
<form action="remove_prog_from_c_o_l_back.php" method="POST">
	<select id="prog_id2" name="prog_id2" method="POST">
	<?php
		$sql = "SELECT * FROM c_o_l JOIN prog ON c_o_l.prog_id=prog.prog_id JOIN dept ON prog.dept_id=dept.dept_id";
		$sql_query = mysqli_query($con, $sql);
			
		echo "<option value='0'>--Select a program--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["prog_id"] . "'>" . $row["prog_name"] . ' in ' . $row["dept_name"] . "</option>";
		}
	?>
	</select>
	<button> remove </button>
</form>
</div>
<?php if(isset($_GET['remove_message'])) { ?>
			<div class="message"><?php echo $_GET['remove_message']; ?></div>
<?php } ?>
<?php } ?>

<?php
	$sql = "SELECT * FROM current_session";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	
	if($row['session_id']%2) echo "Current session is: spring ", intval($row['session_id']/10);
	else echo "Current session is: summer ", intval($row['session_id']/10);
?>
</br>
<div class="on_off">
<form action="end_semester_back.php" method="POST">
	<label> End this semester : </label>
	<button> Click here </button>
</form>
<?php
	$sql = "SELECT * FROM c_r_reg";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found==0){ ?>
	<form action="start_course_registration_back.php" method="POST">
		<label> Start course registration : </label>
		<button> Click here </button>
	</form>
<?php } ?>
<?php 
	$sql10 = "SELECT * FROM current_session";
	$sql_query10 = mysqli_query($con, $sql10);
	$row10 = mysqli_fetch_assoc($sql_query10);

	$session_id10 = $row['session_id'];
	
	$sql11 = "SELECT * FROM make_result_sheet WHERE session_id=$session_id10";
	$sql_query11 = mysqli_query($con, $sql11);
	$row11 = mysqli_num_rows($sql_query11);

	if(!$row11) { ?>
	<form action="make_result_sheet_back.php" method="POST">
		<label> Make result sheet for this session : </label>
		<button> Click here </button>
	</form>
<?php } ?>

<?php

	$sql12 = "SELECT * FROM make_result_sheet WHERE publish='0'";
	$sql_query12 = mysqli_query($con, $sql12);
	$row12 = mysqli_num_rows($sql_query12);

	if($row12) { ?>
	<form action="publish_result_back.php" method="POST">
		<label> Publish result : </label>
		<button> Click here </button>
	</form>
</div>
<?php } ?>

<?php if(isset($_GET['end_message'])) { ?>
			<div class="message"><?php echo $_GET['end_message']; ?></div>
<?php } ?>
<?php if(isset($_GET['make_message'])) { ?>
			<div class="message"><?php echo $_GET['make_message']; ?></div>
<?php } ?>
<?php if(isset($_GET['publish_message'])) { ?>
			<div class="message"><?php echo $_GET['publish_message']; ?></div>
<?php } ?>






<script>
function prog_changeOptions()
{
	var dept_id = document.getElementById("dept_id").value;
	var prog_id = document.getElementById("prog_id");
	prog_id.innerHTML = "";
	var option = document.createElement("option");
	option.text = '--Select a program--';
	option.value = 0;
	prog_id.add(option);
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

<div class="topic">
<h2>Offered table</h2>
</div>

<div class="informations">
<table class="table-style">
	<tr>
	<th> Program </th>
	<th> Department </th>
	<th></th>
	</tr>
<?php
	$sql = "SELECT * FROM c_o_l JOIN prog ON c_o_l.prog_id=prog.prog_id JOIN dept ON prog.dept_id=dept.dept_id";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		while($row = mysqli_fetch_assoc($sql_query))
		{
			$prog_id = $row['prog_id'];
			echo "<tr><td>" . $row['prog_name'] . "</td><td>" . $row['dept_name'] . "</td><td><a href='show_course_offer_list_admin.php?prog_id=$prog_id'> Show list</a></td></tr>";
		}
	}
?>
</table>
</div>
	
</body>
</html>