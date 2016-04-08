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
$smarty->display("menu.tpl");


if(isset($_REQUEST['action']))//check if we are doing anything
{
	if($_REQUEST['action'] == "changePassword")
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
	
	if($_REQUEST['action'] == "expiredPassword")
	{
		$smarty->assign("message", "Your password has expired. Please change it.");
	}
}

$smarty->assign("user",$user);

//get messages
$messages = $userController->getAllMessagesForUser($currentUID);
$tmpUser = new User();
$smarty->assign("tmpUser",$tmpUser);
$smarty->assign("messages",$messages);

$smarty->display("user.tpl");

