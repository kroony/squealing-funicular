<?php

include_once("bootstrap.php");
include_once("hero/weaponController.php");
include_once("hero/heroController.php");

//html header
$smarty->display("css/css.tpl");

$weaponController = new weaponController();

//menu
$smarty->assign("currentpage","inventory");
$smarty->display("menu.tpl");
	  
/*********  show all inventory  ***********/

$tmpHero = new Hero();
$smarty->assign("tmpHero",$tmpHero);

$usersWeapons = $weaponController->getAllForUser($currentUID);
$smarty->assign("usersWeapons",$usersWeapons);
$smarty->display("inventory.tpl");
		  
/*********  end show all inventory  ***********/


?>
