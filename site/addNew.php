<?php

include_once("bootstrap.php");

/*********Generate Hero*********/
include_once("hero/hero.php");
$testHero = new Hero();

$testHero->GenerateHero(1); // $_REQUEST["level"]); //generate lvl1 Hero

$testHero->GiveToUser($currentUID);
$testHero->generateStartingWeapon();//@TODO move this into hero controller so it can follow the correct process (create, give, weapon, ect)
//save hero
$testHero->SaveHero();

/***********end generate Hero *********/


//header("Location: index.php");

?>

<a href="home.php">Return</a>
