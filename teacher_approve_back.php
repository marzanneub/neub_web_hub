<!DOCTYPE html>
<html>
<head>
	<title>Student approval</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="admin_landing-style.css">
</head>
<body>
<?php
	require('admin_check.php');
?>

<?php
	$t_id = $_GET['t_id'];
	
	$sql = "UPDATE teacher SET approve='1' WHERE t_id='$t_id'";
	$sql_query = mysqli_query($con, $sql);
		
	if($sql_query)
	{
		$message = "Sucessfully approved";
		header("location:teacher_approval.php?message="  . urlencode($message));
		exit();
	}
	else
	{
		$message = "Error!";
		header("location:teacher_approval.php?message="  . urlencode($message));
		exit();
	}
	
?>

</body>
</html>