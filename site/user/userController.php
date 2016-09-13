<?php
include_once("user/user.php");
include_once("user/message.php");

class userController
{	
	function getAllMessagesForUser($ID)
	{
		$db = DB::GetConn();
		
		$ToID_con = $db->quoteInto("ToID = ?",$ID);
		$getQuery = "SELECT * FROM `Message` WHERE $ToID_con ORDER BY `Sent` DESC;"; //@TODO Order by Date
		$res=$db->query($getQuery);//execute query
		
		$returnMessages = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnMessages, Message::loadMessageFromObject($obj));
		}
		return $returnMessages;
	}
	
	function deleteAllMessagesForUser($ID)
	{
		$db = DB::GetConn();
		
		$ToID_con = $db->quoteInto("ToID = ?",$ID);
		$deleteQuery = "DELETE FROM `Message` WHERE $ToID_con;";
		$res=$db->query($deleteQuery);//execute query
	}
	
	function deleteMonsterMessagesForUser($ID)
	{
		$db = DB::GetConn();
		
		$ToID_con = $db->quoteInto("ToID = ?",$ID);
		$MonsterID_con = $db->quoteInto("FromID = ?", 146);
		$deleteQuery = "DELETE FROM `Message` WHERE $ToID_con AND $MonsterID_con;";
		$res=$db->query($deleteQuery);//execute query
	}
	
	function loginUser($ID)
	{
		$user = User::load($ID);
		$user->lastSeen = new DateTime(date("Y-m-d H:i:s"));
		$user->Save();
	}
	
	function countUnreadForUser($ID)
	{
		$db = DB::GetConn();
		
		$getQuery = "SELECT count(*) as count FROM `Message` WHERE `ToID` = $ID AND `IsRead` = 0;";
		$res=$db->query($getQuery);//execute query
		$obj = $res->fetchObject();
		
		return $obj->count;
	}
	
	function sendMessage($To, $From, $Subject, $Body, $Type)
	{
		$NewMessage = New Message();
		
		$NewMessage->ToID = $To;
		$NewMessage->FromID = $From;
		$NewMessage->Subject = $Subject;
		$NewMessage->Body = $Body;
		$NewMessage->Sent = new DateTime('now');
		$NewMessage->IsRead = false;
		$NewMessage->Type = $Type;
		
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
	
	function getBottom10ByDeath()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `User` WHERE `ID` <> 146 ORDER BY `User`.`deaths` DESC LIMIT 10;";

		$res=$db->query($getQuery);//execute query
		
		$returnUsers = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnUsers, User::loadUserFromObject($obj));
		}
		return $returnUsers;
	}
	
	function getTop10ByKills()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `User` WHERE `ID` <> 146 ORDER BY `User`.`kills` DESC LIMIT 10;";

		$res=$db->query($getQuery);//execute query
		
		$returnUsers = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnUsers, User::loadUserFromObject($obj));
		}
		return $returnUsers;
	}
	
	function getTop10ByKillToDeathRatio()
	{
		$db = DB::GetConn();

		$getQuery = "SELECT *, `kills` / (`deaths` + 1) AS KtoD FROM `User` WHERE `ID` <> 146 ORDER BY `KtoD` DESC LIMIT 10;";

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
