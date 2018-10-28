<?php
include_once("location/location.php");

class locationController
{  
  function __construct()
	{
    //str trainer
    //dex trainer
    //con trainer
    //int trainer
    //wis trainer
    //cha trainer
    
    //gold mine
    //fight pits
	}
	
	function getAllLocations()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Location` ORDER BY `ID` ASC;";

		$res=$db->query($getQuery);//execute query
		
		$returnLocations = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnLocations, Location::loadLocationFromObject($obj));
		}
		return $returnLocations;
	}
	
	function getUnlockedLocations($Exploration)
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Location` WHERE `requiredExploration` < $Exploration ORDER BY `ID` ASC;";

		$res=$db->query($getQuery);//execute query
		
		$returnLocations = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnLocations, Location::loadLocationFromObject($obj));
		}
		return $returnLocations;
	}
	
	function getNextLocationExploration($Exploration)
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Location` WHERE `requiredExploration` > $Exploration ORDER BY `requiredExploration` ASC LIMIT 1;";

		$res=$db->query($getQuery);//execute query
		
		$obj = $res->fetchObject();
		
		return	Location::loadLocationFromObject($obj);
	}
}
?>
