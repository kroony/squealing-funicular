<?php

include("bootstrap.php");

/*********Add XP*********/
include_once("hero/hero.php");

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);

echo "current user ID: " . $currentUID . "<br />";
if($currentUID == 146)
{
	//echo $hero->getHighestWeaponStat() . "<br />";
	$hero->Weapon = Weapon::generateNPCWeapon($hero->GetOwner()->ID, $hero->getHighestWeaponStat());
	//save weapon 
	$hero->Weapon->save();		
	$hero->SaveHero();
}
else
{
	if($hero->Weapon->ID < 10)
	{
		$hero->Weapon = Weapon::generateStartingWeapon($hero->GetOwner()->ID, $hero->getHighestWeaponStat());
		//save weapon 
		$hero->Weapon->save();		
		$hero->SaveHero();
		
	}
	else{
		//stop generating weapons your weapon is ok!
	}
}
header("Location: home.php");
?>
