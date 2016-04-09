<?php

//get messages and gold for current user
include_once("user/userController.php");
$userController = new userController();
$smarty->assign("unreadMessages",$userController->countUnreadForUser($currentUID));
$smarty->assign("currentUserGold",User::load($currentUID)->gold);
$smarty->display("menu.tpl");

?>
