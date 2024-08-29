<?php
require('admin_check.php');
require('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Course offer list</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="show_course_offer_list_admin-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<div class="upper_buttons">
<a href="course_offer_list.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>
<?php
	$prog_id = $_GET['prog_id'];
?>

<?php
	$sql = "SELECT SUM(course.credit) AS total_credit FROM prog JOIN syllabus ON prog.prog_id=syllabus.prog_id JOIN course ON syllabus.syllabus_id=course.syllabus_id WHERE prog.prog_id='$prog_id'";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$total_credit = $row['total_credit']; 
?>

<?php
	$sql = "SELECT * FROM c_r_reg";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found==0){ ?>

<div class="form">
<h3> Add session </h3>
<form action="add_session_on_c_o_l_back.php" method="POST">
	<select id="session_id" name="session_id" method="POST"">
	<?php
	
		$sql = "SELECT * FROM session WHERE prog_id=$prog_id ORDER BY session_id ASC";
		$sql_query = mysqli_query($con, $sql);
		
		$sql4 = "SELECT * FROM current_session";
		$sql_query4 = mysqli_query($con, $sql4);
		$row4 = mysqli_fetch_assoc($sql_query4);
		
			
		echo "<option value='0'>--Select a session--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			$session_id5=$row["session_id"];
			if($session_id5>$row4["session_id"]) continue;
			
			$sql3 = "SELECT * FROM completed_session WHERE prog_id=$prog_id AND session_id=$session_id5";
			$sql_query3 = mysqli_query($con, $sql3);
			
			if($row["completed_credit"]>=$total_credit) continue;
			/*
			if($row3 = mysqli_num_rows($sql_query3)) continue;
			else if($row["completed_credit"]>=$total_credit)
			{
				$sql3 = "INSERT INTO completed_session WHERE VALUES ('$prog_id', '$session_id5')";
				$sql_query3 = mysqli_query($con, $sql3);
				
				continue;
			}*/
			
			$sql2 = "SELECT * FROM session_on_c_o_l WHERE prog_id=$prog_id AND session_id=$session_id5";
			$sql_query2 = mysqli_query($con, $sql2);
			$found = mysqli_num_rows($sql_query2);
			if($found) continue;
			
			echo "<option value='" . $row["session_id"] . "'>" . $row["session_name"] . ' '  . $row["year"] . "</option>";
		}
	?>
	</select>
	<input type="hidden" name="prog_id" value="<?php echo "$prog_id";?>">
	<button> Add </button>
</form>
</div>
<?php if(isset($_GET['s_message'])) { ?>
			<div class="message"><?php echo $_GET['s_message']; ?></div>
<?php } ?>

<div class="form">
<h3> Remove session </h3>
<form action="remove_session_from_c_o_l_back.php" method="POST">
	<select id="session_id4" name="session_id4" method="POST"">
	<?php
	
		$sql = "SELECT * FROM session_on_c_o_l JOIN session ON session_on_c_o_l.session_id=session.session_id AND session_on_c_o_l.prog_id=session.prog_id WHERE session.prog_id=$prog_id ORDER BY session.session_id ASC";
		$sql_query = mysqli_query($con, $sql);
			
		echo "<option value='0'>--Select a session--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			echo "<option value='" . $row["session_id"] . "'>" . $row["session_name"] . ' '  . $row["year"] . "</option>";
		}
	?>
	</select>
	<input type="hidden" name="prog_id" value="<?php echo "$prog_id";?>">
	<button> Remove </button>
</form>
</div>
<?php if(isset($_GET['s_remove_message'])) { ?>
			<div class="message"><?php echo $_GET['s_remove_message']; ?></div>
<?php } ?>

<div class="form">
<h3> Add course on session </h3>
<form action="add_course_on_c_o_l_back.php" method="POST">
	<select id="session_id2" name="session_id2" method="POST" onchange="c_o_l_change_course()">
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
	<select id="course_id" name="course_id" method="POST">
        <option value=0>--Select a course--</option>
    </select>
	<input type="hidden" name="prog_id" value="<?php echo "$prog_id";?>">
	<button> Add </button>
</form>
</div>
<?php if(isset($_GET['add_course_message'])) { ?>
			<div class="message"><?php echo $_GET['add_course_message']; ?></div>
<?php } ?>

<div class="form">
<h3> Remove course from session </h3>
<form action="remove_course_from_c_o_l_back.php" method="POST">
	<select id="session_id3" name="session_id3" method="POST" onchange="c_o_l_change_course3()">
	<?php
		$sql = "SELECT * FROM session_on_c_o_l WHERE prog_id=$prog_id ORDER BY session_id ASC";
		$sql_query = mysqli_query($con, $sql);
			
		echo "<option value=0>--Select a session--</option>";
		while($row = mysqli_fetch_assoc($sql_query))
		{
			$session_id3 = $row['session_id'];
			$sql2 = "SELECT * FROM session WHERE session_id = $session_id3";
			$sql_query2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_assoc($sql_query2);
			echo "<option value='" . $row2["session_id"] . "'>" . $row2["session_name"] . ' ' . $row2["year"] . "</option>";
		}
	?>
	</select>
	<select id="course_id3" name="course_id3" method="POST">
        <option value=0>--Select a course--</option>
    </select>
	<input type="hidden" name="prog_id" value="<?php echo "$prog_id";?>">
	<button> Remove </button>
</form>
</div>
<?php if(isset($_GET['remove_course_message'])) { ?>
			<div class="message"><?php echo $_GET['remove_course_message']; ?></div>
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
function c_o_l_change_course()
{
	var session_id2 = document.getElementById("session_id2").value;
	var urlParams = new URLSearchParams(window.location.search);
    var prog_id = urlParams.get('prog_id');
	var course_id = document.getElementById("course_id");
	course_id.innerHTML = "";
	
	var option = document.createElement("option");
	option.text = '--Select a course--';
	option.value = 0;
	course_id.add(option);
	
    var ajax = new XMLHttpRequest();
	var method = "GET";
	var url = "get_c_o_l_course.php?session_id2=" + encodeURIComponent(session_id2) + "&prog_id=" + encodeURIComponent(prog_id);
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
				option.text = data[i].course_code + " | " + data[i].course_title;
				option.value = data[i].course_id;
				course_id.add(option);
			}
		}
	}
}

function c_o_l_change_course3()
{
	var session_id3 = document.getElementById("session_id3").value;
	var urlParams = new URLSearchParams(window.location.search);
    var prog_id = urlParams.get('prog_id');
	var course_id3 = document.getElementById("course_id3");
	course_id3.innerHTML = "";
	
	var option = document.createElement("option");
	option.text = '--Select a course--';
	option.value = 0;
	course_id3.add(option);
	
    var ajax = new XMLHttpRequest();
	var method = "GET";
	var url = "get_c_o_l_course_remove.php?session_id3=" + encodeURIComponent(session_id3) + "&prog_id=" + encodeURIComponent(prog_id);
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
				option.text = data[i].course_code + " | " + data[i].course_title;
				option.value = data[i].course_id;
				course_id3.add(option);
			}
		}
	}
}

</script>

</body>
</html>