<?php

include("bootstrap.php");
$smarty->display("css/css.tpl");

$smarty->display("menu.tpl");

include_once("hero/heroController.php");

$heroController = new heroController();

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);
$smarty->assign("hero",$hero);

$against = $heroController->findEnemys($currentUID, $hero);
$smarty->assign("against",$against);

$smarty->display("oneononechoose.tpl");

