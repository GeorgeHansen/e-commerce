<?php 
class RegistrationController{

	
	//the get page.
	public function home()
	{
      require_once('views/registration/home.html');
    }

    public function error() 
    {
      require_once('views/registration/error.php');
    }
    public function post()
    {
       	require_once('Validator.php');
    	$validate = new Validator();

    	//pass through each field you want checked, plus the rules.
    	$validator = $validate->check($_POST, array(
    		'user_name' => array(
    			'required' => true,
    			'unique' => 'users',
    			'alphanumericSpace' => true
    		),
    		'name' => array(
    			'required' => true,
    			'name' => true
    		),
    		'address' => array(
    			'required' => true

    		),
    		'password' =>array(
    			'required' => true,
    			'password' => true
    		),
    		'email' => array(
    			'required' => true,
    			'unique' => 'userinformation',
    			'email' => true

    		),
    		'passwordRepeat' => array(
    			'required' => true,
    			'matches' => 'password'
    		)
    	));

    	if($validator->passed())
    	{
    		require_once('Database.php');

    		$user = $_POST["user_name"];
			$email = $_POST["email"];
			$address = $_POST["address"];
			$name = $_POST["name"];

    		//start the registration process!
    		//Step1: HashPassword
    		//Step2: Insert user
    		//Step3: get userid
    		//Step4: insert user's email/address
    		//Step5: insert user's ip

			
    		$hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
    				
			//Inserting user.
			$sql = Database::getInstance()
					->query("INSERT INTO users (user_name, user_password, user_role) VALUES(?,?,?)",
				 			array($user,$hashedPassword, 1));
			
			//Grab the inserted users id.
			$last_id = Database::getInstance()->pdo()->lastInsertId();
			
			//Insert of Userinfo like email, address.
			Database::getInstance()
				->query("INSERT INTO userinformation(userid, email,address,name) values (?,?,?,?)",
					array($last_id,$email,$address,$name));
			
			//Recording the ip address of the registree.
			$ipaddress = $this->get_client_ip();
			Database::getInstance()
				->query("INSERT INTO ips(userid,ip) values(?,?)",
					array($last_id, $ipaddress));
			

			echo "TODO: send me to the home page";
		}
    	else
    	{
    		//TODO: properly display error messages in the view. 
    		//Should be contained in the errors array in the validator. 
    		require_once("views/registration/home.php");
    	}
		
    }

   	private function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	/**
	* We'll constantly get the local ip address when using this on a local server.
	* With IPv6 it is apparently shown as ::1
	* values should be more accurate on a server.
	*/ 
	private function get_client_ip() {
	    $ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
}


}
 ?>