<?php

include_once("bootstrap.php");

/*********Generate Hero*********/
include_once("hero/hero.php");


$testHero = new Hero();
$testHero = $testHero->loadHero($_REQUEST['ID']);


if($testHero->LevelUP())
{
  // if we leveled up then we can save adventurer
  $testHero->SaveHero();
}

/***********end generate Hero *********/


//header("Location: index.php");
$smarty->display("levelUp.tpl");
