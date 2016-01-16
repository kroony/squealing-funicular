<?php

class User
{
	public $ID;
	public $username;
	public $email;
	public $password;
	public $salt;
	public $gold;
	public $active;

	function __construct()
	{
	}

	//load Adventurer from DB 
	function load($ID)
	{
		//check ID is not blank and exists and such
		$db = DB::GetConn();

		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `User` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();
        return $this->loadUserFromObject($obj);
    }

	function loadUserFromObject($obj)
    {
		$this->ID = $obj->ID;
		$this->username =  $obj->username;
		$this->email =  $obj->email;
		$this->password = $obj->password;
		$this->salt = $obj->salt;
		$this->gold = $obj->gold;
		$this->active = $obj->active;
		
		return $this;
	}

	function Save()
	{
		$db = DB::GetConn();
		if($this->ID != null)
		{
			$updateQuery = "UPDATE `User` SET 
				`username` = " . $this->username . ", 
				`email` = " . $this->email . ", 
				`password` = '" . $this->password . "',  
				'salt` = " . $this->salt . ",          
				`gold` = " . $this->gold . ",    
				`active` = " . $this->active . "
				WHERE `User`.`ID` = " . $this->ID . ";";
			$db->query($updateQuery); //@todo change this to an associate array and use db->Update(...);
		}
		else //no id, add new user
		{
			$row = array("username"=>$this->username,
				"username"=>$this->username,
				"email"=>$this->email,
				"password"=>$this->password,
				"salt"=>$this->salt,
				"gold"=>$this->gold,
				"active"=>$this->active);
			
			try {
				$db->insert("User",$row);
				$id = $db->lastInsertId();
				$this->ID = $id;
				
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}

		//some sort of try catch error detection
	}
}

?>
