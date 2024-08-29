<!DOCTYPE html>
<html>
<head>
	<title>Course registration</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="course_registartion-style.css">
	<link rel="stylesheet" href="table-style.css">
</head>
<body>
<?php
	require('student_check.php');
	require('check_given_list.php');
?>
<?php if(isset($_GET['reg_message'])) { ?>
			<div class="message"><?php echo $_GET['reg_message']; ?></div>
<?php } ?>
<div class="upper_buttons">
<a href="student_landing.php?s_id=<?php echo $s_id;?>"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="topic">
<h2>Course registration list</h2>
</div>
<?php 
$sql14 = "SELECT * FROM c_r_status WHERE s_id=$s_id";
$sql_query14 = mysqli_query($con, $sql14);

if($row14=mysqli_num_rows($sql_query14)==0) { ?>
<div class="form">
<h3>Add course</h3>

<form action="add_course_on_c_r_list_back.php" method="POST">
	<select id="course_id11" name="course_id11" method="POST">
	<?php
		$sql11 = "SELECT * FROM course_on_c_o_l JOIN course ON course_on_c_o_l.course_id=course.course_id WHERE prog_id=$prog_id ORDER BY course_on_c_o_l.course_id ASC";
		$sql_query11 = mysqli_query($con, $sql11);
			
		echo "<option value='0'>--Select course--</option>";
		if (mysqli_num_rows($sql_query))
		while($row11 = mysqli_fetch_assoc($sql_query11))
		{
			$course_id11 = $row11['course_id'];
			$sql12 = "SELECT * FROM c_r_list WHERE course_id=$course_id11";
			$sql_query12 = mysqli_query($con, $sql12);
			$row12=mysqli_num_rows($sql_query12);
			if($row12) continue;
			
			$sql12 = "SELECT * FROM course WHERE course_id=$course_id11";
			$sql_query12 = mysqli_query($con, $sql12);
			$row12 = mysqli_fetch_assoc($sql_query12);
			$prerequsite = $row12['prerequisite'];
			
			if($prerequsite)
			{
				$sql12 = "SELECT * FROM result WHERE course_id=$course_id11 AND s_id='$s_id'";
				$sql_query12 = mysqli_query($con, $sql12);
				
				$x = 0;
				while($row12 = mysqli_fetch_assoc($sql_query12))
				{
					$x = 0;
					
					$mid_term = $row12['mid_term'];
					$final = $row12['final'];
					$attendance = $row12['attendance'];
					$other = $row12['other'];
					$x = $mid_term+$final+$attendance+$other;
					
					if($x>=40) break;
				}
				
				if($x<40) continue;
			}
			
			echo "<option value='" . $row11["course_id"] . "'>" . $row11["course_code"] . ' | ' . $row11["course_title"] . "</option>";
		}
	?>
	</select>
	<button>Add</button>
</form>
</div>

<?php if(isset($_GET['add_course_message'])) { ?>
			<div class="message"><?php echo $_GET['add_course_message']; ?></div>
<?php } ?>

<div class="form">
<h3>Remove course</h3>
<form action="remove_course_from_c_r_list_back.php" method="POST">
	<select id="course_id13" name="course_id13" method="POST">
	<?php
		$sql13 =  "SELECT * FROM c_r_list JOIN course ON c_r_list.course_id=course.course_id WHERE s_id=$s_id";
		$sql_query13 = mysqli_query($con, $sql13);
			
		echo "<option value='0'>--Select course--</option>";
		
		while($row13 = mysqli_fetch_assoc($sql_query13))
		{	
			echo "<option value='" . $row13["course_id"] . "'>" . $row13["course_code"] . ' | ' . $row13["course_title"] . "</option>";
		}
	?>
	</select>
	<button>Remove</button>
</form>
</div>
<?php if(isset($_GET['remove_course_message'])) { ?>
			<div class="message"><?php echo $_GET['remove_course_message']; ?></div>
<?php } ?>

<div class="buttons">
<?php
	$sql = "SELECT * FROM c_r_reg";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);

	if($found)echo '<a href="register_course_back.php"> Click for course registration </a>';
