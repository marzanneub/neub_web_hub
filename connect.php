<?php
	$host = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'neub_web_hub';
		
	$con = mysqli_connect($host, $username, $password);
	$selectdb = mysqli_select_db($con, $dbname);
?>