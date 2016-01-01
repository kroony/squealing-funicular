<?php

include("bootstrap.php");

$db = DB::GetConn();

//@todo place primary key on username field of User table, so we can rely on an exception being thrown when inserting the row (the select is not transactionally safe)
if (isset($_REQUEST['username']))
{
	$row = array("username"=>$_REQUEST['username'],
			"password"=>"pass",
			"email"=>'',
			"salt"=>0,
			"gold"=>0,
			"active"=>1);
	try {
		$db->insert("User",$row);
		$id = $db->lastInsertId();
		$smarty->assign("id",$id);
		$smarty->assign("user",$_REQUEST['username']);
	}
	catch(Exception $ex)
	{
		$smarty->assign("error",$ex);
	}
}
	
$smarty->display("register.tpl");
