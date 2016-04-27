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
$smarty->assign("unreadMessages", $unreadMessages;);
$smarty->assign("currentUserGold",User::load($currentUID)->gold);
$smarty->display("menu.tpl");

?>
