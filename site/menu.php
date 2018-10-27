<?php

//get messages and gold for current user
include_once("user/userController.php");
$userController = new userController();

$unreadMessages = $userController->countUnreadForUser($currentUID);
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == "DeleteMessage")
	{
		$unreadMessages--;
	}
}

//load User
include_once("user/user.php");
$user = new User();
$user = $user->load($currentUID);
include_once("location/locationController.php");
$locationController = new locationController();
$unlockedLocations = $locationController->getUnlockedLocations($user->exploration)

$smarty->assign("unlockedLocations", $unlockedLocations);
$smarty->assign("unreadMessages", $unreadMessages);
$smarty->assign("currentUserGold",User::load($currentUID)->gold);
$smarty->display("menu.tpl");

?>
