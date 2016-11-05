<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- user registration form using bootstrap -->
<html>

	<head>
		<style>
		.error {color: #FF0000;}
		</style>
		
	</head>
	<body>
		
		<form class="form-horizontal" name="testForm" id="testForm" method="post" action="?controller=registration&action=post">
			<div class="form-group">
				<label class="control-label col-sm-2"><h2>Welcome!!!</h2></label>
			</div>

			<p class="col-sm-offset-1">Please, fill in the registration form!</p>

			<div class="form-group">
				<label class="control-label col-sm-2" >Username:</label> 
				<span class="error"> <?php if(isset($userErr)) echo $userErr;?></span>
				<div class="col-xs-3">
					<input type="text" class="form-control" name="user" id="user" >
				</div>
			</div>
				<div class="form-group">
				<label class="control-label col-sm-2">Name:</label> 
				<span class="error"> <?php if(isset($nameErr)) echo $nameErr; ?></span>
				<div class="col-xs-3">
					<input type="text" class="form-control" name="name" id="name" >
				</div>
			</div>
	
			</div>
				<div class="form-group">
				<label class="control-label col-sm-2">Address:</label>
				<span class="error"> <?php if(isset($addressErr)) echo $addressErr;?></span> 
				<div class="col-xs-3">
					<input type="text" class="form-control" name="address" id="address">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Email:</label>
				<span class="error"> <?php if(isset($emailErr)) echo $emailErr;?></span> 
				<div class="col-xs-3">
					<input type="text" class="form-control" name="email" id="email">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Password:</label>
				<span class="error"> <?php if(isset($passwordErr)) echo $passwordErr;?></span>
				<div class="col-xs-3">
					<input type="password" class="form-control" name="password" id="password">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Repeat Password:</label>
				<span class="error" id="pswRepeatErrMsg"> <?php if(isset($passwordRepeatErr)) echo $passwordRepeatErr;?></span>
				<span class="registrationFormAlert error" id="divCheckPasswordMatch"></span> 
				<div class="col-xs-3">
					<input type="password" class="form-control" name="passwordRepeat" id="passwordRepeat">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<p class="col-sm-4">
						Your current ip address will be registered as being "home". </br>
						This can be modified later.
					</p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					  		<input type="submit" class="btn btn-warning" name="submit" id="submit" value="I wish to become a registered user">
				</div>
			</div>
		</form>
	</body>
</html>

<!-- Used to check if the passwords match. -->
<script type="text/javascript">
	$(function() {
		$("#passwordRepeat").keyup(function() {
			var password = $("#password").val();
			$("#divCheckPasswordMatch").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
			$('#pswRepeatErrMsg').hide();
		});

	});
</script>