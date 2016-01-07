<?php

include("bootstrap.php");

$smarty->display("css/css.tpl");

/*********Add XP*********/
include_once("hero/heroController.php");

$heroController = new heroController();

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);
$smarty->assign("hero",$hero);

$smarty->display("viewHero.tpl");

