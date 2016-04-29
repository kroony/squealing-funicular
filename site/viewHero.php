<?php

include("bootstrap.php");
include_once("hero/heroController.php");
include_once("hero/weaponController.php");

//load User
include_once("user/user.php");
$user = new User();
$user = $user->load($currentUID);
$smarty->assign("user",$user);

$smarty->display("css/css.tpl");

$smarty->assign("help","Hero and weapon names can be edited by clicking the edit button located next to the respective name.
					    Equipped weapons can be changed if you have unused weapons in your inventory.
					    When a hero gains a level they increase their Max HP and sometimes increase an attribute. This is shown with the green up arrow icon.");
$smarty->assign("helpTitle","Hero Page Help");
include_once("menu.php");

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
$unequipedWeapons = $weaponController->getAllForUnattendedForUser($currentUID);
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
			if($hero->canLevelUp())
			{
				if($hero->Status == "")
				{
					$hero->Status = "Level Up";
					$hero->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d minutes", $hero->Level))));
					$hero->SaveHero();
					$hero = $hero->loadHero($_REQUEST['ID']);//load to get get the time 
					
					$smarty->assign("message", $hero->Name . " has begun the process of Levelling up. It will take " . $hero->Level . " minutes to complete.");
					$smarty->assign("hero",$hero);
				}
				else if($hero->Status == "Level Up")
				{
					$smarty->assign("error","The level up process has already begun.");
					$smarty->assign("hero",$hero);
				}
				else
				{
					$smarty->assign("error","Hero is busy, cant level up at this time.");
					$smarty->assign("hero",$hero);
				}
			}
			else
			{
				if ($hero->CurrentXP < $hero->LevelUpXP)
				{
					$smarty->assign("error","Not Enough XP to level up.");
					$smarty->assign("hero",$hero);
				}
				else
				{
					$smarty->assign("error","No class beyond this can be taken at this time.");
					$smarty->assign("hero",$hero);
				}
			}
		}
		else if($_REQUEST['action'] == "FinishlevelUp")
		{
			if($hero->StatusETA == 'None' && $hero->Status == "Level Up")
			{
				$hero->Status = "";
				
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
					$hero->Status = "";
					$hero->SaveHero();
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
			else
			{
				$smarty->assign("error","Have not finished levelling up");
				$smarty->assign("hero",$hero);
			}
		}
		else if($_REQUEST['action'] == "Train")
		{
			//load User for gold spending
			include_once("user/user.php");
			$user = new User();
			$user = $user->load($currentUID);

			if($_REQUEST['increase'] == "Str")
			{
				if($user->canAfford($hero->calculateAttributeUpgradeCost($hero->Str)))
				{
					$user->debit($hero->calculateAttributeUpgradeCost($hero->Str));
					
					$hero->Status = "Train Str";
					$hero->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d minutes", ($hero->Str + 1) * 10))));
					$hero->SaveHero();
					$hero = $hero->loadHero($_REQUEST['ID']);//load to get get the time 
					
					$smarty->assign("message", $hero->Name . " has begun training their Strength. It will take " . (($hero->Str + 1) * 10) . " minutes to complete.");
				}
				else
				{
					$smarty->assign("error","Can not afford to increase Strength");
				}
			}
			else if($_REQUEST['increase'] == "Dex")
			{
				if($user->canAfford($hero->calculateAttributeUpgradeCost($hero->Dex)))
				{
					$user->debit($hero->calculateAttributeUpgradeCost($hero->Dex));
					
					$hero->Status = "Train Dex";
					$hero->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d minutes", ($hero->Dex + 1) * 10))));
					$hero->SaveHero();
					$hero = $hero->loadHero($_REQUEST['ID']);//load to get get the time 
					
					$smarty->assign("message", $hero->Name . " has begun training their Dexterity. It will take " . (($hero->Dex + 1) * 10) . " minutes to complete.");
				}
				else
				{
					$smarty->assign("error","Can not afford to increase Dexterity");
				}
			}
			else if($_REQUEST['increase'] == "Con")
			{
				if($user->canAfford($hero->calculateAttributeUpgradeCost($hero->Con)))
				{
					$user->debit($hero->calculateAttributeUpgradeCost($hero->Con));
					
					$hero->Status = "Train Con";
					$hero->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d minutes", ($hero->Con + 1) * 10))));
					$hero->SaveHero();
					$hero = $hero->loadHero($_REQUEST['ID']);//load to get get the time 
					
					$smarty->assign("message", $hero->Name . " has begun training their Constitution. It will take " . (($hero->Con + 1) * 10) . " minutes to complete.");
				}
				else
				{
					$smarty->assign("error","Can not afford to increase Constitution");
				}
			}
			else if($_REQUEST['increase'] == "Intel")
			{
				if($user->canAfford($hero->calculateAttributeUpgradeCost($hero->Intel)))
				{
					$user->debit($hero->calculateAttributeUpgradeCost($hero->Intel));
					
					$hero->Status = "Train Intel";
					$hero->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d minutes", ($hero->Intel + 1) * 10))));
					$hero->SaveHero();
					$hero = $hero->loadHero($_REQUEST['ID']);//load to get get the time 
					
					$smarty->assign("message", $hero->Name . " has begun training their Intelligence. It will take " . (($hero->Intel + 1) * 10) . " minutes to complete.");
				}
				else
				{
					$smarty->assign("error","Can not afford to increase Intelligence");
				}
			}
			else if($_REQUEST['increase'] == "Wis")
			{
				if($user->canAfford($hero->calculateAttributeUpgradeCost($hero->Wis)))
				{
					$user->debit($hero->calculateAttributeUpgradeCost($hero->Wis));
					
					$hero->Status = "Train Wis";
					$hero->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d minutes",($hero->Wis + 1) * 10))));
					$hero->SaveHero();
					$hero = $hero->loadHero($_REQUEST['ID']);//load to get get the time 
					
					$smarty->assign("message", $hero->Name . " has begun training their Wisdom. It will take " . (($hero->Wis + 1) * 10) . " minutes to complete.");
				}
				else
				{
					$smarty->assign("error","Can not afford to increase Wisdom");
				}
			}
			else if($_REQUEST['increase'] == "Cha")
			{
				if($user->canAfford($hero->calculateAttributeUpgradeCost($hero->Cha)))
				{
					$user->debit($hero->calculateAttributeUpgradeCost($hero->Cha));
					
					$hero->Status = "Train Cha";
					$hero->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d minutes", ($hero->Cha + 1) * 10))));
					$hero->SaveHero();
					$hero = $hero->loadHero($_REQUEST['ID']);//load to get get the time 
					
					$smarty->assign("message", $hero->Name . " has begun training their Charisma. It will take " . (($hero->Cha + 1) * 10) . " minutes to complete.");
				}
				else
				{
					$smarty->assign("error","Can not afford to increase Charisma");
				}
			}
		}
		else if($_REQUEST['action'] == "FinishTrain")
		{
			if($hero->StatusETA == 'None')
			{
				if($_REQUEST['increase'] == "Str" && $hero->Status == "Train Str")
				{
					$hero->Str++;
					$hero->Status = "";
					$hero->SaveHero();
					
					//outputs
					$smarty->assign("message", $hero->Name . " has finished their Strength training.");
					$smarty->assign("StrIncrease", true);
				}
				else if($_REQUEST['increase'] == "Dex" && $hero->Status == "Train Dex")
				{
					$hero->Dex++;
					$hero->Status = "";
					$hero->SaveHero();
					
					//outputs
					$smarty->assign("message", $hero->Name . " has finished their Dexterity training.");
					$smarty->assign("DexIncrease", true);
				}
				else if($_REQUEST['increase'] == "Con" && $hero->Status == "Train Con")
				{
					$hero->Con++;
					$hero->Status = "";
					$hero->SaveHero();
					
					//outputs
					$smarty->assign("message", $hero->Name . " has finished their Constitution training.");
					$smarty->assign("ConIncrease", true);
				}
				else if($_REQUEST['increase'] == "Intel" && $hero->Status == "Train Intel")
				{
					$hero->Intel++;
					$hero->Status = "";
					$hero->SaveHero();
					
					//outputs
					$smarty->assign("message", $hero->Name . " has finished their Intelligence training.");
					$smarty->assign("IntelIncrease", true);
				}
				else if($_REQUEST['increase'] == "Wis" && $hero->Status == "Train Wis")
				{
					$hero->Wis++;
					$hero->Status = "";
					$hero->SaveHero();
					
					//outputs
					$smarty->assign("message", $hero->Name . " has finished their Wisdom training.");
					$smarty->assign("WisIncrease", true);
				}
				else if($_REQUEST['increase'] == "Cha" && $hero->Status == "Train Cha")
				{
					$hero->Cha++;
					$hero->Status = "";
					$hero->SaveHero();
					
					//outputs
					$smarty->assign("message", $hero->Name . " has finished their Charisma training.");
					$smarty->assign("ChaIncrease", true);
				}
				else
				{
					$smarty->assign("error","A problem occurred attempting to finish training");
				}
			}
			else
			{
				$smarty->assign("error","Have not finished training time");
			}
		}
	}
	else// we are just viewing hero
	{
		$smarty->assign("hero",$hero);
	}
	$smarty->assign("hero",$hero);
}
else
{
	$smarty->assign("error","This hero does not belong to you");
	$smarty->assign("hero",null);
}

$smarty->display("viewHero.tpl");
?>

