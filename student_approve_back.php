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
	$s_id = $_GET['s_id'];
	
	$sql = "UPDATE student SET approve='1' WHERE s_id='$s_id'";
	$sql_query = mysqli_query($con, $sql);
		
	if($sql_query)
	{
		$message = "Sucessfully approved";
		header("location:student_approval.php?message="  . urlencode($message));
		exit();
	}
	else
	{
		$message = "Error!";
		header("location:student_approval.php?message="  . urlencode($message));
		exit();
	}
	
?>

</body>
</html>