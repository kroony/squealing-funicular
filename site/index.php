<?php

include("bootstrap.php");
include_once("hero/heroClass.php");
include_once("hero/race.php");

$db = DB::GetConn();

$getrefactor5Query = "UPDATE `AdvClass` SET `FavouredAttribute` = 'Intel' WHERE `AdvClass`.`ID` = 19;
UPDATE `AdvClass` SET `PrerequisiteAttribute` = 'Intel' WHERE `AdvClass`.`ID` = 19;
UPDATE `AdvClass` SET `FavouredAttribute` = 'Intel' WHERE `AdvClass`.`ID` = 26;
UPDATE `AdvClass` SET `FavouredAttribute` = 'Intel' WHERE `AdvClass`.`ID` = 27;
UPDATE `AdvClass` SET `PrerequisiteAttribute` = 'Intel' WHERE `AdvClass`.`ID` = 27;";
$res=$db->query($getrefactor5Query);//execute query
echo "refactor";

$getClassQuery = "SELECT Class,COUNT(*) as count FROM Hero Where OwnerID <> 146 GROUP BY Class ORDER BY count DESC;";
$res=$db->query($getClassQuery);//execute query
$ClassTableData = "['Class', 'Population'],";
while($obj = $res->fetchObject())
{
	$HeroClass = HeroClass::loadHeroClass($obj->Class);
	$ClassTableData .= "['" . $HeroClass->Name . "', " . $obj->count . "],";
}
$ClassTableData = rtrim($ClassTableData, ",");
$smarty->assign("ClassTableData",$ClassTableData);

$getRaceQuery = "SELECT Race,COUNT(*) as count FROM Hero Where OwnerID <> 146 GROUP BY Race ORDER BY count DESC;";
$res=$db->query($getRaceQuery);//execute query
$RaceTableData = "['Race', 'Population'],";
while($obj = $res->fetchObject())
{
	$HeroRace = Race::loadRace($obj->Race);
	$RaceTableData .= "['" . $HeroRace->Name . "', " . $obj->count . "],";
}
$RaceTableData = rtrim($RaceTableData, ",");
$smarty->assign("RaceTableData",$RaceTableData);

$smarty->display("index.tpl");

