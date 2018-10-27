<?php

include_once("fightLog.php");

class WeaponDamageResult
{
    public $isCrit;
    public $damage;
    function __construct($isCrit, $damage)
    {
        $this->isCrit = $isCrit;
        $this->damage = $damage;
    }
}

class WeaponBase
{
	public $ID;
	public $Name;
	public $DamageDie;
	public $DamageQuantity;
	public $MinOffset;
	public $MaxOffset;
	public $MinCrit;
	public $MaxCrit;
	public $DamageAttribute;
	public $NegativeNameAdjective;
	public $PositiveNameAdjective;
	public $StartingWeapon;
	
	function __construct($Name, $DamageDie, $DamageQuantity, $MinOffset, $MaxOffset, $MinCrit, $MaxCrit, $DamageAttribute, $NegativeNameAdjective, $PositiveNameAdjective, $StartingWeapon)
	{
		$this->Name = $Name;
		$this->DamageDie = $DamageDie;
		$this->DamageQuantity = $DamageQuantity;
		$this->MinOffset = $MinOffset;
		$this->MaxOffset = $MaxOffset;
		$this->MinCrit = $MinCrit;
		$this->MaxCrit = $MaxCrit;
		$this->DamageAttribute = $DamageAttribute;
		$this->NegativeNameAdjective = $NegativeNameAdjective;
		$this->PositiveNameAdjective = $PositiveNameAdjective;
		$this->StartingWeapon = $StartingWeapon;
	}
	
	function loadWeaponBase($ID)
	{
		//check ID is not blank and exists and such

		$db = DB::GetConn();
		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `weaponbase` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();

		$ReturnWeaponBase = new WeaponBase($obj->name,$obj->damagedie,$obj->damagequantity,$obj->minoffset,$obj->maxoffset,$obj->mincrit,$obj->maxcrit,$obj->damageattribute,$obj->negativenameadjective,$obj->positivenameadjective,$obj->startingweapon); 

		$ReturnWeaponBase->ID = $ID;

		return $ReturnWeaponBase;
	}
}

class Weapon
{
	public $ID;
	public $UserID;
	public $Name;
	public $DamageDie;
	public $DamageQuantity;
	public $DamageOffset;
	public $CritChance;
	public $DamageAttribute;

	function __construct($Name, $UserID, $DamageDie, $DamageQuantity, $DamageOffset, $CritChance, $DamageAttribute)
	{
		$this->Name = $Name;
		$this->UserID = $UserID;
		$this->DamageDie = $DamageDie;
		$this->DamageQuantity = $DamageQuantity;
		$this->DamageOffset = $DamageOffset;
		$this->CritChance = $CritChance;
		$this->DamageAttribute = $DamageAttribute;
	}
	
	function calcWeaponUpgradeCost($DamQuant, $DamDie, $DamOff, $Crit)
	{
		//get pre totals
		$preAverageDam = $this->DamageQuantity * ($this->DamageDie / 2 + 0.5) + $this->DamageOffset;
		$preMinDam = $this->DamageQuantity + $this->DamageOffset;
		$preMaxDam = $this->DamageQuantity * $this->DamageDie + $this->DamageOffset;
		$preTotal = $preAverageDam + $preMinDam + $preMaxDam;
		$preTotal = $preTotal * ($this->DamageQuantity + $this->CritChance / 100);//times total by 1.$crit 
		
		//get post totals		
		$postAverageDam = $DamQuant * ($DamDie / 2 + 0.5) + $DamOff;
		$postMinDam = $DamQuant + $DamOff;
		$postMaxDam = $DamQuant * $DamDie + $DamOff;
		$postTotal = $postAverageDam + $postMinDam + $postMaxDam;
		$postTotal = $postTotal * ($DamQuant + $Crit / 100);//times total by 1.$crit 
		
		$difference = $postTotal - $preTotal;
		return ceil((ceil($postTotal * $difference) * 5) * ($DamQuant + $Crit / 100));
	}
	
	function calcDamageQuantityUpgradeCost()
	{
		//return Weapon::calcWeaponUpgradeCost($this->DamageQuantity + 1, $this->DamageDie, $this->DamageOffset, $this->CritChance);
		$aveDieDamage = ($this->DamageDie / 2) + 0.5;
		$aveDamage = ($aveDieDamage * ($this->DamageQuantity + 1)) + $this->DamageOffset;
		$ave100 = $aveDamage * (100 + $this->CritChance);
		
		return ceil($ave100);
	}
	
	function calcDamageDieUpgradeCost()
	{
		//return Weapon::calcWeaponUpgradeCost($this->DamageQuantity, $this->DamageDie + 1, $this->DamageOffset, $this->CritChance);
		$aveDieDamage = (($this->DamageDie + 1) / 2) + 0.5;
		$aveDamage = ($aveDieDamage * $this->DamageQuantity) + $this->DamageOffset;
		$ave100 = $aveDamage * (100 + $this->CritChance);
		
		return ceil($ave100);
	}
	
