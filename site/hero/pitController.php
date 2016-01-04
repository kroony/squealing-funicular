<?php

include_once("hero.php");

class PitController
{
  function oneOnOne($hero1, $hero2)
  {
    $log = "";
    if ($hero1->CurrentHP <= 0) {
		$log .= $this->displayName($hero1, true) . " has no HP and is unable to battle!<br />";
		return $log;
	}
    if ($hero2->CurrentHP <= 0) {
		$log .= $this->displayName($hero2, false) . " has no HP and is unable to battle!<br />";
		return $log;
	}
	$log .= $this->displayName($hero1, true) . " Level " . $hero1->Level . " is fighting " . $this->displayName($hero2, false) . " Level " . $hero2->Level . "<br /><br />";
	
	$fighters = array(array($hero1, 0), array($hero2, 0));
	$aggressor = $this->chooseFirst($hero1, $hero2);

	$log .= $this->displayFighter($fighters, $aggressor) . " is going 1st<br />";
	
	$fighting = true;
	$winner = null;
	$roundCounter = 1;
	while ($fighting) {
	  if($roundCounter % 2){
		  $log .= "<br />Round " . ceil($roundCounter / 2) . "<br />";
      }
	  
	  $target = ($aggressor + 1) % 2;
	  
	  $damageDelt = $fighters[$target][0]->takeDamage($fighters[$aggressor][0]->calcDamage());
	  
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
		$log .= $this->displayFighter($fighters, $target) . "'s run away increased to " . $fighters[$target][1] . "<br />";
	  }
	  
	  if ($fighters[$target][0]->CurrentHP <= 0) {
	    $winner = $fighters[$aggressor][0];
		$fighting = false;
		if ($fighters[$target][0]->CurrentHP <= 0 - $fighters[$target][0]->Con) {
		  $log .= "<b>" . $this->displayFighter($fighters, $target) . " died </b><br /><br />";
		} else {
		  $log .= $this->displayFighter($fighters, $target) . " was knocked out <br /><br />";
		}
		$winner->addXP(round($fighters[$target][0]->LevelUpXP / 3));
		break;
	  }
	  
	  if($fighters[$target][1] > $fighters[$target][0]->Level + $fighters[$target][0]->calculateAttributeBonus($fighters[$target][0]->Cha))
	  {
		$winner = $fighters[$aggressor][0];
		$fighting = false;
		$log .= $this->displayFighter($fighters, $target) . " decided to run away <br /><br />";
		
		$winner->addXP(round($fighters[$target][0]->LevelUpXP / 3));
		break;
	  }
	  
	  $aggressor = $target;
	  $roundCounter++;
    }


    return $log;
  }
  
  function chooseFirst($hero1, $hero2)
  {
    $init1 = $hero1->rollInitiative();
    $init2 = $hero2->rollInitiative();
	
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

  function displayName($hero, $is_mine)
  {
      $class = $is_mine ? "player" : "enemy";
      return "<span class='$class'>" . $hero->Name . "</span>";
  }
  function displayFighter($fighters, $ix)
  {
      return $this->displayName($fighters[$ix][0], $ix == 0);
  }

}
