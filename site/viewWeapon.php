<?php

include("bootstrap.php");
include_once("hero/weaponController.php");

//load User
include_once("user/user.php");
$user = new User();
$user = $user->load($currentUID);
$smarty->assign("user",$user);

$smarty->display("css/css.tpl");
include_once("menu.php");

$weaponController = new weaponController();

$weapon = new Weapon(0,0,0,0,0,0,0);
$weapon = $weapon->loadWeapon($_REQUEST['ID']);

if($weapon->UserID == $currentUID)//check weapon belongs to current user 
{
	if(isset($_REQUEST['action']))//check if we are doing anything
	{	
		if($_REQUEST['action'] == "editWeaponName")
		{
			$weapon = Weapon::loadWeapon($_REQUEST['WeaponID']);
			if($weapon->UserID == $currentUID)
			{
				$oldName = $weapon->Name;
				$weapon->Name = $_REQUEST['weaponName'];
				$weapon->save();
				
				$smarty->assign("message", $oldName . " was renamed to " . $weapon->Name);
				$smarty->assign("weapon",$weapon);
			}
			else
			{
				$smarty->assign("error","You can't rename what does not belong to you.");
			}
		}
		else if($_REQUEST['action'] == "upgradeQuantity")
		{
			if($user->canAfford($weapon->calcDamageQuantityUpgradeCost()))
			{
				$user->debit($weapon->calcDamageQuantityUpgradeCost());
				
				$weapon->DamageQuantity++;
				$weapon->save();
				
				$smarty->assign("weapon",$weapon);
			}
			else
			{
				$smarty->assign("error","You can't afford this upgrade.");
			}
		}
		else if($_REQUEST['action'] == "upgradeDie")
		{
			if($user->canAfford($weapon->calcDamageDieUpgradeCost()))
			{
				$user->debit($weapon->calcDamageDieUpgradeCost());
				
				$weapon->DamageDie++;
				$weapon->save();
				
				$smarty->assign("weapon",$weapon);
			}
			else
			{
				$smarty->assign("error","You can't afford this upgrade.");
			}
		}
		else if($_REQUEST['action'] == "upgradeOffset")
		{
			if($user->canAfford($weapon->calcDamageOffsetUpgradeCost()))
			{
				$user->debit($weapon->calcDamageOffsetUpgradeCost());
				
				$weapon->DamageOffset++;
				$weapon->save();
				
				$smarty->assign("weapon",$weapon);
			}
			else
			{
				$smarty->assign("error","You can't afford this upgrade.");
			}
		}
		else if($_REQUEST['action'] == "upgradeCrit")
		{
			if($user->canAfford($weapon->calcCritChanceUpgradeCost()))
			{
				$user->debit($weapon->calcCritChanceUpgradeCost());
				
				$weapon->CritChance++;
				$weapon->save();
				
				$smarty->assign("weapon",$weapon);
			}
			else
			{
				$smarty->assign("error","You can't afford this upgrade.");
			}
		}
	}
	else// we are just viewing Weapon
	{
		$smarty->assign("weapon",$weapon);
	}
}
else
{
	$smarty->assign("error","This weapon does not belong to you");
}

$smarty->display("viewWeapon.tpl");
?>

