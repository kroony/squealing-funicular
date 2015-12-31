<?php

include_once("includes/connect.php");
include_once("includes/session.php");

/*********Add XP*********/
include_once("hero/heroController.php");

$heroController = new heroController();

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);
echo $hero->Name . "(level " . $hero->Level . ") would like to fight:<br />";
$against = $heroController->findEnemys($currentUID, $hero);

echo "<table>";
foreach ($against as $ag) {
	echo "<tr>";
	$href = "oneonone.php?ID1=" . $hero->ID . "&ID2=" . $ag->ID;
	echo "<td><a href='"  .  $href . "'>" . $ag->Name . "</a></td>";
	echo "<td>Level " . $ag->Level . "</td>";
	echo "<td>" . $ag->Race->Name . "</td>";
	echo "<td>" . $ag->HeroClass->Name . "</td>";
	echo "</tr>";

}
echo "</table>";

?>

<a href="home.php">Return</a>