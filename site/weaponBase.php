<?php

include_once("bootstrap.php");
include_once("hero/weaponController.php");

//html header
$smarty->display("css/css.tpl");

$weaponController = new weaponController();

$db = DB::GetConn();

print_r($db->query("UPDATE `weaponbase` SET `ID` = '5' WHERE `name` = 'Mace';"));
print_r($db->query("UPDATE `weaponbase` SET `ID` = '6' WHERE `name` = 'Longbow';"));
print_r($db->query("UPDATE `weaponbase` SET `ID` = '7' WHERE `name` = 'Rod';"));
print_r($db->query("UPDATE `weaponbase` SET `ID` = '8' WHERE `name` = 'Quarterstaff';"));

echo "RAN UPDATES";

//menu
$smarty->assign("currentpage","party");
$smarty->display("menu.tpl");

/*********  show all Party  ***********/
$weaponbases = $weaponController->getAllWeaponBase();
$smarty->assign("weaponBases",$weaponBases);
$smarty->display("weaponBase.tpl");
/*********  end show all Party  ***********/

?>
