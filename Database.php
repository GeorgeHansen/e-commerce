<?php

/**
 * Database class from codecourse: PHP OOP Login/Register System
 * Database: https://www.youtube.com/watch?v=3_alwb6Twiw&index=7&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc .
 * DatabaseQuerying: https://www.youtube.com/watch?v=PaBWDOBFxDc&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=8
 * DatabaseResults: 
 * Database Insert/Update: 
 */
class Database{

	private static $_instance = null;
	private $_pdo,
			$_query,
			$_error = false,
			$_results,
			$_count = 0;

	/**
	 * @return mixed
	 */
	public function getResults()
	{
		return $this->_results;
	}

	/**
	 * @return int
	 */
	public function getCount()
	{
		return $this->_count;
	}

	private function __construct()
	{
		include('config.php');
		try
		{

			$this->_pdo = new PDO("mysql:host=".$config["db"]["host"].";dbname=".$config["db"]["dbname"].";", $config["db"]["user"], $config["db"]["pass"]);


		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
	public static function getInstance()
	{
		if(!isset(self::$_instance))
		{
			self::$_instance = new Database();
		}
		return self::$_instance;
	}

	public function query($sql, $params= array())
	{
		//echo $sql."<br>";
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql))
		{
			$i = 1;
			if(count($params))
			{
				foreach ($params as $param) {
					// echo $param."<br>";
					$this->_query->bindValue($i,$param);
					$i++;
				}
			}
			
			if($this->_query->execute())
			{
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}
			else
			{
				
				$this->_error = true;
			}
		}
		return $this;
	}

	public function error()
	{
		return $this->_error;
	}
	//I think the database class is used to abstract away the pdo. 
	//returning the pdo is thus probably pretty silly. Oh well.
	//this may be dealt with later.
	public function pdo()
	{
		return $this->_pdo;
	}

}
