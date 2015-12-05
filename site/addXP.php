<?php

include_once("includes/connect.php");

/*********Add XP*********/
include_once("hero/hero.php");


$testHero = new Hero();
$testHero = $testHero->loadHero($_REQUEST['ID']);

//save adventurer
$testHero->addXP(1000);

$testHero->SaveHero();

/***********end Add XP*********/


//header("Location: index.php");

?>

<a href="index.php">Return</a>