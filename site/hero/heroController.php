<?php

include_once("hero/hero.php");


class heroController
{
	function getCostForNextHero($userID)
	{
		$cost = 0;
		$currentCount = $this->countAllForUser($userID);
		$cost = ceil(($currentCount + 1) * (1.2 * $currentCount) - 30);
		if($cost < 0)
		{
			$cost = 0;
		}
		return $cost;
	}
	
	function getAllForUser($id)
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Hero` WHERE `OwnerID` = $id;";

		$res=$db->query($getQuery);//execute query
		
		$returnHeroes = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnHeroes, Hero::loadHeroFromObject($obj));
		}
		return $returnHeroes;
	}
	
	function getAll()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Hero` ORDER BY `OwnerID` DESC;";

		$res=$db->query($getQuery);//execute query
		
		$returnHeroes = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnHeroes, Hero::loadHeroFromObject($obj));
		}
		return $returnHeroes;
	}
	
	function countAllForUser($userID)
	{
		$db = DB::GetConn();
		
		$getQuery = "SELECT count(*) as count FROM `Hero` WHERE `OwnerID` = $userID;";
		$res=$db->query($getQuery);//execute query
		$obj = $res->fetchObject();
		
		return $obj->count;
	}
	
	function getTop10ByXP()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Hero` WHERE `OwnerID` <> 146 ORDER BY `Hero`.`CurrentXP` DESC LIMIT 10;";

		$res=$db->query($getQuery);//execute query
		
		$returnHeroes = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnHeroes, Hero::loadHeroFromObject($obj));
		}
		return $returnHeroes;
	}
	
	function getTop10ByKills()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Hero` ORDER BY `Hero`.`Kills` DESC LIMIT 10;";

		$res=$db->query($getQuery);//execute query
		
		$returnHeroes = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnHeroes, Hero::loadHeroFromObject($obj));
		}
		return $returnHeroes;
	}

	function dropDownForUser($id)
	{
		$getQuery = "SELECT `ID`, `Name` FROM `Hero` WHERE `OwnerID` = $id AND `CurrentHP` > 0;";

		$getResult=mysql_query($getQuery);//execute query
		$totalHeros=mysql_numrows($getResult); 

		$returnString = "";
		$i=0;
		while($i < $totalHeros)
		{
			$HeroID=mysql_result($getResult,$i,"ID");
			$HeroName=mysql_result($getResult,$i,"Name");

			$returnString .= "<option value='" . $HeroID . "'>" . $HeroName . "</option>";

			$i++;
		}
		return $returnString;
	}

	function dropDownForUserEnemys($id)
	{
		$getQuery = "SELECT `ID`, `Name` FROM `Hero` WHERE `OwnerID` <> $id AND `CurrentHP` = `MaxHP`;";

		$getResult=mysql_query($getQuery);//execute query
		$totalHeros=mysql_numrows($getResult); 

		$returnString = "";
		$i=0;
		while($i < $totalHeros)
		{
			$HeroID=mysql_result($getResult,$i,"ID");
			$HeroName=mysql_result($getResult,$i,"Name");

			$returnString .= "<option value='" . $HeroID . "'>" . $HeroName . "</option>";

			$i++;
		}
		return $returnString;
	}

	function findEnemys($id, $Hero)
	{
		$low_level = $Hero->Level - 1;
		$high_level = $Hero->Level + 2;
		$db = DB::GetConn();
		$getQuery = "SELECT Hero.* FROM `Hero` WHERE `OwnerID` <> $id AND `Status` = '' AND `CurrentHP` = `MaxHP` AND (`Level` BETWEEN $low_level AND $high_level OR `Level` = -1) ORDER BY RAND();";

		$res = $db->query($getQuery);

		$enemys = array();
		while($obj = $res->fetchObject())
		{
			$enemy = new Hero();
			$enemy = $enemy->loadHeroFromObject($obj);
			$enemys[] = $enemy;
		}
		return $enemys;
	}

	function performGlobalHealing($rate)
	{
		$rate = (float)$rate;
		$db = DB::GetConn();
		$healLivingQuery = "UPDATE Hero
			SET CurrentHP = LEAST(MaxHP, CurrentHP + GREATEST(0.1, (Level + GREATEST(0, FLOOR((Con - 10) / 2)))) * $rate)
			WHERE CurrentHP > 0 AND CurrentHP < MaxHP";

		$healLivingResult=$db->query($healLivingQuery);//execute query
		
		$healUnconciousQuery = "UPDATE Hero
			SET CurrentHP = LEAST(MaxHP, CurrentHP + GREATEST(0.001, (Level + GREATEST(0, FLOOR((Con - 10) / 2)))) * ($rate / 20))
			WHERE CurrentHP <= 0 AND CurrentHP > -Con";

		$healUnconciousResult=$db->query($healUnconciousQuery);//execute query
		
		if($healLivingResult && $healUnconciousResult)
		{
			return true;
		}
		return false;
	}
}

?>
