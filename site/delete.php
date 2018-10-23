<?php

include_once("bootstrap.php");
include_once("hero/hero.php");

//@TODO add undead races to DB and change current race to matching Undead Race

$Hero = new Hero();
$Hero = $Hero->loadHero($_REQUEST['ID']);

if($Hero->GetOwner()->ID == $currentUID)
{
	if(!$Hero->isAlive())
	{
		$Hero->GiveToUser(146);//give the Hero to the monster user @TODO stop using ID's 

		$Hero->CurrentHP = $Hero->MaxHP;
		
		$newRace = Race::loadRace($Hero->Race->ID + 4); //pretty hacky
		$Hero->Race = $newRace;
		
		//generate a new npc weapon
		$Hero->Weapon = $Hero->Weapon->generateNPCWeapon(146, $Hero->getHighestWeaponStat());
		$Hero->Weapon->save();
		
		$Hero->SaveHero();

		header("Location: guild.php");
	}
	else
	{
		echo "Im not even dead yet.";
	}
}
else
{
	echo "This isn't yours to delete.";
}
