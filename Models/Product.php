<?php 

class Product{
	//Isn't it wrong to have id in a model? 
	//Can't think of another way to link to the product in question without the id
	private $_id;
	private $_name;
	private $_description;
	private $_price;
	private $_date;
	private $_ownerId;
	private $_owner;

	public function __construct($id, $name,$description,$price,$ownerId,$owner)
	{
		$this->_id = $id;
		$this->_name = $name;
		$this->_description = $description;
		$this->_price = $price;
		$this->_ownerId = $ownerId;
		$this->_owner = $owner;
	}
	public function getId()
	{
		return $this->_id;
	}
	public function getName()
	{
		return $this->_name;
	}
	public function getDescription()
	{
		return $this->_description;
	}
	public function getPrice()
	{
		return $this->_price;
	}
	public function getDate()
	{
		return $this->_date;
	}
	public function getOwnerId()
	{
		return $this->_ownerId;
	}
	public function getOwner()
	{
		return $this->_owner;
	}





}