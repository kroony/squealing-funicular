<?php

include_once("bootstrap.php");
include_once("hero/heroController.php");

//check password is nolonger 'pass'
include_once("user/user.php");
$user = new User();
$user = $user->load($currentUID);
if($user->password == "pass")
{
	header( 'Location: user.php?action=expiredPassword' );
	exit(0);
}
else
{
	//html header
	$smarty->display("css/css.tpl");

	$heroController = new heroController();

	//menu & help
	$smarty->assign("currentpage","home");
	$smarty->assign("help","This page displays all the heroes you have in your guild. New heroes can be purchased using the 'hire new hero' link, provided you have enough gold.
						  Clicking the Fight link on a heroes row will let you send them off to fight monsters and other players heroes.
						  Clicking a heroes name will show more detailed information about that hero.");
	$smarty->assign("helpTitle","Heroes Page Help");
	include_once("menu.php");

	/*********  show all Hero  ***********/
	$newHeroCost = $heroController->getCostForNextHero($currentUID);
	$smarty->assign("newHeroCost", $newHeroCost);

	if($user->canAfford($newHeroCost))
	{
		$smarty->assign("canAffordHero", true);
	}

	$userHeros = $heroController->getAllForUser($currentUID);
	$smarty->assign("currentUID",$currentUID);
	$smarty->assign("userHeros",$userHeros);
	$smarty->assign("totalHeros",count($userHeros));
	
	if(count($userHeros) == 0)//if they have no heroes show the intro page
	{
		$smarty->display("homeEmpty.tpl");
	}
	else
	{
		$smarty->display("home.tpl");
	}
	
	/*********  end show all Hero  ***********/
}
?>
