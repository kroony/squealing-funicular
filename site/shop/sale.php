<?php
include_once("/../hero/weapon.php");

class Sale
{
	public $ID;
	public $SellerID;
	public $ItemType;
	public $ItemID;
	public $Price;
	public $Created;
	public $Item;

	function __construct()
	{
		
	}
 
	function loadSale($ID)
	{
		$db = DB::GetConn();
		$id_con = $db->quoteInto("ID = ?",$ID);
		$getQuery = "SELECT * FROM `Sale` WHERE $id_con limit 1;";
		$res = $db->query($getQuery);
		$obj = $res->fetchObject();
		return Sale::loadSaleFromObject($obj);
	}
	
	function loadSaleFromObject($obj)
  {
		$returnSale = new Sale();
		$returnSale->ID = $obj->ID;
		$returnSale->SellerID = $obj->SellerID;
		$returnSale->ItemType = $obj->ItemType;
		$returnSale->ItemID = $obj->ItemID;
		$returnSale->Price = $obj->Price;
		$returnSale->Created = new DateTime($obj->Created);
		
		//load the actual object for sale
		if($returnSale->ItemType  == "Weapon")
		{
			$returnSale->Item = Weapon::loadWeapon($returnSale->ItemID);
		}
		
		return $returnSale;
	}
	
	function save()
	{
		$db = DB::GetConn();
		
		if($this->ID != null){
			$row = array("SellerID"=>$this->SellerID,
				"ItemType"=>$this->ItemType,
				"ItemID"=>$this->ItemID,
				"Price"=>$this->Price,
				"Created"=>$this->Created->format('Y-m-d H:i:s'));
			$where = array($db->quoteInto("ID = ?", $this->ID));
			try {
				$db->update("Sale", $row, $where);
			}
			catch(Exception $ex)
			{
				print_r($ex);
			} 
		} 
		else 
		{
			$row = array("SellerID"=>$this->SellerID,
				"ItemType"=>$this->ItemType,
				"ItemID"=>$this->ItemID,
				"Price"=>$this->Price,
				"Created"=>$this->Created->format('Y-m-d H:i:s'));
			
			try {
				$db->insert("Sale",$row);
				$id = $db->lastInsertId();
				$this->ID = $id;
			}
			catch(Exception $ex)
			{
				print_r($ex);
			}
		}	
	}
	
	function delete()
	{
		$db = DB::GetConn();
			
		$where = array($db->quoteInto("ID = ?", $this->ID));
		try {
			$db->delete("Sale", $where);
		}
		catch(Exception $ex)
		{
			print_r($ex);
		} 
	}
}

?>