?>
</div>
<?php } ?>
<?php if(isset($_GET['course_reg_message'])) { ?>
			<div class="message"><?php echo $_GET['course_reg_message']; ?></div>
<?php } ?>

<div class="informations">
<table class="table-style">
<?php
	$sql = "SELECT * FROM c_r_list JOIN course ON c_r_list.course_id=course.course_id WHERE s_id=$s_id";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	$sql5 = "SELECT * FROM c_r_status WHERE s_id=$s_id";
	$sql_query5 = mysqli_query($con, $sql5);
	$found5 = mysqli_num_rows($sql_query5);
	
	if($found5==0) echo "Course registration status: Unregistered";
	else
	{
		$row5=mysqli_fetch_assoc($sql_query5);
		if($row5['status']==0) echo "Course registration status: Pending";
		else echo "Status: Approved";
	}
	
	//if($found5==0)
	{
		//echo "Hello";
		$sql6 = "SELECT * FROM current_session";
		$sql_query6 = mysqli_query($con, $sql6);
		$row6 = mysqli_fetch_assoc($sql_query6);
		$session_name = "summer";
		if($row6['session_id']/2) $session_name = "spring";
		$year = intval($row6['session_id']/10);
		
		$sql6 = "SELECT * FROM student WHERE s_id=$s_id";
		$sql_query6 = mysqli_query($con, $sql6);
		$row6 = mysqli_fetch_assoc($sql_query6);
		//echo "$session_id";
		
		$sql7 = "SELECT * FROM current_session";
		$sql_query7 = mysqli_query($con, $sql7);
		$row7 = mysqli_fetch_assoc($sql_query7);
		
		$sql8 = "SELECT * FROM course_advisor JOIN teacher ON course_advisor.t_id=teacher.t_id WHERE session_id=$session_id AND prog_id=$prog_id";
		$sql_query8 = mysqli_query($con, $sql8);
		
		$advisor = "Not given";
		while($row8 = mysqli_fetch_assoc($sql_query8))
		{
			$advisor = $row8['t_name'];
		}
		
		$sql9 = "SELECT SUM(course.credit) AS total_credit FROM c_r_list JOIN course ON c_r_list.course_id=course.course_id WHERE s_id=$s_id";
		$sql_query9 = mysqli_query($con, $sql9);
		$row9 = mysqli_fetch_assoc($sql_query9);
			
		echo "<tr><th>Current session : " . $session_name . ' ' . $year . "</th><th colspan='2'>Advisor: $advisor </th><th>Total credit : " . $row9["total_credit"] . "</th></tr>";
		echo "<tr>
		<th> Course Code </th>
		<th> Course Title </th>
		<th> Taken by</th>
		<th> Credit </th>
		</tr>";
			
		$sql3 = "SELECT * FROM c_r_list JOIN course ON c_r_list.course_id=course.course_id WHERE s_id=$s_id";
		$sql_query3 = mysqli_query($con, $sql3);
		
		while($row3 = mysqli_fetch_assoc($sql_query3))
		{
			$sql10 = "SELECT * FROM student WHERE s_id=$s_id";
			$sql_query10 = mysqli_query($con, $sql10);
			$row10 = mysqli_fetch_assoc($sql_query10);
			$course_id = $row3['course_id'];
			
			$sql4 = "SELECT * FROM taken JOIN teacher ON taken.t_id=teacher.t_id WHERE prog_id=$prog_id AND course_id=$course_id";
			$sql_query4 = mysqli_query($con, $sql4);
			
			$taken_teacher = "None";
			if($row4 = mysqli_num_rows($sql_query4))
			{
				$row4 = mysqli_fetch_assoc($sql_query4);
				$taken_teacher = $row4["t_name"];
			}
			
			echo "<tr><td>" . $row3["course_code"] . "</td><td>" . $row3["course_title"] . "</td><td> $taken_teacher </td><td>" . $row3["credit"] . "</td></tr>";
		}
	}
?>
</table>
</div>
	
</body>
</html>