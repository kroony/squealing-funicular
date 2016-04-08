<?php

include("bootstrap.php");

//load User
include_once("user/user.php");

//include message class
include_once("user/message.php");
$message = new Message();

//check for ID
if(isset($_REQUEST['ID'])
{
		$message->load($_REQUEST['ID']);
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
}
else
{
	$smarty->assign("error","Message not Found");
}

//Page Header
$smarty->display("css/css.tpl");
//menu
$smarty->assign("currentpage","user");
$smarty->display("menu.tpl");


if(isset($_REQUEST['action']))//check if we are doing anything
{
	if($_REQUEST['action'] == "something")
	{
		//do something
	}
}

$smarty->assign("message",$message);

$smarty->display("viewMessage.tpl");

