<?php

include_once("fightLog.php");
include_once("race.php");
include_once("heroClass.php");
include_once("weapon.php");

class Hero
/*
//////perhaps have 2 weapons and an armor or 3 items of some sort to make things more indepth, laters problem.
/////// Death from old age? max age based on race? 1day IRL = 1 year
 */
{
	public $ID;
	public $OwnerID;
	public $PartyID;
	public $Name;
	public $Race;
	public $HeroClass;
	public $MaxHP;
	public $CurrentHP;
	public $Level;
	public $CurrentXP;
	public $LevelUpXP;
	public $Str;
	public $Dex;
	public $Con;
	public $Intel;
	public $Wis;
	public $Cha;
	public $Fte;
	public $Weapon;

	function __construct()
	{
	}

	//@todo move this to a user class and just have this call the function on the user class
	public function GetOwner()
	{
		$db = DB::GetConn();
		$user_con = $db->quoteInto("ID = ?",$this->OwnerID);
		$sql = "select * from User where $user_con limit 1";
		$res = $db->query($sql);
		return $res->fetchObject();
	}

	//load Adventurer from DB 
	function loadHero($ID)
	{
		$this->ID = $ID;
		//check ID is not blank and exists and such
		$db = DB::GetConn();

		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `Hero` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();

		$this->OwnerID =  $obj->OwnerID;
		$this->PartyID =  $obj->PartyID;
		$this->Race = Race::loadRace($obj->Race);
		$this->Name = $obj->Name;
		$this->HeroClass = HeroClass::loadHeroClass($obj->Class);
		$this->MaxHP = $obj->MaxHP;
		$this->CurrentHP = floor($obj->CurrentHP);
		$this->Level = $obj->Level;
		$this->CurrentXP = $obj->CurrentXP;
		$this->LevelUpXP = $obj->LevelUpXP;
		$this->Str = $obj->Str;
		$this->Dex = $obj->Dex;
		$this->Con = $obj->Con;
		$this->Intel = $obj->Intel;
		$this->Wis = $obj->Wis;
		$this->Cha = $obj->Cha;
		$this->Fte = $obj->Fte;
		$this->Weapon = Weapon::loadWeapon($obj->WeaponID);

		return $this;
	}

	function GenerateHero($level)
	{
		//Race
		$this->Race = $this->GenerateRace();
		echo "Race: " . $this->Race->Name . "<br />";

		//Name
		$this->Name = $this->Race->generateHeroName();
		echo "Name: " . $this->Name . "<br />";

		//Attributes
		echo "Str ";
		$this->Str = $this->GenerateAtribute($this->Race->StrBon);
		echo "Dex ";
		$this->Dex = $this->GenerateAtribute($this->Race->DexBon);
		echo "Con ";
		$this->Con = $this->GenerateAtribute($this->Race->ConBon);
		echo "Int ";
		$this->Intel = $this->GenerateAtribute($this->Race->IntelBon);
		echo "Wis ";
		$this->Wis = $this->GenerateAtribute($this->Race->WisBon);
		echo "Cha ";
		$this->Cha = $this->GenerateAtribute($this->Race->ChaBon);
		//echo "Fte ";
		$this->Fte = $this->GenerateAtribute($this->Race->FteBon);

		//Class
		$this->HeroClass = $this->GenerateHeroClass();
		echo "<br />Class: " . $this->HeroClass->Name . " HD: D" . $this->HeroClass->HD . "<br />";

		//HP
		$this->MaxHP = $this->HeroClass->HD + $this->calculateAttributeBonus($this->Con);  //base the multiplier on HD and con
		if($this->MaxHP < 1){$this->MaxHP = 1;}//stop negative max HP
		$this->CurrentHP = $this->MaxHP;
		echo "Hit Points: " . $this->CurrentHP . "/" . $this->MaxHP . "<br />";

		//Level
		$this->Level = 1;
		echo "Level:" . $this->Level . "<br />";

		//XP
		$XPBonus = rand(0, $this->Fte);
		$this->CurrentXP = 0;
		$this->LevelUpXP = 100 - $XPBonus;
		echo "XP: " . $this->CurrentXP . "/" . $this->LevelUpXP . " Luck Bonus: " . $XPBonus . "<br />";

		//check for levelup
		if($level > 1)
		{
			$i=0;
			while($i < $level - 1)
			{
				if($this->forceLevelUP())
				{
					$i++;
				}
				else
				{
					break;
				}
			}
		}
		
		if($this->Str >= $this->Dex && $this->Str >= $this->Intel && $this->Str >= $this->Wis){
			$this->Weapon = Weapon::generateStartingWeapon($this->GetOwner()->ID, "Str");
		} else if($this->Dex >= $this->Str && $this->Dex >= $this->Intel && $this->Dex >= $this->Wis) {
			$this->Weapon = Weapon::generateStartingWeapon($this->GetOwner()->ID, "Dex");
		} else if($this->Intel >= $this->Str && $this->Intel >= $this->Dex && $this->Intel >= $this->Wis) {
			$this->Weapon = Weapon::generateStartingWeapon($this->GetOwner()->ID, "Intel");
		} else if($this->Wis >= $this->Str && $this->Wis >= $this->Dex && $this->Wis >= $this->Intel) {
			$this->Weapon = Weapon::generateStartingWeapon($this->GetOwner()->ID, "Wis");
		} else {
			//not sure this should happen
			echo "<b>Bill check your highest attribute picker</b>";
		}
		//save weapon 
		$this->Weapon->save();
	}

	function GiveToUser($UID)
	{
		//check user exists
		$this->OwnerID = $UID;
	}

	function addXP($log, $XP)
	{
		$log->log("Current XP: " . $this->CurrentXP . "<br />");
		$log->log("Adding " . $XP . "XP<br />");
		$this->CurrentXP += $XP;//add the XP

		if($this->CurrentXP > $this->LevelUpXP)//if its more then the level up reduce it to the levelup amount
		{
			$this->CurrentXP = $this->LevelUpXP;
			$log->log("Time to try leveling up!<br />");
		}

		$log->log("New XP: " . $this->CurrentXP . "<br />");
	}

	function levelUP()
	{
		//returns true if it worked
		if($this->CurrentXP >= $this->LevelUpXP)//we have enough XP
		{
			$this->forceLevelUP();
			return true;
		}
		else
		{
			echo "Not Enough XP to level UP!<br />";
			return false;
		}
	}

	function forceLevelUP()//same as level up without the checks, used in character gen when XP shouldn't get in the way
	{
		if($this->Level == $this->HeroClass->LevelCap)//check if class is at Level cap
		{
			echo "<br />At " . $this->HeroClass->Name . " level cap, Trying to find new class<br />";
			if(!$this->HeroClass->checkForNewClass($this))
			{
				//no new class. have reached level cap.
				echo "Do not meet the requirements for any classes. :(<br /><br /><br />";
				//cant levelup, we are done here.
				return false;
			}
			else
			{
				//we found a new class and have applied it. now we can level
				echo "Have chosen class: " . $this->HeroClass->Name . "<br />";
			}
			//search for new class
		}
		//not at level cap, all good to continue

		//increase level
		$this->Level += 1;
		echo "<br /><br /><strong>Levelling to " . $this->Level . "</strong><br />";

		//add hp
		$extraHP = rand(1,$this->HeroClass->HD) + $this->calculateAttributeBonus($this->Con);
		if($extraHP < 1)//minimum 1 HP increase.
		{
			$extraHP = 1;
		}
		$this->MaxHP += $extraHP;
		$this->CurrentHP = $this->MaxHP; //healed when levelled up?? could be exploited....
		echo "Adding " . $extraHP . " HP. Rolled a d" . $this->HeroClass->HD . "+" . $this->calculateAttributeBonus($this->Con) . "<br />";

		//increase XP cap
		$this->CurrentXP = 0;
		//calc new bonus
		$newXPBonus = 0;
		$i=0;
		while($i < $this->Level)
		{
			$newXPBonus += rand(0, $this->Fte); //level D fate (1d6 -> foo D bar)
			$i++;
		}
		$this->LevelUpXP = (100 * pow($this->Level, 2)) - (100 * pow($this->Level - 1, 2)) - $newXPBonus;
		echo "New XP cap:" . $this->LevelUpXP . " XP Bonus this Level: " . $newXPBonus . "<br />";

		//increase 1 attribute
		$possibleAttribute = array("Str", "Dex", "Con", "Intel", "Wis", "Cha", "Fte");//dynamically create this array using a Class favoured Attribute, weighted with Fate
		if($this->calculateAttributeBonus($this->Fte) > 0)//add favoured bonus to array, for each fate bonus above 0
		{
			$i=0;
			while($i < $this->calculateAttributeBonus($this->Fte))
			{
				array_push($possibleAttribute, $this->HeroClass->FavouredAttribute);
				$i++;
			}
		}
		
		$pickAttribute = $possibleAttribute[rand(0, count($possibleAttribute) -1)];
		if      ($pickAttribute == "Str") {$this->Str++; echo "<b>Increase Str</b><br />";}
		else if($pickAttribute == "Dex") {$this->Dex++; echo "<b>Increase Dex</b><br />";}
		else if($pickAttribute == "Con") {$this->Con++; echo "<b>Increase Con</b><br />";}
		else if($pickAttribute == "Intel") {$this->Intel++; echo "<b>Increase Intel</b><br />";}
		else if($pickAttribute == "Wis") {$this->Wis++; echo "<b>Increase Wis</b><br />";}
		else if($pickAttribute == "Cha") {$this->Cha++; echo "<b>Increase Cha</b><br />";}
		//else if($pickAttribute == "Fte") {$this->Fte++; echo "<b>Increase Fte</b><br />";}

		return true;
	}

	function calculateAttributeBonus($attribute)
	{
		$bonus = floor(($attribute - 10) / 2);

		return $bonus;
	}

	function getAttributeByName($name)
	{
		if ($name == "Str")
			return $this->Str;
		else if ($name == "Dex")
			return $this->Dex;
		else if ($name == "Con")
			return $this->Con;
		else if ($name == "Intel")
			return $this->Intel;
		else if ($name == "Wis")
			return $this->Wis;
		else if ($name == "Cha")
			return $this->Cha;
		else if ($name == "Fte")
			return $this->Fte;
		else
			throw new Exception("Not a known attribute: $name");
	}

	function calcDamage($log)
	{
		$weapon = $this->Weapon;
		$attr   = $this->getAttributeByName($weapon->DamageAttribute);
		$bonus  = $this->calculateAttributeBonus($attr);
		$damage = $weapon->calcDamage($this->calculateAttributeBonus($this->Fte), $bonus);

        if ($damage->isCrit) {
            $log->log("<b>Crit!</b> ");
        }
        $log->logName($this->Name)
            ->log(" wields " . $this->Weapon->Name . " and strikes for " . $damage->damage)
            ->br();

		return $damage->damage;
	}

	function takeDamage($log, $damage)
	{
		$dexBon = $this->calculateAttributeBonus($this->Dex);
		$damageReduction = 0;

		if($dexBon > 0){
			$damageReduction = $dexBon;//dodge Damage Reduction
		}

		//$damageReduction += ARMOR;//Armor Damage Deduction

		$damage -= $damageReduction;

		if($damage < 1)//always take at least 1 damage
		{
			$damageReduction = $damageReduction + $damage - 1;//(add damage cause it will be a negative number)
			$damage = 1;
		}

		$this->CurrentHP -= $damage;
		$log->logName($this->Name)
            ->log(" mitigated " . $damageReduction . " damage.")
            ->br();
		return $damage;
	}

	function rollInitiative($log)
	{
		$roll = rand(1,20) + $this->calculateAttributeBonus($this->Wis);
		$log->logName($this->Name)
            ->log(" rolled " . $roll . " on initative.")
            ->br();
		return $roll;
	}

	function revive()
	{
		if ($this->CurrentHP <= 0 && $this->CurrentHP >= -$this->Con) {
			$this->CurrentHP = 1;
		}
	}

	function GenerateAtribute($bonus)
	{  
		//shitty 4d6 drop 1
		$diceRolled = array(rand(1, 6), rand(1, 6), rand(1, 6), rand(1, 6));
		rsort($diceRolled);//Sort the 4d6

		echo "Attribute Dice: " . $diceRolled[0] . ", " . $diceRolled[1] . ", " . $diceRolled[2] . " +" . $bonus . " Drop: " . $diceRolled[3] . " ";

		$attribute = $diceRolled[0] + $diceRolled[1] + $diceRolled[2] + $bonus;//add the highest 3 and the bonus passed in
		echo "<strong>Total: " . $attribute . " Bonus: " . $this->calculateAttributeBonus($attribute) . "</strong><br />";

		return $attribute;
	}

	function GenerateHeroClass()//all characters start as commoners
	{
		//@TODO:change to load(by name "commoner")
		$commoner = HeroClass::loadHeroClass(1);//1 is the ID of commoner. hacky!

		return $commoner;
	}

	function GenerateRace()
	{
		//@TODO:Load all StarterRaces from race table and pick a random one.
		$human = Race::loadRace(1);
		$dwarf = Race::loadRace(2);
		$elf = Race::loadRace(3);
		$halfling = Race::loadRace(4);

		$races = array($human, $dwarf, $elf, $halfling);

		$newRace = $races[rand(0,3)];

		return $newRace;
	}

	function SaveHero()//could be called just Save()??
	{
		//check shit is ok

		//if $ID !== null, update

		$db = DB::GetConn();
		if($this->ID != null)
		{
			$updateQuery = "UPDATE `kr00ny_sf`.`Hero` SET 
				`OwnerID` = " . $this->OwnerID . ", 
				`PartyID` = " . $this->PartyID . ", 
				`Name` = '" . $this->Name . "',  
				`Race` = " . $this->Race->ID . ",          
				`Class` = " . $this->HeroClass->ID . ",    
				`MaxHP` = " . $this->MaxHP . ",
				`CurrentHP` = " . $this->CurrentHP . ",
				`Level` = " . $this->Level . ",
				`CurrentXP` = " . $this->CurrentXP . ",
				`LevelUpXP` = " . $this->LevelUpXP . ",
				`Str` = " . $this->Str . ",
				`Dex` = " . $this->Dex . ",
				`Con` = " . $this->Con . ",
				`Intel` = " . $this->Intel . ",
				`Wis` = " . $this->Wis . ",
				`Cha` = " . $this->Cha . ",
				`Fte` = " . $this->Fte . ",
				`WeaponID` = " . $this->Weapon->ID . "
					WHERE `Hero`.`ID` = " . $this->ID . ";";
			// echo "Updating Hero: " . $updateQuery . "<br />";
			$db->query($updateQuery); //@todo change this to an associate array and use db->Update(...);
		}
		else //no id, add new character
		{
			$InsertQuery = "INSERT INTO `Hero` (`OwnerID`,                  `PartyID`, `Name`,            `Race`,                  `Class`,                    `MaxHP`,            `CurrentHP`,            `Level`,            `CurrentXP`,            `LevelUpXP`,            `Str`,            `Dex`,            `Con`,            `Intel`,          `Wis`,            `Cha`,            `Fte`,            `WeaponID`
				                      ) VALUES ('".$this->OwnerID."',       '0',       '".$this->Name."', '".$this->Race->ID."', '".$this->HeroClass->ID ."', '".$this->MaxHP."', '".$this->CurrentHP."', '".$this->Level."', '".$this->CurrentXP."', '".$this->LevelUpXP."', '".$this->Str."', '".$this->Dex."', '".$this->Con."', '".$this->Intel."', '".$this->Wis."', '".$this->Cha."', '".$this->Fte."', '".$this->Weapon->ID."');";
			$db->query($InsertQuery); //@todo change this to an associate array and use db->Insert(...);
		}

		//some sort of try catch error detection
	}

	function KillHero(){
		/*@TODO
		Change owner ID to that of the "Monster" user
		Change race to undead equivalent of current race
		If not equipped with a weapon, generate a new one
		*/
	}

    function displayName($is_mine)
    {
        $class = $is_mine ? "player" : "enemy";
        return "<span class='$class'>" . $this->Name . "</span>";
    }

}

?>
