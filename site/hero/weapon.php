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

		$ReturnWeaponBase = new WeaponBase($obj->Name,$obj->DamageDie,$obj->DamageQuantity,$obj->MinOffset,$obj->MaxOffset,$obj->MinCrit,$obj->MaxCrit,$obj->DamageAttribute,$obj->NegativeNameAdjective,$obj->PositiveNameAdjective,$obj->StartingWeapon); 

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
	//INSERT INTO `kr00ny_sf`.`Weapon` (`ID`, `Name`, `DamageDie`, `DamageQuantity`, `DamageOffset`, `CritChance`, `DamageAttribute`) 
	//VALUES (NULL, 'Sword', '6', '1', '1', '4', 'Str');

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

	//load Race from DB 
	function loadWeapon($ID)
	{
		//check ID is not blank and exists and such

		$db = DB::GetConn();
		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `Weapon` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();

		$ReturnWeapon = new Weapon($obj->Name,$obj->UserID,$obj->HeroID,$obj->DamageDie,$obj->DamageQuantity,$obj->DamageOffset,$obj->CritChance,$obj->DamageAttribute); 

		$ReturnWeapon->ID = $ID;

		return $ReturnWeapon;
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
		echo "Starting Weapon based on " . $HighestAttribute . "<br />";
		//get a weapon base matching the highest attribute
		$db = DB::GetConn();
		$attribute_con = $db->quoteInto("damageattribute = ?", $HighestAttribute);
		$getQuery = "SELECT * FROM `weaponbase` WHERE $attribute_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();
		echo "Picked to make a " . $obj->Name . "<br />";
		$rw = Weapon::generateWeapon($UserID, $obj->ID);
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
			$rwName = $adjectives[rand(0,count($adjectives))] . " " . $wb->Name;
		} else if(($wb->MinOffset - $rwDamageOffset) > ($rwDamageOffset - $wb->MaxOffset)){ //worse then normal
			$adjectives = explode("|", $wb->NegativeNameAdjective);
			$rwName = $adjectives[rand(0,count($adjectives))] . " " . $wb->Name;
		}
		
		return new Weapon($rwName, $UserID, $rwDamageDie, $rwDamageQuantity, $rwDamageOffset, $rwCritChance, $rwDamageAttribute);
	}
	
	function save()
	{
		$db = DB::GetConn();
		
		if($this->ID != null){
			//@TODO update weapon 
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

}

?>
