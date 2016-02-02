<?php

include_once("bootstrap.php");
$smarty->display("css/css.tpl");
/*********Add XP*********/
include_once("hero/pitController.php");

$pit = new PitController();

$hero1 = new Hero();
$hero1 = $hero1->loadHero($_REQUEST['ID1']);

$smarty->assign("divFloatRight","False");
$smarty->assign("displayHero",$hero1);
$smarty->display("displayHeroCombat.tpl");

$hero2 = new Hero();
$hero2 = $hero2->loadHero($_REQUEST['ID2']);

$smarty->assign("divFloatRight","True");
$smarty->assign("displayHero",$hero2);
$smarty->display("displayHeroCombat.tpl");

$log = $pit->oneOnOne($hero1, $hero2);

$smarty->assign("log",$log);
$smarty->assign("hero1",$hero1);
$smarty->assign("hero1_name",$hero1->displayName(true));
$smarty->assign("hero2",$hero2);
$smarty->assign("hero2_name",$hero2->displayName(false));

if($hero2->Level == -1 && $hero2->CurrentHP <= 0)//if we knock out a monster, loot their weapon
{
	$hero2->Weapon->UserID = $hero1->OwnerID;
	$hero2->Weapon->save();
	$smarty->assign("WeaponLoot",$hero2->Weapon);
	
	$hero2->Weapon = Weapon::generateNPCWeapon($hero2->GetOwner()->ID, $hero2->getHighestWeaponStat());
	$hero2->Weapon->save();		
	$hero2->SaveHero();
}

//if the attacker is knocked out by a defending PC, the winner loots the weapon
if($hero1->CurrentHP <= 0 && $hero2->OwnerID != 146)
{
	$hero1->Weapon->UserID = $hero2->OwnerID;
	$hero1->Weapon->save();
	$smarty->assign("WeaponLost",$hero1->Weapon);
	
	$hero1->Weapon = Weapon::generateStartingWeapon($hero1->GetOwner()->ID, $hero1->getHighestWeaponStat());
	$hero1->Weapon->save();		
	$hero1->SaveHero();
}

$smarty->display("oneonone.tpl");


//save heros
$hero1->SaveHero();
if ($hero2->Level != -1)
{
	$hero2->SaveHero();
}
else //Monster AI
{
  if($hero2->CurrentXP >= $hero2->LevelUpXP)
  {
	//level up
	$preXP = $hero2->LevelUpXP;
	$hero2->LevelUp();
	$hero2->Level = -1;
	$hero2->LevelUpXP = $preXP + 200;
  }
  else
  {
	/*if($hero2->CurrentHP > 0)//if still concious, heal
	{
		$hero2->CurrentHP = $hero2->MaxHP;
	}*/
  }
  $hero2->SaveHero();
}

