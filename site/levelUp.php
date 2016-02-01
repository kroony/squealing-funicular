<?php

include_once("bootstrap.php");

/*********Level up Hero*********/
include_once("hero/hero.php");

$testHero = new Hero();
$testHero = $testHero->loadHero($_REQUEST['ID']);

if($testHero->LevelUP())
{
  // if we levelled up then we can save hero
  $testHero->SaveHero();
}

/***********end Level up Hero *********/

//header("Location: index.php");
$smarty->display("levelUp.tpl");
