<?php

class User
{
	public $ID;
	public $username;
	public $email;
	public $password;
	public $gold;
	public $active;
	public $refererID;
	public $deaths;
	public $kills;
	public $created;
	public $lastSeen;
	public $exploration;

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
        return User::loadUserFromObject($obj);
    }

	function loadUserFromObject($obj)
    {
		$returnUser = new User();
		
		$returnUser->ID = $obj->ID;
		$returnUser->username =  $obj->username;
		$returnUser->email =  $obj->email;
		$returnUser->password = $obj->password;
		$returnUser->gold = $obj->gold;
		$returnUser->active = $obj->active;
		$returnUser->refererID = $obj->refererID;
		$returnUser->deaths = $obj->deaths;
		$returnUser->kills = $obj->kills;
		$returnUser->created = new DateTime($obj->created);
		$returnUser->lastSeen = new DateTime($obj->lastSeen);
		$returnUser->exploration = $obj->exploration;
		
		return $returnUser;
	}
	
	function isAdmin()
	{
    if($this->ID == 1)
    {
      return true;
    }
    return false;
	}
	
	function canAfford($price)
  {
		if($price <= $this->gold)
		{
			return true;
		}
		return false;
	}

	function debit($amount)
	{
		$this->gold -= $amount;
		$this->Save();
	}
	
	function credit($amount)
	{
		$this->gold += $amount;
		$this->Save();
	}
	
	function Save()
	{
		$db = DB::GetConn();
		if($this->ID != null)
		{
			$row = array("username"=>$this->username,
				"username"=>$this->username,
				"email"=>$this->email,
				"password"=>$this->password,
				"gold"=>$this->gold,
				"active"=>$this->active,
				"refererID"=>$this->refererID,
				"deaths"=>$this->deaths,
				"kills"=>$this->kills,
				"lastSeen"=>$this->lastSeen->format('Y-m-d H:i:s'),
				"exploration"=>$this->exploration);
				
			$where = array($db->quoteInto("ID = ?", $this->ID));
			try {
				$db->update("User", $row, $where);
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}
		else //no id, add new user
		{
			$row = array("username"=>$this->username,
				"email"=>$this->email,
				"password"=>$this->password,
				"gold"=>$this->gold,
				"active"=>$this->active,
				"refererID"=>$this->refererID,
				"deaths"=>$this->deaths,
				"kills"=>$this->kills,
				"created"=>$this->created->format('Y-m-d H:i:s'),
				"lastSeen"=>$this->lastSeen->format('Y-m-d H:i:s'),
				"exploration"=>$this->exploration);
			
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
