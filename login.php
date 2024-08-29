<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" href="login-style2.css">
</head>
<body>

<?php
require('auto_login.php');
?>
<div class="upper_buttons">
<a href="index.php"> Back </a>
</div>

<div class="main">
	<div class="login">
		<form action="login_back.php" method="POST">
			<label>Login</label>
			</br></br>
			<input type="text" name="id" placeholder="user id" required="">
			</br></br>
			<input type="password" name="pw" placeholder="password" required="">
			</br></br>
			<button>Login</button>
		</form>
		<?php if(isset($_GET['message'])) { ?>
			<div class="message"><?php echo $_GET['message']; ?></div>
		<?php } ?>
	</div>
</div>
	
</body>
</html>