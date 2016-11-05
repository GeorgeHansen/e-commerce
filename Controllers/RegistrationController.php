<?php 
class RegistrationController{

	private function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function home() {
    
      require_once('views/registration/home.php');
    }

    public function error() {
      require_once('views/registration/error.php');
    }

    public function post()
    {
    	$userErr = $nameErr = $addressErr = $passwordErr = $emailErr = $passwordRepeatErr = "";
		$user = $name =  $address = $password = $email =  $passwordRepeat = "";

		$userIsValid = $nameIsValid = $passIsValid = $passRepeatIsValid = $emailIsValid =  $addressIsValid =  false;


		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			if (empty($_POST["user"])) {
				$userErr = "Username is required";
			}
			else{
				$user = $this->test_input($_POST["user"]);
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
				$name = $this->test_input($_POST["name"]);
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
				$address = $this->test_input($_POST["address"]);

				//validation passes
				$addressIsValid = true;
			}
			if (empty($_POST["password"])) {
				$passwordErr = "Password is required";
			} else {
				$password = $this->test_input($_POST["password"]);
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
					$passwordRepeat = $this->test_input($_POST["passwordRepeat"]);
					$passRepeatIsValid = true;
				}	
			}
			if(empty($_POST["email"]))
			{
				$emailErr = "Email is required";
			}
			else
			{
				$email = $this->test_input($_POST["email"]);
				if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$emailErr = "Invalid email format";
				}
				else{
					$emailIsValid = true;
					
				}
			}
		}
		require_once("views/registration/home.php");
    }

   


}
 ?>