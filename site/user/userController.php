<?php
include_once("user/user.php");
include_once("user/message.php");

class userController
{
	function getAllMessagesForUser($ID)
	{
		$db = DB::GetConn();
		
		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `Message` WHERE $id_con;"; //@TODO Order by Date
		$res=$db->query($getQuery);//execute query
		
		$returnMessages = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnMessages, Message::loadMessageFromObject($obj));
		}
		return $returnMessages;
	}
	
	function sendMessage($To, $From, $Subject, $Body)
	{
		$NewMessage = New Message();
		
		$NewMessage->ToID = $To;
		$NewMessage->FromID = $From;
		$NewMessage->Subject = $Subject;
		$NewMessage->Body = $Body;
		$NewMessage->Sent = new DateTime('now');
		$NewMessage->IsRead = false;
		
		$NewMessage->Save();
	}
	
	function getAll()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `User`;";

		$res=$db->query($getQuery);//execute query
		
		$returnUsers = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnUsers, User::loadUserFromObject($obj));
		}
		return $returnUsers;
	}
	
	function getTop10ByGold()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `User` WHERE `ID` <> 146 ORDER BY `User`.`gold` DESC LIMIT 10;";

		$res=$db->query($getQuery);//execute query
		
		$returnUsers = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnUsers, User::loadUserFromObject($obj));
		}
		return $returnUsers;
	}
}

?>
