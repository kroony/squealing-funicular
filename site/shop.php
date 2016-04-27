<?php

include_once("bootstrap.php");
include_once("shop/shopController.php");
$shopController = new shopController();

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
		$saleWeapon = Weapon::loadWeapon($_REQUEST['ItemID']);
		if($scrapWeapon->UserID == $currentUID)
		{
			if(!is_numeric($scrapWeapon->GetHeroIDFromWeapon()))
			{
				$user->gold += $scrapWeapon->getScrapValue($userChaBonus);
				$user->Save();
				
				$scrapWeapon->delete();
				
				$smarty->assign("message", $scrapWeapon->Name . " has been scrapped for " . $scrapWeapon->getScrapValue($userChaBonus) . "gp");
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
$saleItems = $shopController->getAllForBuyer($currentUID);

$smarty->assign("saleItems",$saleItems);
$smarty->display("shop.tpl");
		  
?>
