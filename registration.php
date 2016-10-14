<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php 

/* ================================= Validation =============================================== */
// Server side validation for registration fields


$userErr = $nameErr = $addressErr = $passwordErr = $emailErr = $passwordRepeatErr = "";
$user = $name =  $address = $password = $email =  $passwordRepeat = "";

$userIsValid = $nameIsValid = $passIsValid = $passRepeatIsValid = $emailIsValid =  $addressIsValid =  false;



if (empty($_POST["user"])) {
	$userErr = "Username is required";
}
else{
	$user = test_input($_POST["user"]);
	// check if username only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z0-9]*$/ ", $user)) {
		$userErr = "Only letters and numbers are allowed";
	}
	else{
		//validation passes
		$userIsValid = true;
		
	}
}
if (empty($_POST["name"])) {
	$nameErr = "Name is required";
} else {
	$name = test_input($_POST["name"]);
// check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/ ", $name)) {
		$nameErr = "Only letters and white space allowed";
	}
	else{
		
		//validation passes
		$nameIsValid = true;
	}
}
if (empty($_POST["address"])) {
	$addressErr = "Address is required";
} else {
	$address = test_input($_POST["address"]);

	//validation passes
	$addressIsValid = true;
}

if (empty($_POST["password"])) {
	$passwordErr = "Password is required";
} else {
	$password = test_input($_POST["password"]);
// check if password is well-formed
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);

	if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
		$passwordErr = "Invalid password format";
	}
	else{

		//password validation passes
		$passIsValid = true;
	}
}
if(empty($_POST["passwordRepeat"])){
	$passwordRepeatErr = "Password repeat is required";
}
else{
	if(($_POST["passwordRepeat"]) != ($_POST["password"]))
	{

		$passwordRepeatErr = "Passwords do not match";
		
	}
	else{
		$passwordRepeat = test_input($_POST["passwordRepeat"]);
		$passRepeatIsValid = true;
	}	
}
if(empty($_POST["email"]))
{
	$emailErr = "Email is required";
}
else
{
	$email = test_input($_POST["email"]);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$emailErr = "Invalid email format";
	}
	else{
		$emailIsValid = true;
		
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


// echo "<h2>Your Input:</h2>";

// echo $user;
// echo "<br>";
// echo $name;
// echo "<br>";
// echo $address;
// echo "<br>";
// echo $email;
// echo "<br>";
// echo $password;
// echo "<br>";
// echo $passwordRepeat;
// echo "<br>";




// Password hashing

if($nameIsValid === true && $passIsValid === true 
	&& $passRepeatIsValid === true && $emailIsValid === true
	&& $userIsValid === true && $addressIsValid == true)
{
	$hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
	// echo $hashedPassword;

	$servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "websec01";

	$conn = new mysqli($servername, $username, $password, $dbname);

	
	// mysql_insert_id()
	$user = $_POST["user"];
	$email = $_POST["email"];
	$address = $_POST["address"];
	$name = $_POST["name"];

	$sqlCheckEmail = "SELECT email FROM userinformation where email='$email'";
	$checkEmailResult = $conn->query($sqlCheckEmail);
	$sqlCheckUser = "SELECT user_name FROM users where user_name='$user'";
	$checkUserResult=$conn->query($sqlCheckUser);

	if($checkUserResult)
	{
		if($checkUserResult->num_rows === 0)
		{
			if($checkEmailResult)
			{
				if($checkEmailResult->num_rows === 0)
				{
					echo '<p style="color:green;">The data is being saved</p>';
				}
				else{
					echo '<p style="color:red;">Email already exists</p>';
				}

			}
		}
		else
		{
			echo '<p style="color:red;">Username already exists</p>';
		}
	}

	$sql = "INSERT INTO users (user_name,user_password,user_role) values ('$user', '$hashedPassword', 1)";
	//$result = $conn->query($sql);

	//checks if query was succesfull and fetches ID if it was.
	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
		$sql2 = "INSERT INTO userinformation(userid, email,address,name)
		values ('$last_id', '$email', '$address', '$name')";
		$conn->query($sql2);
		// echo "New record created successfully. Last inserted ID is: " . $last_id;
	} else {
		// echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
}




?>

<!-- user registration form using bootstrap -->
<html>

	<head>
		<style>
		.error {color: #FF0000;}
		</style>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		
		<form class="form-horizontal" name="testForm" id="testForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="form-group">
				<label class="control-label col-sm-2"><h2>Welcome!!!</h2></label>
			</div>

			<p class="col-sm-offset-1">Please, fill in the registration form!</p>

			<div class="form-group">
				<label class="control-label col-sm-2" >Username:</label> 
				<span class="error"> <?php echo $userErr;?></span>
				<div class="col-xs-3">
					<input type="text" class="form-control" name="user" id="user" >
				</div>
			</div>
				<div class="form-group">
				<label class="control-label col-sm-2">Name:</label> 
				<span class="error"> <?php echo $nameErr;?></span>
				<div class="col-xs-3">
					<input type="text" class="form-control" name="name" id="name" >
				</div>
			</div>
	
			</div>
				<div class="form-group">
				<label class="control-label col-sm-2">Address:</label>
				<span class="error"> <?php echo $addressErr;?></span> 
				<div class="col-xs-3">
					<input type="text" class="form-control" name="address" id="address">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Email:</label>
				<span class="error"> <?php echo $emailErr;?></span> 
				<div class="col-xs-3">
					<input type="text" class="form-control" name="email" id="email">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Password:</label>
				<span class="error"> <?php echo $passwordErr;?></span>
				<div class="col-xs-3">
					<input type="password" class="form-control" name="password" id="password">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Repeat Password:</label>
				<span class="error" id="pswRepeatErrMsg"> <?php echo $passwordRepeatErr;?></span>
				<span class="registrationFormAlert error" id="divCheckPasswordMatch"></span> 
				<div class="col-xs-3">
					<input type="password" class="form-control" name="passwordRepeat" id="passwordRepeat">
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