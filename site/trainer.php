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
	$smarty->assign("currentpage","trainer");
	$smarty->assign("help","This page displays all the heroes exploring the Town. The longer heroes are here the more change you have a finding new locations.
						  The town is not perfectly safe, if heroes spend too long here they might run into resistance.");
	$smarty->assign("helpTitle","Trainer Page Help");
	include_once("menu.php");

	/*********    Show Trainer   ***********/
	$userHeros = $heroController->getAllForUserAtLocation($currentUID, 5);
	$smarty->assign("userHeros",$userHeros);
	
	$smarty->assign("currentUID",$currentUID);
	$smarty->assign("user",$user);
	
	
	$smarty->assign("currentTrainerLevel", $user->trainerLevel);
	/* 0 = mission for Strength
	   1 = mission for Intellegence
	   2 = mission for Dexterity
	   3 = mission for Wisdom
	   4 = mission for Constitution
	   5 = mission for Charisma
	   6 = all done
	*/
	
	
	
	$smarty->assign("totalHeros",count($userHeros));
	
	$smarty->display("trainer.tpl");
	
	/*********  end show Trainer  ***********/
}
?>
