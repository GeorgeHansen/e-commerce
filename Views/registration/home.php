<!-- it will check if we aer already logedin if yes then it redirect to home page should be implemented to all pages after login -->
<?php
//session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: /");
}

?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- user registration form using bootstrap -->
<html>

<head>
	<style>
	.error {color: #FF0000;}


	body{
		background-color: #f1f1f1;
	}

	.portion{
		background-color: #ffffff;
		padding: 0.01em;
		padding-top: 10px;
		padding-bottom: 10px;
		margin: 10px 0;
		box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
		border-radius: 10px;
	}
	.content {
		overflow: hidden;
	}
	.rating{
		color:#FFA500 ;
	}

	.content img {
		margin-right: 15px;
		float: left;
	}
	img{
		box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
		border-radius: 15px;
	}

	/*Can't get this to work for some reason */
	.review{
		margin-top: 5px;
		margin-bottom: 5px;
	}
	.centerize{
		/*background-color: pink;*/
		margin: 0 auto;
		vertical-align:middle;
	}

	</style>


</head>
<body>
	<div class="container">
		<div class="portion">
			<div class=" ">
				<form class="form-horizontal " name="testForm" id="testForm" method="post" action="?controller=Registration&action=post">
					<div class="form-group centerize">
						<label class="control-label col-sm-2"><h2>Welcome!!!</h2></label>
					</div>
					<?php if(isset($errors)) print_r($errors) ?>
					<p class="col-sm-offset-1">Please, fill in the registration form!</p>
					<div class="form-group">
						<label class="control-label col-sm-2" >Username:</label> 
						<span class="error"> <?php if(isset($userErr)) echo htmlspecialchars($userErr, ENT_QUOTES,'UTF-8');?></span>
						<div class="col-xs-3">
							<input type="text" class="form-control" name="user_name" id="user_name" >
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Name:</label> 
						<span class="error"> <?php if(isset($nameErr)) echo htmlspecialchars($nameErr, ENT_QUOTES,'UTF-8'); ?></span>
						<div class="col-xs-3">
							<input type="text" class="form-control" name="name" id="name" >
						</div>
					</div>


 
				
				<div class="form-group">
					<label class="control-label col-sm-2">Address:</label>
					<span class="error"> <?php if(isset($addressErr)) echo htmlspecialchars($addressErr, ENT_QUOTES,'UTF-8');?></span> 
					<div class="col-xs-3">
						<input type="text" class="form-control" name="address" id="address">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Email:</label>
					<span class="error"> <?php if(isset($emailErr)) echo htmlspecialchars($emailErr, ENT_QUOTES,'UTF-8');?></span> 
					<div class="col-xs-3">
						<input type="text" class="form-control" name="email" id="email">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Password:</label>
					<span class="error"> <?php if(isset($passwordErr)) echo htmlspecialchars($passwordErr, ENT_QUOTES,'UTF-8');?></span>
					<div class="col-xs-3">
						<input type="password" class="form-control" name="password" id="password">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Repeat Password:</label>
					<span class="error" id="pswRepeatErrMsg"> <?php if(isset($passwordRepeatErr)) echo htmlspecialchars($passwordRepeatErr, ENT_QUOTES,'UTF-8');?></span>
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
		</div>
	</div>
</div>

</body>
</html>

<!-- Used to check if the passwords match. TODO: change color to green if they do match -->
<script type="text/javascript">
$(function() {
	$("#passwordRepeat").keyup(function() {
		var password = $("#password").val();
		$("#divCheckPasswordMatch").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
		$('#pswRepeatErrMsg').hide();
	});

});
</script>
