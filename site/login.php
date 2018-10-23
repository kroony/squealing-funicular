<?php

include_once("bootstrap.php");

include_once("user/userController.php");

$db = DB::GetConn();
$Username = $db->quoteInto("`username` = ?",$_REQUEST['username']);

$sql = "SELECT * FROM `User` WHERE $Username limit 1";
$result = $db->query($sql);
$obj = $result->fetchObject();
if(!is_object($obj))
{
	$smarty->assign("result","login_error");
}
else
{
	if($obj->active == 1)
	{
		if($obj->password != "pass")
		{
			if(password_verify($_REQUEST['password'], $obj->password))
			{
				$_SESSION['userID'] = $obj->ID;
				userController::loginUser($_SESSION['userID']);
				$smarty->assign("result","success");
				header( 'Location: guild.php' );
				exit(0);
			}
		}
		else if($obj->password == $_REQUEST['password'])
		{
			//@TODO redirect to change password page, once noone has the password "pass" remove this check
			$_SESSION['userID'] = $obj->ID;
			userController::loginUser($_SESSION['userID']);
			$smarty->assign("result","success");
			header( 'Location: guild.php' );
			exit(0);
		}
		$smarty->assign("result","login_error");
	}
	else
	{
		$smarty->assign("result","activate");
	}
}

$smarty->display("login.tpl");
