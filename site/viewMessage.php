<?php
include("bootstrap.php");
//load User
include_once("user/userController.php");
$userController = new userController();
//include message class
include_once("user/message.php");
$message = new Message();
//check for ID
if(isset($_REQUEST['ID']))
{
	$message = $message->load($_REQUEST['ID']);
	if($message->ToID == $currentUID)
	{
		$message->Read();//no problems to set it to Read 
		
		$fromUser = new User();//load the from user
		$fromUser = $fromUser->load($message->FromID);
		$smarty->assign("fromUser",$fromUser);
	}
	else
	{
		$smarty->assign("error","this does not belong to you");
	}
	
	if(isset($_REQUEST['action']))
	{
		if($_REQUEST['action'] == "reply")
		{
			$smarty->assign("reply",true);
		}
		else if($_REQUEST['action'] == "sendReply")
		{
			//@TODO check fields are not blank
			$userController->sendMessage($_REQUEST['toID'], $currentUID, $_REQUEST['subject'], $_REQUEST['body']); // $To, $From, $Subject, $Body
			
			$smarty->assign("message","Reply sent.");
		}
	}
}
else
{
	$smarty->assign("error","Message not Found");
}
//Page Header
$smarty->display("css/css.tpl");
//menu
$smarty->assign("currentpage","user");
include_once("menu.php");

$smarty->assign("message",$message);
$smarty->display("viewMessage.tpl");