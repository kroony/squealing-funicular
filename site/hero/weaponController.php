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
			$weapon = new Weapon();
			array_push($returnWeapons, $weapon->loadHeroFromObject($obj));
		}
		return $returnWeapons;
	}
}

?>
