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
			echo $obj->username . "<br />";
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
			array_push($returnUsers, User::loadUserFromObject($obj));
		}
		return $returnUsers;
	}
}

?>
