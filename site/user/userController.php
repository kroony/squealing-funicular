<?php
include_once("user/user.php");

class userController
{
	function getAll()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `User`;";

		$res=$db->query($getQuery);//execute query
		
		$returnUsers = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnUsers, User::loadUserFromObject($obj));
		}
		return $returnUsers;
	}
	
	function getTop10ByGold()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `User` WHERE `ID` <> 146 ORDER BY `User`.`gold` DESC LIMIT 10;";

		$res=$db->query($getQuery);//execute query
		
		$returnUsers = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnUsers, Hero::loadUserFromObject($obj));
		}
		return $returnUsers;
	}

	function performGlobalHealing($rate)
	{
		$rate = (float)$rate;
		$db = DB::GetConn();
		$getQuery = "UPDATE Hero
			SET CurrentHP = LEAST(MaxHP, CurrentHP + (Level + GREATEST(0, FLOOR((Con - 10) / 2))) * $rate)
			WHERE CurrentHP > 0 AND CurrentHP < MaxHP";

		$getResult=$db->query($getQuery);//execute query
		return $getResult;
	}
}

?>
