<?php

class Message
{
	public $ID;
	public $ToID;
	public $FromID;
	public $Subject;
	public $Body;
	public $Sent;
	public $IsRead;

	function __construct()
	{
	}
	
	/*
	@TODO
	Delete
	Read
	Unread
	Send
	*/

	//load Message from DB 
	function load($ID)
	{
		//check ID is not blank and exists and such
		$db = DB::GetConn();

		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `Message` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();
        return Message::loadMessageFromObject($obj);
    }

	function loadMessageFromObject($obj)
    {
		$returnMessage = new Message();
		
		$returnMessage->ID = $obj->ID;
		$returnMessage->ToID =  $obj->ToID;
		$returnMessage->FromID =  $obj->FromID;
		$returnMessage->Subject = $obj->Subject;
		$returnMessage->Body = $obj->Body;
		$returnMessage->Sent = $obj->Sent;
		$returnMessage->IsRead = $obj->IsRead;
		
		return $returnMessage;
	}

	function Save()
	{
		$db = DB::GetConn();
		if($this->ID != null)
		{
			$row = array("ToID"=>$this->ToID,
				"FromID"=>$this->FromID,
				"Subject"=>$this->Subject,
				"Body"=>$this->Body,
				"Sent"=>$this->Sent->format('Y-m-d H:i:s'),
				"IsRead"=>$this->IsRead);
			$where = array($db->quoteInto("ID = ?", $this->ID));
			try {
				$db->update("Message", $row, $where);
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}
		else //no id, add new Message
		{
			$row = array("ToID"=>$this->ToID,
				"FromID"=>$this->FromID,
				"Subject"=>$this->Subject,
				"Body"=>$this->Body,
				"Sent"=>$this->Sent->format('Y-m-d H:i:s'),
				"IsRead"=>$this->IsRead);
			
			try {
				$db->insert("Message",$row);
				$id = $db->lastInsertId();
				$this->ID = $id;
				
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}

		//some sort of try catch error detection
	}
}

?>
