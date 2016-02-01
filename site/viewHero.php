<?php

include("bootstrap.php");
include_once("hero/heroController.php");
include_once("hero/weaponController.php");

$smarty->display("css/css.tpl");

$smarty->display("menu.tpl");

$heroController = new heroController();
$weaponController = new weaponController();



$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);

$allWeapons = $weaponController->getAllForUser($currentUID);
$unequipedWeapons = array();
foreach($allWeapons as $weapon)
{
	if(!is_numeric($weapon->GetHeroIDFromWeapon()))
	{
		array_push($unequipedWeapons, $weapon);
	}
}
if(count($unequipedWeapons) > 0)
{
	$smarty->assign("unequipedWeapons", $unequipedWeapons);
}

if($hero->GetOwner()->ID == $currentUID)//check hero belongs to current user 
{
	if(isset($_REQUEST['action']))//check if we are doing anything
	{	
		if($_REQUEST['action'] == "editName")
		{
			if($_REQUEST['heroName'] != "" && $_REQUEST['heroName'] != null)
			{
				$oldName = $hero->Name;
				$hero->Name = $_REQUEST['heroName'];
				$hero->SaveHero();
				
				$smarty->assign("message", $oldName . " was renamed to " . $hero->Name);
				$smarty->assign("hero",$hero);
			}
			else
			{
				$smarty->assign("error","Hero's name can not be blank");
				$smarty->assign("hero",$hero);
			}
		}
		else if($_REQUEST['action'] == "changeWeapon")
		{
			$weapon = Weapon::loadWeapon($_REQUEST['WeaponID']);
			
			if($weapon->UserID == $currentUID)
			{
				$hero->Weapon = $weapon;
				$hero->SaveHero();
				$smarty->assign("hero",$hero);
				$smarty->assign("message", $hero->Name . " has equipped " . $weapon->Name);
			}
			else
			{
				$smarty->assign("error","That does not belong to you.");
			}
		}
		else if($_REQUEST['action'] == "editWeaponName")
		{
			$weapon = Weapon::loadWeapon($_REQUEST['WeaponID']);
			if($weapon->UserID == $currentUID)
			{
				$oldName = $weapon->Name;
				$weapon->Name = $_REQUEST['weaponName'];
				$weapon->save();
				
				$smarty->assign("message", $oldName . " was renamed to " . $weapon->Name);
				$hero->Weapon = $weapon;
				$smarty->assign("hero",$hero);
			}
			else
			{
				$smarty->assign("error","You can't rename what does not belong to you.");
			}
		}
		else if($_REQUEST['action'] == "levelUp")
		{
			$preStr = $hero->Str;
			$preDex = $hero->Dex;
			$preCon = $hero->Con;
			$preIntel = $hero->Intel;
			$preWis = $hero->Wis;
			$preCha = $hero->Cha;
			$preLevel = $hero->Level;
			$preClass = $hero->HeroClass->Name;
			$preHP = $hero->MaxHP;
			
			$returnString = $hero->LevelUP();
			
			if($returnString == "Not Enough XP to level up")
			{
				$smarty->assign("error","Not Enough XP to level up.");
				$smarty->assign("hero",$hero);
			}
			else
			{
				if($preStr < $hero->Str){$smarty->assign("StrIncrease", true);}
				if($preDex < $hero->Dex){$smarty->assign("DexIncrease", true);}
				if($preCon < $hero->Con){$smarty->assign("ConIncrease", true);}
				if($preIntel < $hero->Intel){$smarty->assign("IntelIncrease", true);}
				if($preWis < $hero->Wis){$smarty->assign("WisIncrease", true);}
				if($preCha < $hero->Cha){$smarty->assign("ChaIncrease", true);}
				
				if($preLevel < $hero->Level){$smarty->assign("LevelIncrease", true);}
				if($preClass != $hero->HeroClass->Name){$smarty->assign("ClassChange", $preClass);}
				if($preHP < $hero->MaxHP){$smarty->assign("HPIncrease", $hero->MaxHP - $preHP);}
				
				$smarty->assign("message", $returnString);
				// if we levelled up then we can save hero
				$hero->SaveHero();
				
				$smarty->assign("hero",$hero);
			}
		}
	}
	else// we are just viewing hero
	{
		$smarty->assign("hero",$hero);
	}
}
else
{
	$smarty->assign("error","This hero does not belong to you");
}

$smarty->display("viewHero.tpl");
?>

