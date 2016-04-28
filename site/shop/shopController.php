<?php
include_once("shop/sale.php");
include_once("user/userController.php");

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
		
		return $NewSale;
	}
	
	function completeSale($saleID, $buyerID)
	{
		$sale = Sale::loadSale($saleID);
		$buyer = User::load($buyerID);
		$seller = User::load($sale->SellerID);
		
		if($sale->ItemType == "Weapon")
		{
			//spend money
			$buyer->debit($sale->Price);
			$seller->credit($sale->Price);
			
			//transfer Item			
			$sale->Item->UserID = $buyerID;
			$sale->Item->save();
			
			//send message to seller
			userController::sendMessage($seller->ID, $buyer->ID, "Your shop item " . $sale->Item->Name . " sold to " . $buyer->username . " for " . $sale->Price . "gp.", $Body);
			
			//delete sale 
			$sale->delete();
		}
	}
}

?>
