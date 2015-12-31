<?php
header("Location: home.php");

include_once("includes/connect.php");

/*********Add XP*********/
include_once("hero/hero.php");

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);
$hero->revive();
$hero->SaveHero();


?>