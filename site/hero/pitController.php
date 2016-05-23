<?php

include_once("fightLog.php");
include_once("hero.php");

class PitController
{
	function oneOnOne($hero1, $hero2)
	{
		$log = new FightLog();
		if ($hero1->CurrentHP <= 0) {
			$log->log($hero1->displayName(true) . " has no HP and is unable to battle!<br />");
			return $log;
		}
		if ($hero2->CurrentHP <= 0) {
			$log->log($hero2->displayName(false) . " has no HP and is unable to battle!<br />");
			return $log;
		}
		$log->log($hero1->displayName(true) . " Level " . $hero1->Level . " is fighting " . $hero2->displayName(false) . " Level " . $hero2->Level . "<br />");

		$fighters = array(array($hero1, 0), array($hero2, 0));
		$aggressor = $this->chooseFirst($log, $hero1, $hero2);

		$log->log($this->displayFighter($fighters, $aggressor) . " is going 1st<br />");

		$fighting = true;
		$winner = null;
		$roundCounter = 1;
		while ($fighting) {
			if($roundCounter % 2){
				$log->log("<br />Round " . ceil($roundCounter / 2) . "<br />");
			}
		  
			$target = ($aggressor + 1) % 2;

			$calc = $fighters[$aggressor][0]->calcDamage($this->logof($log, $aggressor));
		  
			$damageDelt = $fighters[$target][0]->takeDamage($this->logof($log, $target), $calc);
		  
			//increase runaway possibility
			if($damageDelt > $fighters[$target][0]->calculateAttributeBonus($fighters[$target][0]->Con))
			{
				if($fighters[$target][0]->Cha < $fighters[$aggressor][0]->Cha)
				{
					$fighters[$target][1] += 2;
				}
				else
				{
					$fighters[$target][1] += 1;
				}
				$log->log($this->displayFighter($fighters, $target) . "'s run away increased to " . $fighters[$target][1] . "<br />");
			}
		  
			if ($fighters[$target][0]->CurrentHP <= 0) {
				$winner = $fighters[$aggressor][0];
				$fighting = false;
				if ($fighters[$target][0]->CurrentHP <= 0 - $fighters[$target][0]->Con) {
					$log->log("<b>" . $this->displayFighter($fighters, $target) . " died </b><br /><br />");
				} else {
					$log->log($this->displayFighter($fighters, $target) . " was knocked out <br /><br />");
				}
				$winner->addXP($this->logof($log, $aggressor), round($fighters[$target][0]->LevelUpXP / 3));
				break;
			}
		  
			if($fighters[$target][1] > $fighters[$target][0]->calculateRunawayLimit())
			{
				$winner = $fighters[$aggressor][0];
				$fighting = false;
				$log->log($this->displayFighter($fighters, $target) . " decided to run away <br /><br />");
			
				$winner->addXP($this->logof($log, $aggressor), round($fighters[$target][0]->LevelUpXP / 3));
				break;
			}
		  
			$aggressor = $target;
			$roundCounter++;
		}
		
		// add after combat cooldown
		$hero1->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d minutes", $roundCounter))));
		$hero1->Status = "Fight Cooldown";
		$hero1->SaveHero();
		
		$hero2->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d minutes", $roundCounter))));
		$hero2->Status = "Fight Cooldown";
		$hero2->SaveHero();
		
		return $log;
	}

	function chooseFirst($log, $hero1, $hero2)
	{
		$init1 = $hero1->rollInitiative(new FightLogLine("player", $log));
		$init2 = $hero2->rollInitiative(new FightLogLine("other", $log));

		if ($init1 > $init2) {
			return 0;
		}
		else if ($init2 > $init1) {
			return 1;
		}
		else if ($hero1->Fte > $hero2->Fte) {
			return 0;
		}
		else if ($hero2->Fte > $hero1->Fte) {
			return 1;
		}
		else {
			return rand(0,1);
		}
	}

	function displayFighter($fighters, $ix)
	{
		return $fighters[$ix][0]->displayName($ix == 0);
	}

	function logof($log, $ix)
	{
		return new FightLogLine($ix == 0 ? "player" : "enemy", $log);
	}
}
