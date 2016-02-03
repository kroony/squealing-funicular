<?php

chdir("../");

include_once("bootstrap.php");
include_once("hero/weaponController.php");

//html header
$smarty->display("css/css.tpl");

$weaponController = new weaponController();

//menu
$smarty->assign("currentpage","party");
$smarty->display("menu.tpl");

/*********  show all Party  ***********/
$weaponBases = $weaponController->getAllWeaponBase();
$smarty->assign("weaponBases",$weaponBases);
$smarty->display("admin/weaponBase.tpl");
/*********  end show all Party  ***********/

?>
