<?php

include_once("fightLog.php");
include_once("race.php");
include_once("heroClass.php");
include_once("weapon.php");

class Hero
/*
//////perhaps have 2 weapons and an armour or 3 items of some sort to make things more indepth, laters problem.
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
	public $Kills;
	public $Status;
	public $StatusTime;
	public $DateOfBirth;
	public $Age;

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

	//load Hero from DB 
	function loadHero($ID)
	{
		//check ID is not blank and exists and such
		$db = DB::GetConn();

		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `Hero` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();
        return Hero::loadHeroFromObject($obj);
    }

	function loadHeroFromObject($obj)
    {
		$returnHero = new Hero();
		$returnHero->ID = $obj->ID;
		$returnHero->OwnerID =  $obj->OwnerID;
		$returnHero->PartyID =  $obj->PartyID;
		$returnHero->Race = Race::loadRace($obj->Race);
		$returnHero->Name = $obj->Name;
		$returnHero->HeroClass = HeroClass::loadHeroClass($obj->Class);
		$returnHero->MaxHP = $obj->MaxHP;
		$returnHero->CurrentHP = floor($obj->CurrentHP);
		$returnHero->Level = $obj->Level;
		$returnHero->CurrentXP = $obj->CurrentXP;
		$returnHero->LevelUpXP = $obj->LevelUpXP;
		$returnHero->Str = $obj->Str;
		$returnHero->Dex = $obj->Dex;
		$returnHero->Con = $obj->Con;
		$returnHero->Intel = $obj->Intel;
		$returnHero->Wis = $obj->Wis;
		$returnHero->Cha = $obj->Cha;
		$returnHero->Fte = $obj->Fte;
		$returnHero->Weapon = Weapon::loadWeapon($obj->WeaponID);
		$returnHero->Kills = $obj->Kills;
		$returnHero->Status = $obj->Status;
		$returnHero->StatusTime = new DateTime($obj->StatusTime);
		$returnHero->DateOfBirth = new DateTime($obj->DateOfBirth);
		
		$now = new DateTime('now');
		$returnHero->Age = $returnHero->DateOfBirth->diff($now)->format('%d');
		
		return $returnHero;
	}

	function GenerateHero($level)
	{
		//Race
		$this->Race = $this->GenerateRace();

		//Name
		$this->Name = $this->Race->generateHeroName();

		//Attributes
		$this->Str = $this->GenerateAtribute($this->Race->StrBon);
		$this->Dex = $this->GenerateAtribute($this->Race->DexBon);
		$this->Con = $this->GenerateAtribute($this->Race->ConBon);
		$this->Intel = $this->GenerateAtribute($this->Race->IntelBon);
		$this->Wis = $this->GenerateAtribute($this->Race->WisBon);
		$this->Cha = $this->GenerateAtribute($this->Race->ChaBon);
		$this->Fte = $this->GenerateAtribute($this->Race->FteBon);

		//Class
		$this->HeroClass = $this->GenerateHeroClass();

		//HP
		$this->MaxHP = $this->HeroClass->HD + $this->calculateAttributeBonus($this->Con);  //base the multiplier on HD and con
		if($this->MaxHP < 1){$this->MaxHP = 1;}//stop negative max HP
		$this->CurrentHP = $this->MaxHP;

		//Level
		$this->Level = 1;

		//XP
		$XPBonus = rand(0, $this->Fte);
		$this->CurrentXP = 0;
		$this->LevelUpXP = 100 - $XPBonus;

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
		
		//Kills
		$this->Kills = 0;
		
		//dob
		$this->DateOfBirth = new DateTime('now');
	}
	
	function generateStartingWeapon()
	{
		$this->Weapon = Weapon::generateStartingWeapon($this->OwnerID, $this->getHighestWeaponStat());
		
		$this->Weapon->save();
	}
	
	function getHighestWeaponStat()
	{
		if($this->Str >= $this->Dex && $this->Str >= $this->Intel && $this->Str >= $this->Wis){
			return "Str";
		} else if($this->Dex >= $this->Str && $this->Dex >= $this->Intel && $this->Dex >= $this->Wis) {
			return "Dex";
		} else if($this->Intel >= $this->Str && $this->Intel >= $this->Dex && $this->Intel >= $this->Wis) {
			return "Intel";
		} else if($this->Wis >= $this->Str && $this->Wis >= $this->Dex && $this->Wis >= $this->Intel) {
			return "Wis";
		} else {
			//not sure this should happen
			echo "<b>Bill check your highest attribute picker</b>";
		}
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

		if($this->CurrentXP > $this->LevelUpXP)
		{
			//$this->CurrentXP = $this->LevelUpXP; //removed for leader board purposes 
			$log->log("Time to try leveling up!<br />");
		}

		$log->log("New XP: " . $this->CurrentXP . "<br />");
	}

	function levelUP()
	{
		//returns true if it worked
		if($this->CurrentXP >= $this->LevelUpXP)//we have enough XP
		{
			return $this->forceLevelUP();
		}
		else
		{
			return "Not Enough XP to level up";
		}
	}

	function forceLevelUP()//same as level up without the checks, used in character gen when XP shouldn't get in the way
	{
		$returnString = "";
		if($this->Level == $this->HeroClass->LevelCap)//check if class is at Level cap
		{
			$returnString .= "At " . $this->HeroClass->Name . " level cap, Trying to find new class<br />";
			if(!$this->HeroClass->checkForNewClass($this))
			{
				//no new class. have reached level cap.
				$returnString .= "Do not meet the requirements for any classes.";
				//cant levelup, we are done here.
				return $returnString;
			}
			else
			{
				//we found a new class and have applied it. now we can level
				$returnString .= "Have chosen class: " . $this->HeroClass->Name . "<br />";
			}
			//search for new class
		}
		//not at level cap, all good to continue

		//increase level
		$this->Level += 1;
		$returnString .= "<strong>Levelling to " . $this->Level . "</strong><br />";

		//add hp
		$extraHP = rand(1,$this->HeroClass->HD) + $this->calculateAttributeBonus($this->Con);
		if($extraHP < 1)//minimum 1 HP increase.
		{
			$extraHP = 1;
		}
		$this->MaxHP += $extraHP;
		$this->CurrentHP = $this->MaxHP; //healed when levelled up?? could be exploited....
		$returnString .= "Adding " . $extraHP . " HP. Rolled a d" . $this->HeroClass->HD . "+" . $this->calculateAttributeBonus($this->Con) . "<br />";

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
		$returnString .= "New XP cap:" . $this->LevelUpXP . " XP Bonus this Level: " . $newXPBonus . "<br />";

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
		if      ($pickAttribute == "Str") {$this->Str++;}
		else if($pickAttribute == "Dex") {$this->Dex++;}
		else if($pickAttribute == "Con") {$this->Con++;}
		else if($pickAttribute == "Intel") {$this->Intel++;}
		else if($pickAttribute == "Wis") {$this->Wis++;}
		else if($pickAttribute == "Cha") {$this->Cha++;}
		else if($pickAttribute == "Fte") {$this->Fte++;}

		return $returnString;
	}

	function calculateAttributeBonus($attribute)
	{
		$bonus = floor(($attribute - 10) / 2);

		return $bonus;
	}
	
	function calculateAttributeUpgradeCost($attribute)
	{
		return ($attribute + 1) * 100;
	}
	
	function calculateRunawayLimit()
	{
		$limit = $this->calculateAttributeBonus($this->Cha);
		if($this->Level > 0)
		{
			$limit += $this->Level;
		}
		else
		{
			$limit += ceil(($this->LevelUpXP - 100) / 2);
		}
		return $limit;
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

		$attribute = $diceRolled[0] + $diceRolled[1] + $diceRolled[2] + $bonus;//add the highest 3 and the bonus passed in

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

		$races = array($human, $human, $dwarf, $elf, $halfling);

		$newRace = $races[rand(0,4)];

		return $newRace;
	}

	function SaveHero()//could be called just Save()??
	{
		$db = DB::GetConn();
		if($this->ID != null)
		{
			$row = array("OwnerID"=>$this->OwnerID,
				"PartyID"=>0,
				"Name"=>$this->Name,
				"Race"=>$this->Race->ID,
				"Class"=>$this->HeroClass->ID,
				"MaxHP"=>$this->MaxHP,
				"CurrentHP"=>$this->CurrentHP,
				"Level"=>$this->Level,
				"CurrentXP"=>$this->CurrentXP,
				"LevelUpXP"=>$this->LevelUpXP,
				"Str"=>$this->Str,
				"Dex"=>$this->Dex,
				"Con"=>$this->Con,
				"Intel"=>$this->Intel,
				"Wis"=>$this->Wis,
				"Cha"=>$this->Cha,
				"Fte"=>$this->Fte, 
				"WeaponID"=>$this->Weapon->ID,
				"Kills"=>$this->Kills,
				"DateOfBirth"=>$this->DateOfBirth->format('Y-m-d H:i:s'),
				"Status"=>$this->Status,
				"StatusTime"=>$this->StatusTime->format('Y-m-d H:i:s'));
			$where = array($db->quoteInto("ID = ?", $this->ID));
			try {
				$db->update("Hero", $row, $where);
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}
		else //no id, add new hero
		{
			$row = array("OwnerID"=>$this->OwnerID,
				"PartyID"=>0,
				"Name"=>$this->Name,
				"Race"=>$this->Race->ID,
				"Class"=>$this->HeroClass->ID,
				"MaxHP"=>$this->MaxHP,
				"CurrentHP"=>$this->CurrentHP,
				"Level"=>$this->Level,
				"CurrentXP"=>$this->CurrentXP,
				"LevelUpXP"=>$this->LevelUpXP,
				"Str"=>$this->Str,
				"Dex"=>$this->Dex,
				"Con"=>$this->Con,
				"Intel"=>$this->Intel,
				"Wis"=>$this->Wis,
				"Cha"=>$this->Cha,
				"Fte"=>$this->Fte, 
				"WeaponID"=>$this->Weapon->ID,
				"Kills"=>$this->Kills,
				"DateOfBirth"=>$this->DateOfBirth->format('Y-m-d H:i:s'),
				"Status"=>$this->Status,
				"StatusTime"=>$this->StatusTime->format('Y-m-d H:i:s'));
			
			try {
				$db->insert("Hero",$row);
				$id = $db->lastInsertId();
				$this->ID = $id;
				
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}
	}

	function KillHero()
	{
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
