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
$smarty->assign("help","This page displays all the weapon you have. Weapons can be scrapped if not required, so long as they are not currently equipped.
					  Clicking the Weapon Name will allow you to upgrade and rename the weapon. 
					  Clicking a heroes name will show more detailed information about that hero.");
$smarty->assign("helpTitle","Weapons Page Help");
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

$smarty->assign("usersWeapons",$usersWeapons);
$smarty->display("inventory.tpl");
		  
?>
