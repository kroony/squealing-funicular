<?php
class Location
{
	public $ID;
	public $Name;
	public $Description;
	public $RequiredExploration;
	public $MinLevel;
	public $MaxLevel;
	public $RewardType;
	public $RewardChance;
	public $NPCFightChance;
	public $NPCList;
	public $Distance; //distance from guild hall in seconds
	public $Cost;
	public $CostChance;
	public $LinkHidden;
	public $URL;
	Public $PageName;

	function __construct()
	{
	}
	
	//load Location from DB 
	function load($ID)
	{
		//check ID is not blank and exists and such
		$db = DB::GetConn();

		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `Location` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();
    return Location::loadLocationFromObject($obj);
  }

	function loadLocationFromObject($obj)
  {
		$returnLocation = new User();
		
		$returnLocation->ID = $obj->ID;
		$returnLocation->Name =  $obj->name;
		$returnLocation->Description =  $obj->description;
		$returnLocation->RequiredExploration = $obj->requiredExploration;
		$returnLocation->MinLevel = $obj->minLevel;
		$returnLocation->MaxLevel = $obj->maxLevel;
		$returnLocation->RewardType = $obj->rewardType;
		$returnLocation->RewardChance = $obj->rewardChance;
		$returnLocation->NPCFightChance = $obj->NPCFightChance;
		$returnLocation->NPCList = $obj->NPCList;
		$returnLocation->Distance = $obj->distance;
		$returnLocation->Cost = $obj->cost;
		$returnLocation->CostChance = $obj->costChance;
		$returnLocation->LinkHidden = $obj->linkHidden;
		$returnLocation->URL = $obj->URL;
		$returnLocation->PageName = $obj->pageName;
		
		return $returnLocation;
	}
	
	function Save()
	{
		$db = DB::GetConn();
		if($this->ID != null)
		{
			$row = array("name"=>$this->Name,
				"description"=>$this->Description,
				"requiredExploration"=>$this->RequiredExploration,
				"minLevel"=>$this->MinLevel,
				"maxLevel"=>$this->MaxLevel,
				"rewardType"=>$this->RewardType,
				"rewardChance"=>$this->RewardChance,
				"NPCFightChance"=>$this->NPCFightChance,
				"NPCList"=>$this->NPCList,
				"distance"=>$this->Distance,
				"cost"=>$this->Cost,
				"costChance"=>$this->CostChance,
				"linkHidden"=>$this->LinkHidden,
				"URL"=>$this->URL,
				"pageName"=>$this->PageName);
				
			$where = array($db->quoteInto("ID = ?", $this->ID));
			try {
				$db->update("Location", $row, $where);
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}
		else //no id, add new user
		{
			$row = array("name"=>$this->Name,
				"description"=>$this->Description,
				"requiredExploration"=>$this->RequiredExploration,
				"minLevel"=>$this->MinLevel,
				"maxLevel"=>$this->MaxLevel,
				"rewardType"=>$this->RewardType,
				"rewardChance"=>$this->RewardChance,
				"NPCFightChance"=>$this->NPCFightChance,
				"NPCList"=>$this->NPCList,
				"distance"=>$this->Distance,
				"cost"=>$this->Cost,
				"costChance"=>$this->CostChance,
				"linkHidden"=>$this->LinkHidden,
				"URL"=>$this->URL,
				"pageName"=>$this->PageName);
			
			try {
				$db->insert("Location",$row);
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
