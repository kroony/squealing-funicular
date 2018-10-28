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

	/*********    show Town   ***********/
  
  include_once("location/locationController.php");
  $locationController = new locationController();
  $nextLocation = $locationController->getNextLocationExploration(min($user->exploration, 99999));

	$userHeros = $heroController->getAllForUserAtLocation($currentUID, 2);
	$smarty->assign("currentUID",$currentUID);
	$smarty->assign("exploration",$user->exploration);
	$smarty->assign("nextExploration", min(1000000, $nextLocation->RequiredExploration));
	$smarty->assign("userHeros",$userHeros);
	$smarty->assign("totalHeros",count($userHeros));
	
	$smarty->display("town.tpl");
	
	/*********  end show Town  ***********/
}
?>
