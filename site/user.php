<?php

include("bootstrap.php");

$smarty->display("css/css.tpl");

//menu
$smarty->assign("currentpage","user");
$smarty->display("menu.tpl");

include_once("user/user.php");

$user = new User();
$user = $user->load($currentUID);

if($user->gold > 0)
{
	$user->gold = 0;
	$user->Save();
}

if(isset($_REQUEST['action']))//check if we are doing anything
{
	if($_REQUEST['action'] == "changePassword")
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
	
	if($_REQUEST['action'] == "expiredPassword")
	{
		$smarty->assign("message", "Your password has expired. Please change it.");
	}
}

$smarty->assign("user",$user);

$smarty->display("user.tpl");

