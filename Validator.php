<?php 

class Validator{

	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct()
	{
		// $this->_db = DB::getInstance();
	}
	public function check($source,$items = array())
	{
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				$value = trim($source[$item]);

				if($rule === 'required' && empty($value))
				{
					// echo '<br>required is true';
					$this->addError($item . " is required");
				}
				else if (!empty($value))
				{
					//Add validation rules here. 
					switch($rule){
						case 'min':
							if(strlen($value) < $rule_value)
							{
								$this->addError($item." must be a minimum of ".$rule_value." characters");
							}
						break;
						case 'max':
							if(strlen($value) > $rule_value)
							{
								$this->addError($item." must be a maximum of ".$rule_value." characters");
							}
						break;
						case 'matches' :
							if($value != $source[$rule_value])
							{
								$this->addError($rule_value. " must match ".$item);
							}

						break;
					
						//Case primarily used to make sure there are no spaces in username.
						case 'alphanumericSpace' :
							if (!preg_match("/^[a-zA-Z0-9]*$/ ", $value))
							{
								$this->addError("Only letters and numbers are allowed in ".$item. " field");
							}
						break;
						//not perfect. what if name contains dashes?
						case 'name' :
							if (!preg_match("/^[a-zA-Z ]*$/ ", $value))
							{
								$this->addError("Only letters and white space allowed in ". $item ." field");
							}
						break;
						case 'password' :
							$uppercase = preg_match('@[A-Z]@', $value);
							$lowercase = preg_match('@[a-z]@', $value);
							$number    = preg_match('@[0-9]@', $value);

							if (!$uppercase || !$lowercase || !$number || strlen($value) < 8)
							{
								$this->addError("Invalid password format");
							}
						break;
						case 'email' : 
							if(!filter_var($value, FILTER_VALIDATE_EMAIL))
							{
								$this->addError("Invalid email format");
							}
						break;
						case 'unique' :

							require_once('Database.php');
							//item is the value from the table. rule value is the table and value is the value we want to check.
							$count = Database::getInstance()->query("SELECT ". $item. " FROM ".$rule_value." where ".$item."=?", array($value))->getCount();
							if($count)
							{
								$this->addError($item. " already exists");
							}
						break;
					}
				}
			}
		}
		if(empty($this->_errors))
		{
			$this->_passed = true;
		}
		return $this;
	}
	private function addError($error)
	{
		$this->_errors[] = $error;
	}
	public function errors()
	{
		return $this->_errors;
	}
	public function passed()
	{
		return $this->_passed;
	}
}
