<!DOCTYPE html>
<html>
<head>
	<title>Course offer list</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="show_course_offer_list_teacher-style2.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
	require('teacher_check.php');
?>
<?php if(isset($_GET['reg_message'])) { ?>
			<div class="message"><?php echo $_GET['reg_message']; ?></div>
<?php } ?>
<div class="upper_buttons">
<a href="teacher_landing.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>
<?php
	$prog_id = $_GET['prog_id'];
	
	$sql = "DELETE FROM current_program";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "INSERT INTO current_program VALUES('$prog_id')";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "SELECT * FROM prog WHERE prog_id=$prog_id";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$dept_id = $row["dept_id"]
?>

<?php
	$sql100 = "SELECT * FROM c_r_reg";
	$sql_query100 = mysqli_query($con, $sql100);
	$found100 = mysqli_num_rows($sql_query100);
	
	if($found100==0){ ?>

<div class="form">
<h3> Update course advisor: </h3>

	<form action="change_course_advisor_back.php?<?php echo"prog_id=$prog_id"; ?>" method="POST">
	<select id="session_id" name="session_id">
	<?php
		$sql = "SELECT * FROM session_on_c_o_l WHERE prog_id=$prog_id  ORDER BY session_id ASC";
		$sql_query = mysqli_query($con, $sql);
			
		echo "<option value=0>--Select a session--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			$session_id2 = $row['session_id'];
			$sql2 = "SELECT * FROM session WHERE session_id = $session_id2";
			$sql_query2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_assoc($sql_query2);
			echo "<option value='" . $row2["session_id"] . "'>" . $row2["session_name"] . ' ' . $row2["year"] . "</option>";
		}
	?>
	</select>
	<select id="t_id2" name="t_id2" method="POST">
    <?php
		$sql = "SELECT * FROM teacher WHERE dept_id=$dept_id";
		$sql_query = mysqli_query($con, $sql);
			
		echo "<option value=0>--Select an advisor--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["t_id"] . "'>" . $row["t_name"] . "</option>";
		}
		echo "<option value=-1>None</option>";
	?>
    </select>
	<button> Update </button>
</form>
</div>

<?php if(isset($_GET['change_advisor_message'])) { ?>
			<div class="message"><?php echo $_GET['change_advisor_message']; ?></div>
<?php } ?>

<div class="form">
<h3> Update course teacher: </h3>
	<form action="change_course_teacher_back.php?<?php echo"prog_id=$prog_id"; ?>" method="POST">
	<select id="session_id3" name="session_id3" method="POST" onchange="course_changeOptions()">
	<?php
		$sql = "SELECT * FROM session_on_c_o_l WHERE prog_id=$prog_id  ORDER BY session_id ASC";
		$sql_query = mysqli_query($con, $sql);
			
		echo "<option value=0>--Select a session--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			$session_id2 = $row['session_id'];
			$sql2 = "SELECT * FROM session WHERE session_id = $session_id2";
			$sql_query2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_assoc($sql_query2);
			echo "<option value='" . $row2["session_id"] . "'>" . $row2["session_name"] . ' ' . $row2["year"] . "</option>";
		}
	?>
	</select>
	<select id="course_id3" name="course_id3">
        <option value="0">--Select a course--</option>
    </select>
	<select id="t_id3" name="t_id3" method="POST">
    <?php
		$sql = "SELECT * FROM teacher WHERE dept_id=$dept_id";
		$sql_query = mysqli_query($con, $sql);
			
		echo "<option value=0>--Select a teacher--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["t_id"] . "'>" . $row["t_name"] . "</option>";
		}
		echo "<option value=-1>None</option>";
	?>
    </select>
	<button> Update </button>
</form>	
</div>

<?php if(isset($_GET['change_teacher_message'])) { ?>
			<div class="message"><?php echo $_GET['change_teacher_message']; ?></div>
<?php } ?>
<?php } ?>

