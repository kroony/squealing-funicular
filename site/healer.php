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
	$smarty->assign("currentpage","healer");
	$smarty->assign("help","Heal things.");
	$smarty->assign("helpTitle","Healer Page Help");
	include_once("menu.php");

	/*********  show all Hero  ***********/
	$userHeros = $heroController->getAllForUserAtLocation($currentUID, 3);
	$smarty->assign("currentUID",$currentUID);
	$smarty->assign("userHeros",$userHeros);
	
	$smarty->display("healer.tpl");
	
	/*********  end show all Hero  ***********/
}
?>
