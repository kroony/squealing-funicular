<?php

include("bootstrap.php");
include_once("user/user.php");

$smarty->display("css/css.tpl");

//menu
$smarty->assign("currentpage","bug");
include_once("menu.php");

//check if form was submitted
if(isset($_REQUEST['submit']))
{
	include_once("user/userController.php");
	userController::sendMessage(1, $currentUID, '<span class="glyphicon glyphicon-asterisk">BUG/SUGGESTION ' . $_REQUEST['subject'], $_REQUEST['body']);
	
	$smarty->assign("message", "Your Bug / Suggestion '" . $_REQUEST['subject'] . "' has been submitted");
}

$smarty->display("bug.tpl");

