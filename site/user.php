<?php

include("bootstrap.php");

//load User
include_once("user/user.php");
$user = new User();
$user = $user->load($currentUID);

//Create Hero Controller
include_once("hero/heroController.php");
$heroController = new heroController();

//Create User Controller 
include_once("user/userController.php");
$userController = new userController();

//Page Header
$smarty->display("css/css.tpl");

//menu
$smarty->assign("currentpage","user");
include_once("menu.php");

if(isset($_REQUEST['action']))//check if we are doing anything
{
	if($_REQUEST['action'] == "DeleteMessage")
	{
		//@TODO check message exists
		
		$deleteMessage = new Message();
		$deleteMessage = $deleteMessage->load($_REQUEST['MsgID']);
		
		if($deleteMessage->ToID == $currentUID)//check user owns message
		{
			$deleteMessage->Delete();
		}
		else
		{
			$smarty->assign("error","That message does not belong to you, you cant delete it.");
		}
	}
	else if($_REQUEST['action'] == "changePassword")
	{
		if($_REQUEST['oldpassword'] != "pass")
		{
			if(password_verify($_REQUEST['oldpassword'], $user->password))
			{
				if($_REQUEST['ID'] != $currentUID)
				{
					$smarty->assign("error","Don't change other peoples passwords.");
				}
				else if ($_REQUEST['password1'] != $_REQUEST['password2'])
				{
					$smarty->assign("error","The passwords you entered do not match.");
				}
				else if ($_REQUEST['password1'] == "" || $_REQUEST['password1'] == null)
				{
					$smarty->assign("error","Your new password can not be blank.");
				}
				else
				{
					$passwordHash = password_hash($_REQUEST['password1'], PASSWORD_DEFAULT);
					if($passwordHash == false)
					{
						$smarty->assign("error","There was an error changing your password.");
					}
					else
					{
						$user->password = $passwordHash;
						$user->Save();
						$smarty->assign("message", "Your password has been changed");
					}
				}
			}
			else
			{
				$smarty->assign("error","Your current password does not match");
			}
		}
		else
		{
			if($user->password == $_REQUEST['oldpassword'])
			{
				if($_REQUEST['ID'] != $currentUID)
				{
					$smarty->assign("error","Don't change other peoples passwords.");
				}
				else if ($_REQUEST['password1'] != $_REQUEST['password2'])
				{
					$smarty->assign("error","The passwords you entered do not match.");
				}
				else if ($_REQUEST['password1'] == "" || $_REQUEST['password1'] == null)
				{
					$smarty->assign("error","Your new password can not be blank.");
				}
				else
				{
					$passwordHash = password_hash($_REQUEST['password1'], PASSWORD_DEFAULT);
					if($passwordHash == false)
					{
						$smarty->assign("error","There was an error changing your password.");
					}
					else
					{
						$user->password = $passwordHash;
						$user->Save();
						$smarty->assign("message", "Your password has been changed");
					}
				}
			}
			else
			{
				$smarty->assign("error","Your current password does not match");
			}
		}
	}
	else if($_REQUEST['action'] == "deleteAllMessages")
	{
		$userController->deleteAllMessagesForUser($currentUID);
		$smarty->assign("message", "All messages have been deleted.");
	}
	else if($_REQUEST['action'] == "deleteMonsterMessages")
	{
		$userController->deleteMonsterMessagesForUser($currentUID);
		$smarty->assign("message", "All messages have been deleted.");
	}
	if($_REQUEST['action'] == "expiredPassword")
	{
		$smarty->assign("message", "Your password has expired. Please change it.");
	}
}

$smarty->assign("user",$user);
$messageAttack = array();
$messageDefence = array();
$messageMessage = array();
$messageAdmin = array();

//get messages
$messages = $userController->getAllMessagesForUser($currentUID);
//sort messages
/*
	Type Key
	0 = Attack
	1 = Defence
	2 = Message
	3 = Admin
*/
foreach($messages as $message)
{
	switch ($message->Type)
	{
		case 0:
			$messageAttack[] = $message;
			break;
		case 1:
			$messageDefence[] = $message;
			break;
		case 2:
			$messageMessage[] = $message;
			break;
		case 3:
			$messageAdmin[] = $message;
			break;
	}
}
$tmpUser = new User();
$smarty->assign("tmpUser",$tmpUser);

$smarty->assign("messageAttack",$messageAttack);
$smarty->assign("messageDefence",$messageDefence);
$smarty->assign("messageMessage",$messageMessage);
$smarty->assign("messageAdmin",$messageAdmin);

$smarty->assign("rowCount",0);

$smarty->display("user.tpl");

