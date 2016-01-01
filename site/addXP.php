<?php

include_once("bootstrap.php");

/*********Add XP*********/
include_once("hero/hero.php");


$testHero = new Hero();
$testHero = $testHero->loadHero($_REQUEST['ID']);

//save adventurer
$testHero->addXP(1000);

$testHero->SaveHero();

/***********end Add XP*********/


//header("Location: index.php");
$smarty->display("addXP.tpl");
