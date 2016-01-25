<?php

include_once("hero/hero.php");


class heroController
{
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
		$getQuery = "SELECT Hero.* FROM `Hero` WHERE `OwnerID` <> $id AND `CurrentHP` = `MaxHP` AND (`Level` BETWEEN $low_level AND $high_level OR `Level` = -1);";

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
		$getQuery = "UPDATE Hero
			SET CurrentHP = LEAST(MaxHP, CurrentHP + (Level + GREATEST(0, FLOOR((Con - 10) / 2))) * $rate)
			WHERE CurrentHP > 0 AND CurrentHP < MaxHP";

		$getResult=$db->query($getQuery);//execute query
		return $getResult;
	}
}

?>
