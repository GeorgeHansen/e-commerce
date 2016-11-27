<?php 


Class CheckUser {


public function IsBlocked($username)
{
	
return false;
}

public function BlockUser()
{

}
public function UnBlockUser()
{

}
public function CheckAttempts()
{

}

public function AddAttempt($username)
{
require 'database.php';
try {

	$records = $conn->prepare('SELECT id FROM users WHERE user_name = :user_name');
	$records->bindParam(':user_name', $username);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	
	echo('result'.$results['id']);

	$records = $conn->prepare('UPDATE userinformation SET login_attempts=1 WHERE userid = :userId');
	$records->bindParam(':userId', $results['id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
    // echo a message to say the UPDATE succeeded
    echo $results  . " Records UPDATED successfully.";
    }
catch(PDOException $e)
    {
    echo $results . "<br>" . $e->getMessage();
    }
}
public function RemoveAllattempts()
{

}
public function IfUserexists( $uname , $pass )
{
	require 'database.php';
 //        $sqlCheckEmail = $conn->prepare("SELECT * FROM users where user_name=?");
	// $sqlCheckEmail->bind_param('s', $uname);
	// $sqlCheckEmail->execute();
	// $result = $sqlCheckEmail->store_result();
	//$emailExist = $sqlCheckEmail->num_rows;
	//$sqlCheckEmail->close();
	$stmt = $conn->prepare("SELECT * FROM users WHERE user_name=:username");
         $stmt->execute(array(':username'=>$uname));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);

 //    $records = $conn->prepare('SELECT user_name FROM users WHERE user_name=:username');
	// $records->bindParam(':username', $username);
	// $records->execute();
	// $results = $records->fetch(PDO::FETCH_ASSOC);
         echo("hash ".$row["user_password"]);
         echo("".$pass);
	$hash = password_verify( $pass,$row["user_password"] );
	echo ('// '.$hash);
	if(count($row) > 0 && $hash){
		 echo("".$row['user_name']);
		die('loged in ');
	} else {
		// $this->AddAttempt($username);
		die('error');
	}

}

}



?>