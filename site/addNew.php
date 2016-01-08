<?php

include_once("bootstrap.php");

/*********Generate Hero*********/
include_once("hero/hero.php");
$Hero = new Hero();

$Hero->GenerateHero(1); // $_REQUEST["level"]); //generate lvl1 Hero

$Hero->GiveToUser($currentUID);
$Hero->generateStartingWeapon();//@TODO move this into hero controller so it can follow the correct process (create, give, weapon, ect)
//save hero
$Hero->SaveHero();

/***********end generate Hero *********/

header("Location: viewHero.php?ID=" . $Hero->ID);
?>
