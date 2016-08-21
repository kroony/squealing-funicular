<?php
include_once("hero/hero.php");
include_once("user/userController.php");

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

		$getQuery = "SELECT * FROM `Hero` WHERE `OwnerID` = $id ORDER BY `ID` ASC;";

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
	
	function getChaModForUser($userID)
	{
		$db = DB::GetConn();
		
		$getQuery = "SELECT SUM(FLOOR((`Hero`.`Cha` - 10) / 2) + 1) AS `ModCha` FROM `Hero` where `OwnerID` = $userID;";
		$res=$db->query($getQuery);//execute query
		$obj = $res->fetchObject();
		
		return $obj->ModCha;
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
	
	function getTop10ByAge()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Hero` WHERE `OwnerID` <> 146 ORDER BY `Hero`.`DateOfBirth` ASC LIMIT 10;";

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

	function findEnemys($id, $Hero)
	{
		$low_level = $Hero->Level - 1;
		$high_level = $Hero->Level + 2;
		$db = DB::GetConn();
		$getQuery = "SELECT Hero.* FROM `Hero` WHERE `OwnerID` <> $id AND (`Status` = '' OR `Status` = 'Fight Cooldown' OR `Status` = 'Fight Cooldown A') AND `CurrentHP` = `MaxHP` AND (`Level` BETWEEN $low_level AND $high_level OR `Level` = -1) ORDER BY RAND();";

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
	
	/*$getDeadQuery = "SELECT * FROM `Hero` 
				 INNER JOIN  `Race` ON  `Hero`.`Race` = `Race`.`ID` 
				 WHERE HOUR( NOW( ) ) = HOUR(  `Hero`.`DateOfBirth` ) 
				 AND DATEDIFF( NOW( ) ,  `Hero`.`DateOfBirth` ) >  `Race`.`OldAge` +  `Hero`.`Fte` + ROUND(RAND() * (20 - 1))
				 AND `OwnerID` <> 146;";*/
	function preformGlobalAge()
	{
		$db = DB::GetConn();
		//select heroes born on the hour, who's age is over the max age + Fte + D20
		$getDeadQuery = "SELECT * FROM `Hero` ;";
		
		$res = $db->query($getDeadQuery);
		
		$obj = $res->fetchObject();
		$count = 0;
		if(isset($obj->count)) {$count = $obj->count;}
		echo 'Arg 4 ' . date('Y-m-d H:i') . ' Found: ' . $count . '   ';
		
		/*while($obj = $res->fetchObject())
		{
			$OldAgeHero = new Hero();
			$OldAgeHero = $OldAgeHero->loadHeroFromObject($obj);
			
			echo $OldAgeHero.Name . ' Aged: ' . $OldAgeHero.Age . '/' . $OldAgeHero.Race.OldAge . ' Player: ' . $OldAgeHero.GetOwner().username . ', ';
			
			//send message to user
			$subject = $OldAgeHero.Name . " has passed away at the old age of " . $OldAgeHero.Age . ".";
			$body = $OldAgeHero.Name . " the " . $OldAgeHero.Race.Name . " is survived by " . rand(2, $OldAgeHero.Fte) . " children and " . $OldAgeHero.Fte . " grand children.";
			userController::sendMessage($OldAgeHero.OwnerID, $OldAgeHero.OwnerID, $subject, $body);
			userController::sendMessage(1, $OldAgeHero.OwnerID, $subject, $body);
			
			$OldAgeHero.KillHero();
		}*/
	}
}

?>
