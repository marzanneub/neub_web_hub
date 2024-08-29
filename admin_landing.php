<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="admin_landing-style2.css">
</head>
<body>
<?php
	require('admin_check.php');
?>
<div class="upper_buttons">
<a href="index.php"> Back </a>
<a href="logout.php"> Logout </a>
</div>

<div class="buttons">
<a href="departments.php"> Departments </a>
</br>
<a href="programs.php"> Programs </a>
</br>
<a href="sessions.php"> Sessions </a>
</br>
<a href="students.php"> Students </a>
</br>
<a href="student_approval.php"> Registration approval for students </a>
</br>
<a href="teachers.php"> Teachers </a>
</br>
<a href="teacher_approval.php"> Registration approval for teachers </a>
</br>
<a href="course_offer_list.php"> Course offer lists </a>
</br>
<a href="notice.php"> Notices </a>
<div class="buttons">
	
</body>
</html>