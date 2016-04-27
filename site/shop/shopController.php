<?php
include_once("shop/sale.php");

class shopController
{
	function getSalesFromSeller($id)
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Sale` WHERE `SellerID` = $id;";

		$res=$db->query($getQuery);//execute query
		
		$returnSales = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnSales, Sale::loadSaleFromObject($obj));
		}
		return $returnSales;
	}
	
	function getAllForBuyer($id)
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Sale` ORDER BY `Price` DESC;";

		$res=$db->query($getQuery);//execute query
		
		$returnSales = array();
		while($obj = $res->fetchObject())
		{
			array_push($returnSales, Sale::loadSaleFromObject($obj));
		}
		return $returnSales;
	}
	
	function createSale($sellerID, $itemType, $itemID, $price)
	{
		$NewSale = New Sale();
		
		$NewSale->SellerID = $sellerID;
		$NewSale->ItemType = $itemType;
		$NewSale->ItemID = $itemID;
		$NewSale->Price = $price;
		$NewSale->Created = new DateTime('now');
		
		$NewSale->save();
	}
}

?>
