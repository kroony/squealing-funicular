<?php

include("bootstrap.php");

include_once("hero/heroController.php");

$heroController = new heroController();

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);

if(!$hero->canFight())
{
	//hero is doing something and cant fight
	header( 'Location: home.php' );
	exit(0);
}

$smarty->display("css/css.tpl");

//menu and Help
$smarty->assign("help","This page displays all the Monsters and Player heroes in the world you can fight. 
						A Monsters effectiveness is unknown before fighting them but if you succeed to knock them out, you will be rewarded will gold. 
						You can only fight one level below your current, your current level, and up to two levels above your level when fighting other players heroes.");
$smarty->assign("helpTitle","Fight Selection Page");
include_once("menu.php");



$smarty->assign("hero",$hero);

$against = $heroController->findEnemys($currentUID, $hero);
$smarty->assign("against",$against);

$smarty->display("oneononechoose.tpl");

