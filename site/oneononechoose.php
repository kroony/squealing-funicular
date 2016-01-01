<?php

include("bootstrap.php");

/*********Add XP*********/
include_once("hero/heroController.php");

$heroController = new heroController();

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);
$smarty->assign("hero",$hero);

//Now in template...
//echo $hero->Name . "(level " . $hero->Level . ") would like to fight:<br />";

$against = $heroController->findEnemys($currentUID, $hero);
$smarty->assign("against",$against);

/*
//Now in template...
echo "<table>";
foreach ($against as $ag) {
	$owner = mysql_get_rows("SELECT * FROM `User` WHERE ID = " . $ag->OwnerID);

	echo "<tr>";
	$href = "oneonone.php?ID1=" . $hero->ID . "&ID2=" . $ag->ID;
	echo "<td><a href='"  .  $href . "'>" . $ag->Name . "</a></td>";
	echo "<td>Level " . $ag->Level . "</td>";
	echo "<td>" . $ag->Race->Name . "</td>";
	echo "<td>" . $ag->HeroClass->Name . "</td>";
	echo "<td>" . $owner[0]['username'] . "</td>";
	echo "</tr>";

}
echo "</table>";
*/

$smarty->display("oneononechoose.tpl");