<div class="topic">
<h2>Courses under this program in this semester</h2>
</div>
<div class="informations">
<table class="table-style">
<?php
	$sql = "SELECT * FROM session_on_c_o_l WHERE prog_id=$prog_id ORDER BY session_id ASC";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		while($row = mysqli_fetch_assoc($sql_query))
		{
			$session_id = $row['session_id'];
			$sql2 = "SELECT * FROM session WHERE session_id=$session_id";
			$sql_query2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_assoc($sql_query2);
			
			$sql3 = "SELECT SUM(course.credit) AS total_credit FROM course_on_c_o_l JOIN course ON course_on_c_o_l.course_id=course.course_id WHERE session_id=$session_id AND prog_id=$prog_id";
			$sql_query3 = mysqli_query($con, $sql3);
			$row3 = mysqli_fetch_assoc($sql_query3);
			
			$sql4 = "SELECT * FROM course_advisor WHERE session_id=$session_id AND prog_id=$prog_id";
			$sql_query4 = mysqli_query($con, $sql4);
			$course_advisor = "Not given";
			
			if($row4 = mysqli_num_rows($sql_query4))
			{
				$row4 = mysqli_fetch_assoc($sql_query4);
				$t_id2 = $row4['t_id'];
				
				$sql4 = "SELECT * FROM teacher WHERE t_id=$t_id2";
				$sql_query4 = mysqli_query($con, $sql4);
				$row4 = mysqli_fetch_assoc($sql_query4);
				$course_advisor = $row4['t_name'];
			}
			
			echo "<tr><th colspan='2'>Session : " . $row2["session_name"] . ' ' . $row2["year"] . "</th><th colspan='2'>Advisor: $course_advisor</th><th>Total credit : " . $row3["total_credit"] . "</th></tr>";
			echo "<tr>
			<th> Course ID </th>
			<th> Course Code </th>
			<th> Course Title </th>
			<th> Taken by</th>
			<th> Credit </th>
			</tr>";
			
			$sql3 = "SELECT * FROM course_on_c_o_l JOIN course ON course_on_c_o_l.course_id=course.course_id WHERE session_id=$session_id AND prog_id=$prog_id";
			$sql_query3 = mysqli_query($con, $sql3);
			
			while($row3 = mysqli_fetch_assoc($sql_query3))
			{
				$prog_id4 = $row3["prog_id"];
				$session_id4 = $row3["session_id"];
				$course_id4 = $row3["course_id"];
				
				$sql4 = "SELECT * FROM taken JOIN teacher ON taken.t_id=teacher.t_id WHERE prog_id=$prog_id4 AND session_id=$session_id4 AND course_id=$course_id4";
				$sql_query4 = mysqli_query($con, $sql4);
				
				$taken_teacher = "None";
				if($row4 = mysqli_num_rows($sql_query4))
				{
					$row4 = mysqli_fetch_assoc($sql_query4);
					$taken_teacher = $row4["t_name"];
				}
				
				echo "<tr><td>" . $row3["course_id"] . "</td><td>" . $row3["course_code"] . "</td><td>" . $row3["course_title"] . "</td><td> $taken_teacher </td><td>" . $row3["credit"] . "</td></tr>";
			}
		}
	}
?>
</table>
</div>

<script>
function course_changeOptions()
{
	var session_id3 = document.getElementById("session_id3").value;
	var course_id3 = document.getElementById("course_id3");
	course_id3.innerHTML = "";
    var ajax = new XMLHttpRequest();
	var method = "GET";
	var url = "get_course.php?session_id=" + encodeURIComponent(session_id3);
	var asynchronous = true;
	
	ajax.open(method, url, asynchronous);
	ajax.send();
	ajax.onreadystatechange = function()
	{
		if(this.readyState ==4 && this.status == 200)
		{
			
			var data = JSON.parse(this.responseText);
			
			var option = document.createElement("option");
			option.text = '--Select a course--';
			option.value = 0;
			course_id3.add(option);
			
			for(var i=0; i<data.length; i++)
			{
				var option = document.createElement("option");
				option.text = data[i].course_title;
				option.value = data[i].course_id;
				course_id3.add(option);
			}
		}
	}
}
</script>
	
</body>
</html>