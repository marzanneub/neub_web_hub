<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="register-style.css">
</head>
<body>

<?php
require('auto_login.php');
?>
<div class="upper_buttons">
<a href="index.php"> Back </a>
</div>

<div class="main">
	<div class="register">
		<form action="register_back.php" method="POST">
			<label>Register</label>
			</br></br>
			<select id="prof" name="prof">
				<option value=0>--Select a profession--</option>
				<option value='s'>Student</option>
				<option value='t'>Teacher</option>
			</select>
			</br></br>
			<input type="text" name="id" placeholder="user id" required="">
			</br></br>
			<select id="dept_id" name="dept_id" method="POST">
			<?php
				$sql = "SELECT * FROM dept";
				$sql_query = mysqli_query($con, $sql);
					
				echo "<option value='0'>--Select a department--</option>";
				while($row = mysqli_fetch_assoc($sql_query))
				{
					echo "<option value='" . $row["dept_id"] . "'>" . $row["dept_name"] . "</option>";
				}
			?>
			</select>
			</br></br>
			<input type="text" name="phone_number" placeholder="Phone number" required="">
			</br></br>
			<input type="password" name="pw1" placeholder="Enter password" required="">
			</br></br>
			<input type="password" name="pw2" placeholder="Re-enter password" required="">
			</br></br>
			<button>Register</button>
		</form>
		<?php if(isset($_GET['message'])) { ?>
			<div class="message"><?php echo $_GET['message']; ?></div>
		<?php } ?>
	</div>
</div>
	
</body>
</html>