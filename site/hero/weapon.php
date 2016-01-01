<?php

class Weapon
{
	public $ID;
	public $Name;
	public $DamageDie;
	public $DamageQuantity;
	public $DamageOffset;
	public $CritChance;
	public $DamageAttribute;
	//abilities or more unique bonuses?
	//INSERT INTO `kr00ny_sf`.`Weapon` (`ID`, `Name`, `DamageDie`, `DamageQuantity`, `DamageOffset`, `CritChance`, `DamageAttribute`) 
	//VALUES (NULL, 'Sword', '6', '1', '1', '4', 'Str');

	function __construct($Name, $DamageDie, $DamageQuantity, $DamageOffset, $CritChance, $DamageAttribute)
	{
		$this->Name = $Name;
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

		$ReturnWeapon = new Weapon($obj->Name,$obj->DamageDie,$obj->DamageQuantity,$obj->DamageOffset,$obj->CritChance,$obj->DamageAttribute); 

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
		if(rand(1,100) <= $TotalCrit)
		{
			$ActiveDamageQuantity += $ActiveDamageQuantity;//we critted! double the number of dice to roll
			$ActiveDamageOffset += $ActiveDamageOffset;//And also double the weapon bonus
			echo "<b>Crit!</b> ";
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

		return $TotalDamage;
	}



	function generateWeaponName()
	{

	}

}

?>
