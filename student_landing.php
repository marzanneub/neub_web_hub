<!DOCTYPE html>
<html>
<head>
	<title>Student account</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="student_landing-style.css">
</head>
<body>
<?php
	require('student_check.php');
	$s_id = $_GET['s_id'];
?>
<?php if(isset($_GET['reg_message'])) { ?>
			<div class="message"><?php echo $_GET['reg_message']; ?></div>
<?php } ?>
<a href="index.php"> Back </a>
</br>
<a href="logout.php"> Logout </a>
</br>


<?php
	$sql = "SELECT * FROM student WHERE s_id = $s_id";
	$sql_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($sql_query);
	$imageData = $row['photo'];
	
	echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($imageData).'" >'; 
?>
	
	
</body>
</html>