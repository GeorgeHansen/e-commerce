<?php 
class LoginController{

	
	//the get page.
	public function home()
	{
      require_once('Views/login/loginhome.php');
    }

    public function error() 
    {
      require_once('Views/registration/error.php');
    }
    public function post()
    {
      
        session_start();
        require_once('Validator.php');
    	$validate = new Validator();

    	//pass through each field you want checked, plus the rules.
    	$validator = $validate->check($_POST, array(
    		'user_name' => array(
    			'required' => true,
    			'alphanumericSpace' => true
    		),
    		'password' =>array(
    			'required' => true,
    			// 'password' => true
    		)
    	));
        print_r( $validator->errors());
    	if($validator->passed())
    	{
    		require_once('Database.php');
    		$user = $_POST["user_name"];
            $userpassword = $_POST["password"];
            $senetizeuser = $this->escape($user); 
            $senetizepassword = $this->escape($userpassword);
                    if(isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token'])
                    {
                    $count = Database::getInstance()->query("SELECT * FROM users where user_name=?", array($senetizeuser));
                    $result = $count->getResults();
                    if( $senetizeuser == $result[0]->user_name  && password_verify($senetizepassword,$result[0]->user_password))
                    {
                        $userid = $result[0]->id;
                        $this->CheckIp( $userid);
                        $_SESSION['user_id'] =$userid;
                       header("Location: ?controller=Registration&action=testhome");
                        $passwordha = $result[0]->user_password;
                        $user = $result[0]->user_name;
                    }
                    else
                    {
                        die('your username or password is incorrect');
                    }
                    }
                   else
                   {
                    die('there aer some security issues');
                   }
           
		}
    	else
    	{
            //TODO: properly display error messages in the view. 
    		//Should be contained in the errors array in the validator. 
    		require_once("Views/login/login.php");
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
//check user

private function CheckIp( $userId )
{
    print_r($userId);
 $count = Database::getInstance()->query("SELECT * FROM ips where userid=?", array($userId));
                    $result = $count->getResults();
                    if($result != null  )
                    {
                        if($this->get_client_ip() !=  $result[0]->ip )
                       {
                        //sendemail
                        //hear i have to call email api to send email if the ip is changed 
                        echo("your ip is changed");
                       }
                    }
                    else
                    {
                         echo("Not Loged In or ip is not saved in registeration");
                    }
}
function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}
}
 ?>
