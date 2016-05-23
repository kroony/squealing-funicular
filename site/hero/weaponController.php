<?php

include_once("hero/weapon.php");

class weaponController
{
	function getAllForUnattendedForUser($id)
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Weapon` WHERE `UserID` = $id;";

		$res=$db->query($getQuery);//execute query

		$returnWeapons = array();
		while($obj = $res->fetchObject())
		{
			$tmpWeapon = Weapon::loadWeaponFromObject($obj);
			if(!is_numeric($tmpWeapon->GetHeroIDFromWeapon()) && !is_numeric($tmpWeapon->GetSaleIDFromWeapon()))
			{
				array_push($returnWeapons, Weapon::loadWeaponFromObject($obj));
			}
		}
		return $returnWeapons;
	}
	
	function getAllForUser($id)
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * ,  `DamageDie` +  `DamageQuantity` +  `DamageOffset` +  `CritChance` AS `Total` FROM `Weapon` WHERE `UserID` = $id ORDER BY `Total` DESC;";

		$res=$db->query($getQuery);//execute query

		$returnWeapons = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnWeapons, Weapon::loadWeaponFromObject($obj));
		}
		return $returnWeapons;
	}
	
	function getAll()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Weapon`;";

		$res=$db->query($getQuery);//execute query

		$returnWeapons = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnWeapons, Weapon::loadWeaponFromObject($obj));
		}
		return $returnWeapons;
	}
	
	function getAllWeaponBase()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `weaponbase`;";

		$res=$db->query($getQuery);//execute query

		$returnWeaponBase = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnWeaponBase, $obj);
		}
		return $returnWeaponBase;
	}
}

?>
