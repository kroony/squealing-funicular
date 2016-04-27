<?php

include_once("../bootstrap.php");
include_once("../hero/hero.php");

//@TODO add undead races to DB and change current race to matching Undead Race

$Hero = new Hero();
$Hero = $Hero->loadHero($_REQUEST['ID']);

if($currentUID == 1)
{
	if(!$Hero->isAlive())
	{
		$Hero->GiveToUser(146);//give the Hero to the monster user @TODO stop using ID's 

		$Hero->Level = -1;
		$Hero->CurrentHP = $Hero->MaxHP;
		
		//generate a new npc weapon
		$Hero->Weapon = $Hero->Weapon->generateNPCWeapon(146, $Hero->getHighestWeaponStat());
		$Hero->Weapon->save();
		
		$Hero->SaveHero();

		header("Location: heroes.php");
	}
	else
	{
		echo "Im not even dead yet.";
	}
}
else
{
	echo "NO";
}