	function calcDamageOffsetUpgradeCost()
	{
		//return Weapon::calcWeaponUpgradeCost($this->DamageQuantity, $this->DamageDie, $this->DamageOffset + 1, $this->CritChance);
		$aveDieDamage = ($this->DamageDie / 2) + 0.5;
		$aveDamage = ($aveDieDamage * $this->DamageQuantity) + ($this->DamageOffset + 1);
		$ave100 = $aveDamage * (100 + $this->CritChance);
		
		return ceil($ave100);
	}
	
	function calcCritChanceUpgradeCost()
	{
		//return Weapon::calcWeaponUpgradeCost($this->DamageQuantity, $this->DamageDie, $this->DamageOffset, $this->CritChance + 1) * 3.33;//crit is a little too cheap
		$aveDieDamage = ($this->DamageDie / 2) + 0.5;
		$aveDamage = ($aveDieDamage * $this->DamageQuantity) + $this->DamageOffset;
		$ave100 = $aveDamage * (100 + ($this->CritChance + 1));
		
		return ceil($ave100);
	}
	
	function getScrapValue($userChaBonus)
	{
		$scrapValue = 0;
		
		$scrapValue += $this->DamageDie * $this->DamageQuantity;
		$scrapValue += $this->DamageOffset;
		$scrapValue += $this->CritChance;
		
		$multiplyer = 1 + ($userChaBonus / 100);
		
		return round($scrapValue * $multiplyer);
	}
	
	function GetHeroNameFromWeapon()
	{
		$db = DB::GetConn();
		$weapon_con = $db->quoteInto("WeaponID = ?", $this->ID);
		$sql = "select Name from Hero where $weapon_con limit 1";
		$res = $db->query($sql);
		$obj = $res->fetchObject();
		if(is_object($obj))
		{
			return $obj->Name;
		}
		else
		{
			return "Not Equipped";
		}
	}
	
	function GetHeroIDFromWeapon()
	{
		$db = DB::GetConn();
		$weapon_con = $db->quoteInto("WeaponID = ?", $this->ID);
		$sql = "select ID from Hero where $weapon_con limit 1";
		$res = $db->query($sql);
		$obj = $res->fetchObject();
		if(is_object($obj))
		{
			return $obj->ID;
		}
		else
		{
			return "No ID";
		}
	}
	
	function GetSaleIDFromWeapon()
	{
		$db = DB::GetConn();
		$weapon_con = $db->quoteInto("ItemID = ?", $this->ID);
		$sql = "select ID from Sale where $weapon_con limit 1";
		$res = $db->query($sql);
		$obj = $res->fetchObject();
		if(is_object($obj))
		{
			return $obj->ID;
		}
		else
		{
			return "No ID";
		}
	}
	
	function isScrappable()
	{
		if($this->GetHeroIDFromWeapon() == "No ID" && $this->GetSaleIDFromWeapon() == "No ID")
		{
			return true;
		}
		return false;
	}

	//load Weapon from DB 
	//could just be called load?! 
	function loadWeapon($ID)
	{
		//check ID is not blank and exists and such

		$db = DB::GetConn();
		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `Weapon` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();
		return Weapon::loadWeaponFromObject($obj);
	}
	
	function loadWeaponFromObject($obj)
    {
		$returnWeapon = new Weapon("", "", "", "", "", "", "");
		$returnWeapon->ID = $obj->ID;
		$returnWeapon->UserID = $obj->UserID;
		$returnWeapon->Name = $obj->Name;
		$returnWeapon->DamageDie = $obj->DamageDie;
		$returnWeapon->DamageQuantity = $obj->DamageQuantity;
		$returnWeapon->DamageOffset = $obj->DamageOffset;
		$returnWeapon->CritChance = $obj->CritChance;
		$returnWeapon->DamageAttribute = $obj->DamageAttribute;

		return $returnWeapon;
	}

	function calcDamage($CritFteBonus, $HeroOffset)
	{
		$TotalDamage = 0;
		$ActiveDamageQuantity = $this->DamageQuantity;
		$ActiveDamageOffset = $this->DamageOffset;

		//check for crit damage
		$TotalCrit = $CritFteBonus + $this->CritChance;
        $crit = false;
		if(rand(1,100) <= $TotalCrit)
		{
			$ActiveDamageQuantity += $ActiveDamageQuantity;//we critted! double the number of dice to roll
			$ActiveDamageOffset += $ActiveDamageOffset;//And also double the weapon bonus
            $crit = true;
		}

		$i=0;//roll DamageDie number of DamageQuantity times and add to TotalDamage
		while($i < $ActiveDamageQuantity)
		{
			$TotalDamage += rand(1,$this->DamageDie);
			$i++;
		}

		$TotalDamage += $ActiveDamageOffset; //add weapon offset
		$TotalDamage += $HeroOffset; //add hero offset

		if($TotalDamage < 1)//damage is atleast 1
		{
			$TotalDamage = 1;
		}

		return new WeaponDamageResult($crit, $TotalDamage);
	}

