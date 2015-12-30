<?php

include_once("includes/connect.php");

/*********Add XP*********/
include_once("hero/pitController.php");

$pit = new PitController();


$hero1 = new Hero();
$hero1 = $hero1->loadHero($_REQUEST['ID1']);

$hero2 = new Hero();
$hero2 = $hero2->loadHero($_REQUEST['ID2']);


$pit->oneOnOne($hero1, $hero2);

echo "<br /><br /><br />";

$hero1 = $hero1->loadHero($_REQUEST['ID1']);
$hero2 = $hero2->loadHero($_REQUEST['ID2']);
$pit->oneOnOne($hero1, $hero2);

echo "<br /><br /><br />";

$hero1 = $hero1->loadHero($_REQUEST['ID1']);
$hero2 = $hero2->loadHero($_REQUEST['ID2']);
$pit->oneOnOne($hero1, $hero2);

echo "<br /><br /><br />";

$hero1 = $hero1->loadHero($_REQUEST['ID1']);
$hero2 = $hero2->loadHero($_REQUEST['ID2']);
$pit->oneOnOne($hero1, $hero2);

//save adventurer
/*$testHero->addXP(1000);

$testHero->SaveHero();*/

/***********end Add XP*********/


//header("Location: index.php");

?>

<a href="home.php">Return</a>