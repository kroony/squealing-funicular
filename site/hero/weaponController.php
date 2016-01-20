<?php

include_once("hero/weapon.php");

class weaponController
{
	function getAllForUser($id)
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Weapon` WHERE `UserID` = $id;";

		$res=$db->query($getQuery);//execute query

		$returnWeapons = array();
		while($obj = $res->fetchObject())
		{
			$Weapon = new Weapon();
			array_push($returnWeapons, $Weapon->loadHeroFromObject($obj));
		}
		return $returnWeapons;
	}
}

?>
