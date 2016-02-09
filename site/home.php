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
	$smarty->assign("help","This page displays all the heroes you have in your guild. New heroes can be purchased using the 'hire new hero' link, provided you have enough gold.<br />
						  Clicking the Fight link on a heroes row will let you send them off to fight monsters and other players heroes. Being victorious in their fight, a hero will earn XP and sometimes loot. Losing a fight may knock your hero unconscious or worse.<br />
						  Clicking a heroes name will show more detailed information about that hero.");
	$smarty->assign("helpTitle","Heroes Page Help");
	$smarty->display("menu.tpl");

	/*********  show all Hero  ***********/
	$newHeroCost = $heroController->getCostForNextHero($currentUID);
	$smarty->assign("newHeroCost", $newHeroCost);

	if($user->canAfford($newHeroCost))
	{
		$smarty->assign("canAffordHero", true);
	}

	$userHeros = $heroController->getAllForUser($currentUID);
	$smarty->assign("userHeros",$userHeros);
	$smarty->assign("totalHeros",count($userHeros));
	$smarty->display("home.tpl");
	/*********  end show all Hero  ***********/
}
?>
