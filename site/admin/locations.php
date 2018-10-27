<?php
chdir("../");
/*
$db = DB::GetConn();
print_r($db->query("INSERT INTO `Race` (`ID`, `Name`, `StrBon`, `DexBon`, `ConBon`, `IntelBon`, `WisBon`, `ChaBon`, `FteBon`, `OldAge`, `Description`, `StarterRace`) VALUES (NULL, 'Ghost', '-2', '2', '0', '0', '0', '2', '0', '100', 'Ghosts', '0');"));
echo "<br /><br />";
*/
include_once("bootstrap.php");
include_once("location/locationController.php");

//html header
$smarty->display("css/css.tpl");

$locationController = new locationController();

//menu
$smarty->display("menu.tpl");

/*********  show all Party  ***********/
$allLocations = $locationController->getAllLocations();
$smarty->assign("allLocations",$allLocations);
$smarty->display("admin/locations.tpl");
/*********  end show all Party  ***********/

chdir("admin/");
?>