	function generateStartingWeapon($UserID, $HighestAttribute)
	{
		//get a weapon base matching the highest attribute
		$db = DB::GetConn();
		
		$attribute_con = $db->quoteInto("damageattribute = ?", $HighestAttribute);
		$starting_con = $db->quoteInto("startingweapon = ?", 1);
		$getQuery = "SELECT * FROM `weaponbase` WHERE $attribute_con AND $starting_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();
		
		$rw = Weapon::generateWeapon($UserID, $obj->ID);
		return $rw;
	}
	
	function generateNPCWeapon($UserID, $HighestAttribute)
	{
		//get a weapon base matching the highest attribute
		$db = DB::GetConn();
		
		$attribute_con = $db->quoteInto("damageattribute = ?", $HighestAttribute);
		$npc_con = $db->quoteInto("npcweapon = ?", 1);
		$getQuery = "SELECT * FROM `weaponbase` WHERE $attribute_con AND $npc_con limit 1;";
		
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();
		
		$rw = Weapon::generateWeapon($UserID, $obj->ID);
		
		$rw->DamageOffset = (rand(1, 3) + rand(1, 3) + rand(1, 3) + rand(1, 3) + rand(1, 3) + rand(1, 3)) / 2 - 6; //6d3/2 - 6
		return $rw;
	}
	
	function generateWeapon($UserID, $WeaponBaseID)
	{
		$wb = WeaponBase::loadWeaponBase($WeaponBaseID);
		
		$rwName = $wb->Name;
		$rwDamageDie = $wb->DamageDie;
		$rwDamageQuantity = $wb->DamageQuantity;
		$rwDamageOffset = rand($wb->MinOffset, $wb->MaxOffset);//@TODO weight this on hero Fte
		$rwCritChance = rand($wb->MinCrit, $wb->MaxCrit);
		$rwDamageAttribute = $wb->DamageAttribute;
		
		if(($wb->MinOffset - $rwDamageOffset) == ($rwDamageOffset - $wb->MaxOffset)){
			$rwName = $wb->Name;
		} else if(($wb->MinOffset - $rwDamageOffset) < ($rwDamageOffset - $wb->MaxOffset)){ //better then normal
			$adjectives = explode("|", $wb->PositiveNameAdjective);
			$rwName = $adjectives[rand(0,count($adjectives) - 1)] . " " . $wb->Name;
		} else if(($wb->MinOffset - $rwDamageOffset) > ($rwDamageOffset - $wb->MaxOffset)){ //worse then normal
			$adjectives = explode("|", $wb->NegativeNameAdjective);
			$rwName = $adjectives[rand(0,count($adjectives) - 1)] . " " . $wb->Name;
		}
		
		return new Weapon($rwName, $UserID, $rwDamageDie, $rwDamageQuantity, $rwDamageOffset, $rwCritChance, $rwDamageAttribute);
	}
	
	function save()
	{
		$db = DB::GetConn();
		
		if($this->ID != null){
			$row = array("UserID"=>$this->UserID,
				"Name"=>$this->Name,
				"DamageDie"=>$this->DamageDie,
				"DamageQuantity"=>$this->DamageQuantity,
				"DamageOffset"=>$this->DamageOffset,
				"CritChance"=>$this->CritChance,
				"DamageAttribute"=>$this->DamageAttribute);
			$where = array($db->quoteInto("ID = ?", $this->ID));
			try {
				$db->update("Weapon", $row, $where);
			}
			catch(Exception $ex)
			{
				print_r($ex);
			} 
		} 
		else 
		{
			$row = array("UserID"=>$this->UserID,
				"Name"=>$this->Name,
				"DamageDie"=>$this->DamageDie,
				"DamageQuantity"=>$this->DamageQuantity,
				"DamageOffset"=>$this->DamageOffset,
				"CritChance"=>$this->CritChance,
				"DamageAttribute"=>$this->DamageAttribute);
			
			try {
				$db->insert("Weapon",$row);
				$id = $db->lastInsertId();
				$this->ID = $id;
				
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}	
	}
	
	function delete()
	{
		$db = DB::GetConn();
			
		$where = array($db->quoteInto("ID = ?", $this->ID));
		try {
			$db->delete("Weapon", $where);
		}
		catch(Exception $ex)
		{
			print_r($ex);
		} 
	}
}

?>
