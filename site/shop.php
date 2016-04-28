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
$smarty->assign("user",$user);

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
		
				$smarty->assign("message", $saleWeapon->Name . " has been listed for " . $newSale->Price . "gp");
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
	else if($_REQUEST['action'] == "cancelSale")
	{
		if(isset($_REQUEST['ID']))
		{
			$cancelSale = Sale::loadSale($_REQUEST['ID']);
			
			if($cancelSale->isSeller($currentUID))
			{
				$cancelSale->delete();
		
				$smarty->assign("message", "Sale item deleted");
			}
			else
			{
				$smarty->assign("error","Not your Sale to cancel");
			}
		}
		else
		{
			$smarty->assign("error","Unknown Sale Item");
		}
	}
	else if($_REQUEST['action'] == "buy")
	{
		if(isset($_REQUEST['ID']))
		{
			$buySale = Sale::loadSale($_REQUEST['ID']);
			
			if($buySale->isSeller($currentUID))
			{
				if($user->canAfford($buySale->Price))
				{
					$shopController->completeSale($buySale->ID, $currentUID);
		
					$smarty->assign("message", "Item Purchased");
				}
				else
				{
					$smarty->assign("error","you cant afford that");
				}
			}
			else
			{
				$smarty->assign("error","cant buy your own item");
			}
		}
		else
		{
			$smarty->assign("error","Unknown Sale Item");
		}
	}
}
//get sale items to populate table
$saleItems = $shopController->getAllForBuyer($currentUID);

$smarty->assign("saleItems",$saleItems);
$smarty->display("shop.tpl");
		  
?>
