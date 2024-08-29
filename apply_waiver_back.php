<?php
	require('connect.php');
	require('student_check.php');
?>
<?php
	$waiver_application = $_POST['waiver_application'];
	echo $s_id;
	
	$sql = 	"SELECT * FROM apply_waiver WHERE s_id='$s_id' AND apply_waiver.grant='0' AND apply_waiver.reject='0'";
	$sql_query = mysqli_query($con, $sql);
	$found = mysqli_num_rows($sql_query);
	
	if($found)
	{
		$waiver_message="Your another waiver application is pending, so you cannot apply until got its response!";
		header("location:course_registartion.php?waiver_message=$waiver_message&s_id=$s_id");
		exit();
	}
	
	$sql = 	"INSERT INTO apply_waiver VALUES('$s_id', '$waiver_application', 0, 0)";
	$sql_query = mysqli_query($con, $sql);
	
	if($sql_query)
	{
		$waiver_message="Your waiver application is pending";
		header("location:course_registartion.php?waiver_message=$waiver_message&s_id=$s_id");
		exit();
	}
	else
	{
		$waiver_message="Error!";
		header("location:course_registartion.php?waiver_message=$waiver_message&s_id=$s_id");
		exit();
	}
?>