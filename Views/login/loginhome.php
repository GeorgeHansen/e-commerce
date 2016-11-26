<?php

session_start();
$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));


?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- user registration form using bootstrap -->
<html>

	<head>
		<style>
		.error {color: #FF0000;}
		</style>
		
	</head>
	<body>
		<form class="form-horizontal" name="testForm" id="testForm" method="post" action="?controller=login&action=post">
			<div class="form-group">
				<label class="control-label col-sm-2"><h2>Welcome!!!</h2></label>
			</div>
			<?php if(isset($errors)) print_r($errors) ?>
			<p class="col-sm-offset-1">Login!</p>
			<div class="form-group">
				<label class="control-label col-sm-2" >Username:</label> 
				<span class="error"> <?php if(isset($userErr)) echo $userErr;?></span>
				<div class="col-xs-3">
					<input type="text" class="form-control" name="user_name" id="user_name" >
				</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Password:</label>
				<span class="error"> <?php if(isset($passwordErr)) echo $passwordErr;?></span>
				<div class="col-xs-3">
					<input type="password" class="form-control" name="password" id="password">
				</div>
			</div>
			</div>
			<input type="hidden" name="token" value="<?=$token?>"/>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					  		<input type="submit" class="btn btn-warning" name="submit" id="submit" value="I wish to become a registered user">
				</div>
			</div>
		</form>
	</body>
</html>
</script>