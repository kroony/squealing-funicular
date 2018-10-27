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
	$smarty->assign("currentpage","town");
	$smarty->assign("help","This page displays all the heroes exploring the Town. The longer heroes are here the more change you have a finding new locations.
						  The town is not perfectly safe, if heroes spend too long here they might run into resistance.");
	$smarty->assign("helpTitle","Town Page Help");
	include_once("menu.php");

	/*********  show all Hero  ***********/
	$newHeroCost = $heroController->getCostForNextHero($currentUID);
	$smarty->assign("newHeroCost", $newHeroCost);

	if($user->canAfford($newHeroCost))
	{
		$smarty->assign("canAffordHero", true);
	}

	$userHeros = $heroController->getAllForUserAtLocation($currentUID, 2);
	$smarty->assign("currentUID",$currentUID);
	$smarty->assign("exploration",$user->exploration);
	$smarty->assign("userHeros",$userHeros);
	$smarty->assign("totalHeros",count($userHeros));
	
	if(count($userHeros) == 0)//if they have no heroes show the intro page
	{
		$smarty->display("townEmpty.tpl");
	}
	else
	{
		$smarty->display("town.tpl");
	}
	
	/*********  end show all Hero  ***********/
}
?>
