<?php
chdir("../");

include_once("bootstrap.php");

$db = DB::GetConn();
/*
print_r($db->query("CREATE TABLE `Location` (
  `ID` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `requiredExploration` bigint(20) UNSIGNED NOT NULL,
  `minLevel` tinyint(4) NOT NULL,
  `maxLevel` tinyint(4) NOT NULL,
  `rewardType` tinytext NOT NULL,
  `rewardChance` decimal(10,0) NOT NULL,
  `NPCFightChance` decimal(10,0) NOT NULL,
  `NPCList` tinytext NOT NULL,
  `distance` smallint(5) UNSIGNED NOT NULL,
  `cost` smallint(6) NOT NULL,
  `costChance` decimal(10,0) NOT NULL,
  `linkHidden` tinyint(1) NOT NULL,
  `URL` tinytext NOT NULL,
  `pageName` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;"));
echo "<br /><br />";

print_r($db->query("ALTER TABLE `Location`
  ADD PRIMARY KEY (`ID`);"));
echo "<br /><br />";

print_r($db->query("ALTER TABLE `Location`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;"));
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
