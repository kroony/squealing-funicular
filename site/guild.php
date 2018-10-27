<?php

include_once("bootstrap.php");
include_once("hero/heroController.php");
include_once("location/locationController.php");

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
	$smarty->assign("currentpage","guild");
	$smarty->assign("help","This page displays all the heroes you have resting in the guild house. New heroes can be purchased using the 'hire new hero' link, provided you have enough gold.
						  Clicking the Fight link on a heroes row will let you send them off to fight monsters and other players heroes.
						  Clicking a heroes name will show more detailed information about that hero.");
	$smarty->assign("helpTitle","Guild Hall Page Help");
	include_once("menu.php");

	/*********  show all Hero  ***********/
	$newHeroCost = $heroController->getCostForNextHero($currentUID);
	$smarty->assign("newHeroCost", $newHeroCost);

	if($user->canAfford($newHeroCost))
	{
		$smarty->assign("canAffordHero", true);
	}

	$userHeros = $heroController->getAllForUserAtLocation($currentUID, 1);
	$smarty->assign("currentUID",$currentUID);
	$smarty->assign("userHeros",$userHeros);
	$smarty->assign("totalHeros",count($userHeros));
	
	$locationController = new locationController();
	
	$smarty->display("guild.tpl");
	
	/*********  end show all Hero  ***********/
}
?>
