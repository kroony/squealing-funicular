<?php
chdir("../");

include_once("bootstrap.php");

$db = DB::GetConn();
/*
print_r($db->query("ALTER TABLE `User` ADD `trainerLevel` TINYINT UNSIGNED NOT NULL AFTER `gold`;"));
echo "<br /><br />";
/*
print_r($db->query("ALTER TABLE `Location` CHANGE `rewardChance` `rewardChance` FLOAT NOT NULL;"));
echo "<br /><br />";

print_r($db->query("ALTER TABLE `Location` CHANGE `costChance` `costChance` FLOAT NOT NULL;"));
echo "<br /><br />";
/*
print_r($db->query("INSERT INTO `Race` (`ID`, `Name`, `StrBon`, `DexBon`, `ConBon`, `IntelBon`, `WisBon`, `ChaBon`, `FteBon`, `OldAge`, `Description`, `StarterRace`) VALUES (NULL, 'Ghost', '-2', '2', '0', '0', '0', '2', '0', '100', 'Ghosts', '0');"));
echo "<br /><br />";
*/
//html header
$smarty->display("css/css.tpl");

//menu
$smarty->display("menu.tpl");

/*********  show all Migrations  ***********/
$db = DB::GetConn();
$getQuery = "SELECT * FROM `migrations`;";
$res=$db->query($getQuery);//execute query

$migrations = array();
while($obj = $res->fetchObject())
{
  array_push($migrations, $obj);
}

$smarty->assign("migrations",$migrations);
$smarty->display("admin/migrations.tpl");
/*********  end show all Party  ***********/

chdir("admin/");

?>
