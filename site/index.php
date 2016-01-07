<?php

include("bootstrap.php");
include_once("heroClass.php");
$db = DB::GetConn();
$getQuery = "SELECT Class,COUNT(*) as count FROM Hero GROUP BY Class ORDER BY count DESC;";
$res=$db->query($getQuery);//execute query
$ClassTableData = "['Class', 'Population'],";
while($obj = $res->fetchObject())
{
	$HeroClass = HeroClass::loadHeroClass($obj->Class);
	$ClassTableData .= "['" . $HeroClass->Name . "', " . $obj->count . "],";
}
$ClassTableData = rtrim($ClassTableData, ",");
$smarty->assign("ClassTableData",$ClassTableData);
$smarty->display("index.tpl");

