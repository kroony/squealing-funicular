<?php
class HeroClass
{
	/*
	   Bard - helps recruit new people
	   Fighter - Attacks and defends in PVP
	   Rogue - helps hide party from other partys and find other parties
	   Wizard - Do DPS to "fight" and in PVP?
	   Cleric - Heals

	   $bard = new HeroClass("Bard", 6);
	   $fighter = new HeroClass("Fighter", 10);
	   $rouge = new HeroClass("Rouge", 8);
	   $wizard = new HeroClass("Wizard", 4);
	   $cleric = new HeroClass("Cleric", 8);
	 */

	/*in x levels you "complete" your current class and if you meet the pre reqs you change class to a prestige class
	  with more HD, if you dont meet the requirements you have reached level cap
	 */
	public $ID;
	public $Name;
	public $HD;
	public $FavouredAttribute;
	public $LevelCap;
	public $NextClass;
	public $PrerequisiteAttribute;
	public $PrerequisiteTarget;
	public $PrerequisiteAge;
	public $Description;

	function __construct($Name, $HD, $FavouredAttribute, $LevelCap, $NextClass, $PrerequisiteAttribute, $PrerequisiteTarget, $PrerequisiteAge, $Description)
	{
		$this->Name = $Name;
		$this->HD = $HD;
		$this->FavouredAttribute = $FavouredAttribute;
		$this->LevelCap = $LevelCap;
		$this->NextClass = $NextClass;
		$this->PrerequisiteAttribute = $PrerequisiteAttribute;
		$this->PrerequisiteTarget = $PrerequisiteTarget;
		$this->PrerequisiteAge = $PrerequisiteAge;
		$this->Description = $Description;
	}

	//load Adventurer from DB 
	function loadHeroClass($ID)
	{
		//check ID is not blank and exists and such

		$db = DB::GetConn();
		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `AdvClass` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();

		$ReturnClass = new HeroClass($obj->Name, $obj->HD,$obj->FavouredAttribute,$obj->LevelCap,$obj->NextClass,$obj->PrerequisiteAttribute,$obj->PrerequisiteTarget,$obj->PrerequisiteAge,$obj->Description);
		$ReturnClass->ID = $ID;

		return $ReturnClass;
	}

	function checkForNewClass($Hero)
	{
		/*checks for classes we could move to.
		  returns false if unsuccessful
		  returns true AND makes the change if successful
		  perhaps this shouldnt be called CHECK if it DOES something?
		 */

		if($Hero->HeroClass->NextClass == null || $Hero->HeroClass->NextClass == "")//check there is another class to go to
		{
			return false;
		}

		$NextClassIDs = explode("|", $Hero->HeroClass->NextClass);
		//Get all classes listed in next class
		$getQuery = 'SELECT * FROM `AdvClass` WHERE `ID` IN (' . implode(',', array_map('intval', $NextClassIDs)) . ')';

		$db = DB::GetConn();
		$getResult=$db->query($getQuery);

		//filter out the unavalible classes
		$possibleNewClasses = array();
		while($obj = $getResult->fetchObject())
		{
			echo $obj->Name . " a needs " . $obj->PrerequisiteTarget . " in " . $obj->PrerequisiteAttribute . " Hero has " . $Hero->Str . " " . $Hero->Dex . " " . $Hero->Con . " " . $Hero->Intel . " " . $Hero->Wis . " " . $Hero->Cha . " " . $Hero->Fte . "<br />";

			if(($PrerequisiteAttribute == "Str" && $PrerequisiteTarget <= $Hero->Str) ||
				($PrerequisiteAttribute == "Dex" && $PrerequisiteTarget <= $Hero->Dex) ||
				($PrerequisiteAttribute == "Con" && $PrerequisiteTarget <= $Hero->Con) ||
				($PrerequisiteAttribute == "Intel" && $PrerequisiteTarget <= $Hero->Intel) ||
				($PrerequisiteAttribute == "Wis" && $PrerequisiteTarget <= $Hero->Wis) ||
				($PrerequisiteAttribute == "Cha" && $PrerequisiteTarget <= $Hero->Cha) ||
				($PrerequisiteAttribute == "Fte" && $PrerequisiteTarget <= $Hero->Fte)) {
					$tmpClass = new HeroClass($obj->Name, 
							$obj->HD, 
							$obj->FavouredAttribute, 
							$obj->LevelCap, 
							$obj->NextClass, 
							$obj->PrerequisiteAttribute,
							$obj->PrerequisiteTarget,
							$obj->PrerequisiteAge, 
							$obj->Description);

					$tmpClass->ID = $obj->ID;
					$possibleNewClasses[] = $tmpClass;
				}
		}
		//check age prereqs

		//check if there are any new possible new classes
		if(!empty($possibleNewClasses))
		{
			$newClassCount = count($possibleNewClasses);
			//there are new classes, pick one and copy it over
			$newClassIndex = rand(0,$newClassCount -1);
			$newClass = $possibleNewClasses[$newClassIndex];

			$this->ID = $newClass->ID;  //should load properly from DB or update the parent adventurer in db or something
			$this->Name = $newClass->Name;
			$this->HD = $newClass->HD;
			$this->FavouredAttribute = $newClass->FavouredAttribute;
			$this->LevelCap = $newClass->LevelCap;
			$this->NextClass = $newClass->NextClass;
			$this->PrerequisiteAttribute = $newClass->PrerequisiteAttribute;
			$this->PrerequisiteTarget = $newClass->PrerequisiteTarget;
			$this->PrerequisiteAge = $newClass->PrerequisiteAge;
			$this->Description = $newClass->Description;
			//we changed the class, return true
			return true;
		}

		//no new class, return false
		return false;
	}
}

?>
