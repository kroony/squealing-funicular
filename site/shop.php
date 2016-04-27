<?php

include_once("bootstrap.php");
include_once("shop/shopController.php");
$shopController = new shopController();

include_once("hero/weaponController.php");
$weaponController = new weaponController();

//get potential sale weapons
$unequipedWeapons = $weaponController->getAllForUnattendedForUser($currentUID);
if(count($unequipedWeapons) > 0)
{
	$smarty->assign("unequipedWeapons", $unequipedWeapons);
}

include_once("user/user.php");
$user = new User();
$user = $user->load($currentUID);

//html header
$smarty->display("css/css.tpl");

//menu
$smarty->assign("currentpage","shop");
//$smarty->assign("help","This page displays all the weapon you have. Weapons can be scrapped if not required, so long as they are not currently equipped.
//					  Clicking the Weapon Name will allow you to upgrade and rename the weapon. 
//					  Clicking a heroes name will show more detailed information about that hero.");
//$smarty->assign("helpTitle","Weapons Page Help");
include_once("menu.php");
	  
if(isset($_REQUEST['action']))//check if we are doing anything
{
	if($_REQUEST['action'] == "createSale")
	{
		if(isset($_REQUEST['WeaponID']))
		{
			$saleWeapon = Weapon::loadWeapon($_REQUEST['WeaponID']);
			
			if(is_numeric($_REQUEST['price']) && $_REQUEST['price'] > 0)
			{
				$newSale = $shopController->createSale($currentUID, "Weapon", $saleWeapon->ID, $_REQUEST['price']);//add new sale
		
				$smarty->assign("message", $saleWeapon->Name . " has been listed for " . $scrapWeapon->getScrapValue($userChaBonus) . "gp");
			}
			else
			{
				$smarty->assign("error","Not a valid price");
			}
		}
		else
		{
			$smarty->assign("error","Unknown Sale Item");
		}
	}
}

$tmpWeapon = new Weapon("", 0, 0, 0, 0, 0, "");
$smarty->assign("tmpWeapon",$tmpWeapon);

$saleItems = $shopController->getAllForBuyer($currentUID);

$smarty->assign("saleItems",$saleItems);
$smarty->display("shop.tpl");
		  
?>
