<?php

include("bootstrap.php");

/*********Add XP*********/
include_once("hero/hero.php");

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);
$hero->revive();
$hero->SaveHero();

header("Location: home.php");
