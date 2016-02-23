<?php

include("bootstrap.php");
include_once("hero/heroController.php");
include_once("hero/weaponController.php");

$smarty->display("css/css.tpl");

$smarty->assign("help","Hero and weapon names can be edited by clicking the edit button located next to the respective name.
					    Equipped weapons can be changed if you have unused weapons in your inventory.
					    When a hero gains a level they increase their Max HP and sometimes increase an attribute. This is shown with the green up arrow icon.");
$smarty->assign("helpTitle","Hero Page Help");
$smarty->display("menu.tpl");

$heroController = new heroController();
$weaponController = new weaponController();

$currentTime = new DateTime('now');
$smarty->assign("currentTime", $currentTime);

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);

//Class Tree Diagram
$baseClass = $hero->HeroClass;
$childClasses = array();
if($baseClass->NextClass != null && $baseClass->NextClass != "")
{
	$childClassIDs = explode("|", $baseClass->NextClass);
	foreach($childClassIDs as $childClassID)
	{
		array_push($childClasses, HeroClass::loadHeroClass($childClassID));
	}
}
$smarty->assign("baseClass", $baseClass);
$smarty->assign("childClasses", $childClasses);

//Weapon
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
			$preXP = $hero->CurrentXP;
			
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
				if($preXP == 0){$smarty->assign("OldXP", $preXP);}
				
				$smarty->assign("message", $returnString);
				// if we levelled up then we can save hero
				$hero->SaveHero();
				
				$smarty->assign("hero",$hero);
			}
		}
		else if($_REQUEST['action'] == "Train")
		{
			//load User
			include_once("user/user.php");
			$user = new User();
			$user = $user->load($currentUID);

			if($_REQUEST['increase'] == "Str")
			{
				if($user->canAfford($hero->calculateAttributeUpgradeCost($hero->Str)))
				{
					$user->gold -= $hero->calculateAttributeUpgradeCost($hero->Str);
					$user->Save();
					
					$hero->Status = "Train Str";
					$hero->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d hours", $hero->Str + 1))));
					$hero->SaveHero();
					
					$smarty->assign("message", $hero->Name . " has begun training their Strength. It will take " . ($hero->Str + 1) . " hours to complete.");
				}
				else
				{
					$smarty->assign("error","Can not afford to increase Strength");
					$smarty->assign("hero",$hero);
				}
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

