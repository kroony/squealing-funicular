<?php

include_once("bootstrap.php");
$smarty->display("css/css.tpl");
/*********Add XP*********/
include_once("hero/pitController.php");
include_once("user/user.php");

$pit = new PitController();

$hero1 = new Hero();
$hero1 = $hero1->loadHero($_REQUEST['ID1']);

$hero2 = new Hero();
$hero2 = $hero2->loadHero($_REQUEST['ID2']);

if($hero1->canFight() == false || $hero2->canFight() == false)
{
	header( 'Location: home.php' );
	exit(0);
}

$log = $pit->oneOnOne($hero1, $hero2);

$smarty->assign("log",$log);
$smarty->assign("hero1",$hero1);
$smarty->assign("hero1_name",$hero1->displayName(true));
$smarty->assign("hero2",$hero2);
$smarty->assign("hero2_name",$hero2->displayName(false));




if($hero2->Level == -1 && $hero2->CurrentHP <= 0)//if we knock out a monster, loot their weapon
{
	//weapon Loot
	$weaponLootRoll = rand(1, 100);
	if($weaponLootRoll <= $hero1->Fte && $hero2->OwnerID == 146 && $hero2->Name != "Black Ninja")//only loot weapon sometimes
	{
		$hero2->Weapon->UserID = $hero1->OwnerID;
		$hero2->Weapon->save();
		$smarty->assign("WeaponLoot",$hero2->Weapon);
		
		$hero2->Weapon = Weapon::generateNPCWeapon($hero2->GetOwner()->ID, $hero2->getHighestWeaponStat());
		$hero2->Weapon->save();		
		$hero2->SaveHero();
	}
	
	//Gold Loot
	$loot = $hero2->calculateAttributeBonus($hero2->Str);
	$loot += $hero2->calculateAttributeBonus($hero2->Dex);
	$loot += $hero2->calculateAttributeBonus($hero2->Con);
	$loot += $hero2->calculateAttributeBonus($hero2->Intel);
	$loot += $hero2->calculateAttributeBonus($hero2->Wis);
	$loot += $hero2->calculateAttributeBonus($hero2->Cha);
	$loot += $hero2->calculateAttributeBonus($hero2->Fte);
	$loot += $hero2->calculateAttributeBonus($hero1->Fte);//add looters luck
	
	if($loot > 0)
	{
		$lootmod = $hero1->Fte / 10 + 1;
		$loot = rand(1, $loot * $lootmod);
		$smarty->assign("GoldLoot",$loot);
		
		$user = new User();
		$user = $user->load($hero1->OwnerID);
		$user->gold += $loot;
		
		$user->Save();
	}
}

//if the attacker is knocked out by a defending PC, the winner loots the weapon
/*if($hero1->CurrentHP <= 0 && $hero2->OwnerID != 146)
{
	$hero1->Weapon->UserID = $hero2->OwnerID;
	$hero1->Weapon->save();
	$smarty->assign("WeaponLost",$hero1->Weapon);
	
	$hero1->Weapon = Weapon::generateStartingWeapon($hero1->GetOwner()->ID, $hero1->getHighestWeaponStat());
	$hero1->Weapon->save();		
	$hero1->SaveHero();
}*///commented out as it does not foster PVP

$smarty->display("oneonone.tpl");

//check for kills
if($hero1->CurrentHP < (0 - $hero1->Con))
{
	$hero2->Kills++;
}
if($hero2->CurrentHP < (0 - $hero2->Con))
{
	$hero1->Kills++;
}//we save both lower

//save heroes
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

