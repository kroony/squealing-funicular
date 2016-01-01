<?php

include_once("bootstrap.php");

/*********Add XP*********/
include_once("hero/pitController.php");

$pit = new PitController();

$hero1 = new Hero();
$hero1 = $hero1->loadHero($_REQUEST['ID1']);

$hero2 = new Hero();
$hero2 = $hero2->loadHero($_REQUEST['ID2']);

$pit->oneOnOne($hero1, $hero2);

$smarty->assign("hero1",$hero1);
$smarty->assign("hero2",$hero2);

//save heros
$hero1->SaveHero();
$hero2->SaveHero();

$smarty->display("oneonone.tpl");
