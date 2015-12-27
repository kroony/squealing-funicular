<?php

include_once("includes/connect.php");
include_once("includes/session.php");

/*********Generate Hero*********/
include_once("hero/hero.php");
$testHero = new Hero();

$testHero->GenerateHero($_REQUEST["level"]); //generate lvl1 Hero

$testHero->GiveToUser($currentUID);
//save adventurer
$testHero->SaveHero();

/***********end generate Hero *********/


//header("Location: index.php");

?>

<a href="home.php">Return</a>