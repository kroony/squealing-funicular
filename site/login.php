<?php

include_once("bootstrap.php");

$db = DB::GetConn();
$Username = $db->quoteInto("`username` = ?",$_REQUEST['username']);
$Pass = $db->quoteInto("`password` = ?",$_REQUEST['password']);

$sql = "SELECT * FROM `User` WHERE $Username AND $Pass limit 1";
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
		$_SESSION['userID'] = $obj->ID;

		$smarty->assign("result","success");
		header( 'Location: home.php' );
		exit(0);
	}
	else
	{
		$smarty->assign("result","activate");

	}
}

$smarty->display("login.tpl");
