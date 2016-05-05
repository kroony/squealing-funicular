<?php

include_once("fightLog.php");

class Armor
{
	public $ID;
	public $UserID;
	public $Name;
	public $RaceID;
	public $MaxHPBonus;
	public $CurrentHPBonus;
	public $DamageReduction;
	public $Value;
	public $ArmorHP;
	public $TotalDamage;

	function __construct()
	{
	}
	
	function takeDamage($damage)
	{
		/*
		lower passed in damage by damage reduction
		increase TotalDamage by the amount of damage we reduced
		lower currentHP by the amount of damage we reduced
		return remaining damage
		*/
	}
	
	function calculateRepairCost()
	{
		//get current damage (maxHP-currentHP)
		//loop for current damage
		//tally totalDamage + loop count * (1 + totalDamage/100)
		//return tally
	}
	
	function GetHeroNameFromArmor()
	{
		$db = DB::GetConn();
		$armor_con = $db->quoteInto("ArmorID = ?", $this->ID);
		$sql = "select Name from Hero where $armor_con limit 1";
		$res = $db->query($sql);
		$obj = $res->fetchObject();
		if(is_object($obj))
		{
			return $obj->Name;
		}
		else
		{
			return "Not Equipped";
		}
	}
	
	function GetHeroIDFromArmor()
	{
		$db = DB::GetConn();
		$armor_con = $db->quoteInto("ArmorID = ?", $this->ID);
		$sql = "select ID from Hero where $armor_con limit 1";
		$res = $db->query($sql);
		$obj = $res->fetchObject();
		if(is_object($obj))
		{
			return $obj->ID;
		}
		else
		{
			return "No ID";
		}
	}
 
	function loadArmor($ID)
	{
		//check ID is not blank and exists and such

		$db = DB::GetConn();
		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `Armor` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();
		return Armor::loadArmorFromObject($obj);
	}
	
	function loadArmorFromObject($obj)
    {
		$returnArmor = new Armor();
		$returnArmor->ID = $obj->ID;
		$returnArmor->UserID = $obj->UserID;
		$returnArmor->Name = $obj->Name;
		$returnArmor->RaceID = $obj->RaceID;
		$returnArmor->MaxHPBonus = $obj->MaxHPBonus;
		$returnArmor->CurrentHPBonus = $obj->CurrentHPBonus;
		$returnArmor->DamageReduction = $obj->DamageReduction;
		$returnArmor->Value = $obj->Value;
		$returnArmor->ArmorHP = $obj->ArmorHP;
		$returnArmor->TotalDamage = $obj->TotalDamage;

		return $returnArmor;
	}
	
	function save()
	{
		$db = DB::GetConn();
		
		if($this->ID != null){
			$row = array("UserID"=>$this->UserID,
				"Name"=>$this->Name,
				"RaceID"=>$this->RaceID,
				"MaxHPBonus"=>$this->MaxHPBonus,
				"CurrentHPBonus"=>$this->CurrentHPBonus,
				"DamageReduction"=>$this->DamageReduction,
				"Value"=>$this->Value,
				"ArmorHP"=>$this->ArmorHP,
				"TotalDamage"=>$this->TotalDamage);
			$where = array($db->quoteInto("ID = ?", $this->ID));
			try {
				$db->update("Armor", $row, $where);
			}
			catch(Exception $ex)
			{
				print_r($ex);
			} 
		} 
		else 
		{
			$row = array("UserID"=>$this->UserID,
				"Name"=>$this->Name,
				"RaceID"=>$this->RaceID,
				"MaxHPBonus"=>$this->MaxHPBonus,
				"CurrentHPBonus"=>$this->CurrentHPBonus,
				"DamageReduction"=>$this->DamageReduction,
				"Value"=>$this->Value,
				"ArmorHP"=>$this->ArmorHP,
				"TotalDamage"=>$this->TotalDamage);
			
			try {
				$db->insert("Armor",$row);
				$id = $db->lastInsertId();
				$this->ID = $id;
				
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}	
	}
	
	function delete()
	{
		$db = DB::GetConn();
			
		$where = array($db->quoteInto("ID = ?", $this->ID));
		try {
			$db->delete("Armor", $where);
		}
		catch(Exception $ex)
		{
			print_r($ex);
		} 
	}
}

?>
