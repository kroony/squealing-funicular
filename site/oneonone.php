<?php

include_once("bootstrap.php");

/*********Add XP*********/
include_once("hero/pitController.php");

$pit = new PitController();

$hero1 = new Hero();
$hero1 = $hero1->loadHero($_REQUEST['ID1']);

$hero2 = new Hero();
$hero2 = $hero2->loadHero($_REQUEST['ID2']);

$log = $pit->oneOnOne($hero1, $hero2);

$smarty->assign("log",$log);
$smarty->assign("hero1",$hero1);
$smarty->assign("hero1_name",$hero1->displayName(true));
$smarty->assign("hero2",$hero2);
$smarty->assign("hero2_name",$hero2->displayName(false));

//save heros

$hero1->SaveHero();
if ($hero2->Level != -1)
	$hero2->SaveHero();

$smarty->display("oneonone.tpl");
