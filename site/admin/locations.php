<?php
chdir("../");

include_once("bootstrap.php");
/*
$db = DB::GetConn();
print_r($db->query("INSERT INTO `Location` (`ID`, `name`, `description`, `requiredExploration`, `minLevel`, `maxLevel`, `rewardType`, `rewardChance`, `NPCFightChance`, `NPCList`, `distance`, `cost`, `costChance`, `linkHidden`, `URL`, `pageName`) VALUES (NULL, 'Trainer', 'Heroes can train their stats higher, for a price.', '30000', '0', '127', 'none', '0', '0', '', '15', '0', '0', '0', 'trainer.php', 'trainer');"));
echo "<br /><br />";
/*
print_r($db->query("INSERT INTO `Location` (`ID`, `name`, `description`, `requiredExploration`, `minLevel`, `maxLevel`, `rewardType`, `rewardChance`, `NPCFightChance`, `NPCList`, `distance`, `cost`, `costChance`, `linkHidden`, `URL`, `pageName`) VALUES (NULL, 'Town', 'All your heroes exploring town help to finding new locations, but while in town they run the risk of being attacked.', '0', '0', '127', 'Town-Exploration', '0.5', '0.1', '', '0', '0', '0', '0', 'town.php', 'town');"));
echo "<br /><br />";

print_r($db->query("INSERT INTO `Location` (`ID`, `name`, `description`, `requiredExploration`, `minLevel`, `maxLevel`, `rewardType`, `rewardChance`, `NPCFightChance`, `NPCList`, `distance`, `cost`, `costChance`, `linkHidden`, `URL`, `pageName`) VALUES (NULL, 'Healer', 'The town\'s local healer, heroes located at the healer will recover HP at twice the rate. Occasionally the Healer will ask for a donation, dismissing anyone that cant afford to pay.', '5000', '0', '127', 'none', '0', '0', '', '30', '1', '0.1', '0', 'healer.php', 'healer');"));
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