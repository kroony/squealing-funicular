<?php

include("bootstrap.php");
include_once("hero/heroClass.php");
include_once("hero/race.php");

$db = DB::GetConn();

//get Class Count
$getClassQuery = "SELECT Class,COUNT(*) as count FROM Hero Where OwnerID <> 146 AND CurrentHP > 0 GROUP BY Class ORDER BY count DESC;";
$res=$db->query($getClassQuery);//execute query
$ClassTableData = "['Class', 'Population'],";
while($obj = $res->fetchObject())
{
	$HeroClass = HeroClass::loadHeroClass($obj->Class);
	$ClassTableData .= "['" . $HeroClass->Name . "', " . $obj->count . "],";
}
$ClassTableData = rtrim($ClassTableData, ",");
$smarty->assign("ClassTableData",$ClassTableData);

//get Race count
$getRaceQuery = "SELECT Race,COUNT(*) as count FROM Hero Where OwnerID <> 146 AND CurrentHP > 0 GROUP BY Race ORDER BY count DESC;";
$res=$db->query($getRaceQuery);//execute query
$RaceTableData = "['Race', 'Population'],";
while($obj = $res->fetchObject())
{
	$HeroRace = Race::loadRace($obj->Race);
	$RaceTableData .= "['" . $HeroRace->Name . "', " . $obj->count . "],";
}
$RaceTableData = rtrim($RaceTableData, ",");
$smarty->assign("RaceTableData",$RaceTableData);

//Get Level Count
$getLevelQuery = "SELECT Level,COUNT(*) as count FROM Hero Where OwnerID <> 146 AND CurrentHP > 0 GROUP BY Level ORDER BY Level ASC;";
$res=$db->query($getLevelQuery);//execute query
$LevelTableData = "";
$i = 1;
$obj = $res->fetchObject();
while($i <= 50)
{
	if($obj != false)
	{
		if($obj->Level == $i)
		{
			$LevelTableData .= "[" . $obj->Level . ", " . $obj->count . "],";
			$obj = $res->fetchObject();
		}
		else
		{
			$LevelTableData .= "[" . $i . ", 0],";
		}
	}
	else
	{
		$LevelTableData .= "[" . $i . ", 0],";
	}
	$i++;
}
$LevelTableData = rtrim($LevelTableData, ",");
$smarty->assign("LevelTableData",$LevelTableData);

$smarty->display("index.tpl");

