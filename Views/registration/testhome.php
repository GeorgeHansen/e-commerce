<?php
session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- user registration form using bootstrap -->
<html>

	<head>
	</head>
	<body>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<p class="col-sm-4">
					<?php if( isset($_SESSION['user_id']) ): ?>

				<br />Welcome <?= $_SESSION['user_id']; ?> 
				<br /><br />You are successfully logged in!
				<br /><br />
				<a href="logout.php">Logout?</a>

			<?php else: ?>

		<h1>Please Login or Register</h1>
		<a href="login.php">Login</a> or
		<a href="register.php">Register</a>

	<?php endif; ?>
						THE IS HOME PAGE WELCOME. </br>
						THE DEMO TEXT .
					</p>
				</div>
			</div>
			
	
	</body>
</html>

