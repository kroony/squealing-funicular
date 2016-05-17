<?php

include("bootstrap.php");

$db = DB::GetConn();

//@todo place primary key on username field of User table, so we can rely on an exception being thrown when inserting the row (the select is not transactionally safe)
if (isset($_REQUEST['username']) && isset($_REQUEST['password']))
{
  $refererID = 0;
  if(isset($_REQUEST['refererID'])){$refererID = $_REQUEST['refererID'];}
  
  $passwordHash = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
  if($passwordHash != false)
  {
	$now = new DateTime(date("Y-m-d H:i:s"));
    $row = array("username"=>$_REQUEST['username'],
        "password"=>$passwordHash,
        "email"=>'',
        "gold"=>0,
        "active"=>1,
        "refererID"=>$refererID,
        "created"=>$now->format('Y-m-d H:i:s'));
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
	else
	{
    echo "failure with password hash, user not created.";
	}
}
$smarty->assign("refererID", 0);
if(isset($_REQUEST['Referer']))
{
  $smarty->assign("refererID", $_REQUEST['Referer']);
}
$smarty->display("register.tpl");
