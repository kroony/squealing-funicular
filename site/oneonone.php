<?php

include_once("bootstrap.php");
include_once("hero/pitController.php");
include_once("user/user.php");
include_once("user/userController.php");

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

$smarty->display("css/css.tpl");

$log = $pit->oneOnOne($hero1, $hero2);

//send messages
userController::sendMessage($hero1->OwnerID, $hero2->OwnerID, "Your Hero " . $hero1->Name . " attacked " . $hero2->Name, $log->show());//aggressor
userController::sendMessage($hero2->OwnerID, $hero1->OwnerID, "Your Hero " . $hero2->Name . " was attacked by " . $hero1->Name, $log->show());//retaliator

//assign to template
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

$smarty->display("oneonone.tpl");

//check for kills
$deathUser = new User();
if(!$hero1->isAlive())
{
	$hero2->Kills++;//add kill to hero
	//add death to user
	$deathUser=User::load($hero1->OwnerID);
	$deathUser->deaths++;
	$deathUser->Save();
}
if(!$hero2->isAlive())
{
	$hero1->Kills++;//add kill to hero
	//add death to user
	$deathUser=User::load($hero2->OwnerID);
	$deathUser->deaths++;
	$deathUser->Save();
	
	
	//if hero 2 is monster and dead drop their level
	if($hero2->Level == -1)
	{
		$hero2->LevelUpXP = max($hero2->LevelUpXP - 200, 100);//drop their max HP
		$hero2->CurrentXP = 0;//reset their current XP
		$hero2->CurrentHP = 0;//reset hp to 0
		$hero2->MaxHP = max($hero2->MaxHP - $hero2->HeroClass->HD, $hero2->HeroClass->HD);//decrease their max HP
		$hero2->SaveHero();
	}
}

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

