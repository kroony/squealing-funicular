<?php

class Party
{
	public $ID;
	public $Name;
	public $Status;
	public $Cooldown;
	public $OwnerID;
	public $Heroes = Array();

	function __construct()
	{
	}

	//@todo move this to a user class and just have this call the function on the user class
	public function GetOwner()
	{
		$db = DB::GetConn();
		$user_con = $db->quoteInto("ID = ?",$this->OwnerID);
		$sql = "select * from User where $user_con limit 1";
		$res = $db->query($sql);
		return $res->fetchObject();
	}

	//load Party from DB 
	function loadParty($ID)
	{
		//check ID is not blank and exists and such
		$db = DB::GetConn();

		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `Party` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();
        return Party::loadPartyFromObject($obj);
    }

	function loadPartyFromObject($obj)
    {
		$returnParty = new Party();
		$returnParty->ID = $obj->ID;
		$returnParty->Name = $obj->Name;
		$returnParty->Status =  $obj->Status;
		$returnParty->Cooldown =  $obj->Cooldown;
		$returnParty->OwnerID =  $obj->OwnerID;
		//load Heroes
		
		return $returnParty;
	}

	function addXP($log, $XP)
	{
		return false;
	}

	function rollInitiative($log)
	{
		return false;
	}

	function Save()
	{
		$db = DB::GetConn();
		if($this->ID != null)
		{
			$row = array("Name"=>$this->Name,
				"Status"=>$this->Status,
				"Cooldown"=>$this->Cooldown,
				"OwnerID"=>$this->OwnerID);
			$where = array($db->quoteInto("ID = ?", $this->ID));
			try {
				$db->update("Party", $row, $where);
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}
		else //no id, add new Party
		{
			$row = array("Name"=>$this->Name,
				"Status"=>$this->Status,
				"Cooldown"=>$this->Cooldown,
				"OwnerID"=>$this->OwnerID);
			
			try {
				$db->insert("Party",$row);
				$id = $db->lastInsertId();
				$this->ID = $id;
				
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}
	}
}

?>
