<?php

include_once("bootstrap.php");
include_once("hero/weaponController.php");
include_once("hero/heroController.php");
include_once("user/user.php");

//html header
$smarty->display("css/css.tpl");

$weaponController = new weaponController();

//menu
$smarty->assign("currentpage","inventory");
$smarty->display("menu.tpl");
	  
if(isset($_REQUEST['action']))//check if we are doing anything
{
	if($_REQUEST['action'] == "scrap")
	{
		$scrapWeapon = Weapon::loadWeapon($_REQUEST['ID']);
		if($scrapWeapon->UserID == $currentUID)
		{
			if(!is_numeric($scrapWeapon->GetHeroIDFromWeapon()))
			{
				$user = new User();
				$user = $user->load($currentUID);
				$user->gold += $scrapWeapon->getScrapValue();
				$user->Save();
				
				$scrapWeapon->delete();
				
				$smarty->assign("message", $scrapWeapon->Name . " has been scrapped for " . $scrapWeapon->getScrapValue() . "gp");
			}
			else
			{
				$smarty->assign("error","Can not scrap equipped weapons");
			}
		}
		else
		{
			$smarty->assign("error","This is not your weapon to scrap");
		}
	}
}

$tmpHero = new Hero();
$smarty->assign("tmpHero",$tmpHero);

$usersWeapons = $weaponController->getAllForUser($currentUID);


//fix monster weapons
$allWeapons = $weaponController->getAll();
foreach($allWeapons as &$weapon)
{
	$heroID = $weapon->GetHeroIDFromWeapon();
	if(is_numeric($weapon->GetHeroIDFromWeapon())
	{
		$tmpHero->loadHero($heroID);
		if($tmpHero->UserID != $weapon->UserID)
		{
			if($tmpHero->UserID == 146)
			{
				//generate new weapon for tmpHero
				$tmpHero->Weapon = $tmpHero->Weapon->generateNPCWeapon(146, $tmpHero->getHighestWeaponStat());
				$tmpHero->Weapon->save();
				$tmpHero->SaveHero();
				
				//delete weapon
				$weapon->delete();
			}
		}
	}
}

$smarty->assign("usersWeapons",$usersWeapons);
$smarty->display("inventory.tpl");
		  



?>
