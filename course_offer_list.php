<?php
require('admin_check.php');
require('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Course offer list</title>
	<link rel="icon" href="images/logo.png">
</head>
<body>
<a href="admin_landing.php"> Back </a>
</br>
<a href="logout.php"> Logout </a>
</br>

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
<?php if(isset($_GET['s_message'])) { ?>
			<div class="message"><?php echo $_GET['s_message']; ?></div>
<?php } ?>

<h3> Remove program </h3>
<form action="remove_prog_from_c_o_l_back.php" method="POST">
	<select id="prog_id2" name="prog_id2" method="POST">
	<?php
		$sql = "SELECT * FROM c_o_l JOIN prog ON c_o_l.prog_id=prog.prog_id JOIN dept ON prog.dept_id=dept.dept_id";
		$sql_query = mysqli_query($con, $sql);
			
		echo "<option value='0'>--Select a department--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["prog_id"] . "'>" . $row["prog_name"] . ' in ' . $row["dept_name"] . "</option>";
		}
	?>
	</select>
	<button> remove </button>
</form>
<?php if(isset($_GET['remove_message'])) { ?>
			<div class="message"><?php echo $_GET['remove_message']; ?></div>
<?php } ?>

</br></br>
<form action="end_semester.php" method="POST">
	<label> End this semester : </label>
	<button> Click here </button>
</form>
<?php if(isset($_GET['end_message'])) { ?>
			<div class="message"><?php echo $_GET['end_message']; ?></div>
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

<h2>Offered table</h2>

<table>
	<tr>
	<th> Program </th>
	<th> Department </th>
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
			echo "<tr><td>" . $row['prog_name'] . "</td><td>" . $row['dept_name'] . "</td><td><a href='show_course_offer_list.php?prog_id=$prog_id'> Show list</a></td></tr>";
		}
	}
?>
</table>



	
</body>
</html>