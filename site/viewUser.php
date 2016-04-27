<?php

include("bootstrap.php");

//load User
include_once("user/user.php");
$user = new User();

//hero controller
include_once("hero/heroController.php");
$heroController = new heroController();

//Page Header
$smarty->display("css/css.tpl");
//menu
include_once("menu.php");

if(isset($_REQUEST['ID']))
{
	$user = $user->load($_REQUEST['ID']);
	$smarty->assign("user",$user);
	$smarty->assign("heroCount",$heroController->countAllForUser($user->ID));	
}
else
{
	$smarty->assign("error","User not found");
}
$smarty->display("viewUser.tpl");

