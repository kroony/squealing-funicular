<?php

include_once("includes/connect.php");

/*********Generate Hero*********/
include_once("hero/hero.php");


$testHero = new Adventurer();
$testHero = $testAdventurer->loadHero($_REQUEST['ID']);


if($testHero->LevelUP())
{
  // if we leveled up then we can save adventurer
  $testHero->SaveHero();
}

/***********end generate Hero *********/


//header("Location: index.php");

?>

<a href="index.php">Return</a>