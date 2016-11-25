<?php

session_start();

// if( isset($_SESSION['user_id']) ){
// 	header("Location: /");
// }

//require 'database.php';
require 'userCheck.php';

if(!empty($_POST['user']) && !empty($_POST['password']))
{
    $cr = new CheckUser();
	$cr->IfUserexists($_POST['user'], $_POST['password']);
}
	else{
		echo('not ture');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login </title>
</head>
<body>

	<div class="header">
	</div>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Login</h1>

	<form action="login.php" method="POST">
		
		<input type="text" placeholder="username" name="user">
		<input type="password" placeholder="password" name="password">

		<input type="submit">

	</form>

</body>
</html>