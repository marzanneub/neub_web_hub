<?php
require('connect.php');

	$sql = "UPDATE admin SET login='0' WHERE login='1'";
	$sql_query = mysqli_query($con, $sql);
	
	$sql = "UPDATE student SET login='0' WHERE login='1'";
	$sql_query = mysqli_query($con, $sql);
	header("Location: index.php");
	
	$sql = "UPDATE teacher SET login='0' WHERE login='1'";
	$sql_query = mysqli_query($con, $sql);
	header("Location: index.php");

?>