<!DOCTYPE html>
<html>
<head>
	<title>Teacher account</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="teacher_landing-style.css">
</head>
<body>
<?php
	require('teacher_check.php');
?>
<?php if(isset($_GET['reg_message'])) { ?>
			<div class="message"><?php echo $_GET['reg_message']; ?></div>
<?php } ?>
<a href="index.php"> Back </a>
</br>
<a href="logout.php"> Logout </a>
</br>

	
</body>
</html>