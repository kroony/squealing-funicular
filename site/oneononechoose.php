<?php

include_once("includes/connect.php");

/*********Add XP*********/
include_once("hero/heroController.php");

$heroController = new heroController();

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);
echo $hero->Name . "(level " . $hero->Level . ") would like to fight:<br />";
$against = $heroController->findEnemys($currentUID, $hero);

foreach ($against as $ag) {
	$href = "oneonone.php?ID1=" . $hero->ID . "&ID2=" . $ag->ID;
	echo "<a href='"  .  $href . "'>" . $ag->Name . "(level " . $ag->Level . ")</a><br />";

}

?>

<a href="home.php">Return</a>