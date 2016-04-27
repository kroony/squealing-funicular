<?php
chdir("../");

include_once("bootstrap.php");

$db = DB::GetConn();

/*print_r($db->query("ALTER TABLE `User` ADD `kills` INT NOT NULL ;"));
echo "<br /><br />";*/
print_r($db->query("CREATE TABLE IF NOT EXISTS `Sale` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SellerID` int(11) NOT NULL,
  `ItemType` text NOT NULL,
  `ItemID` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Created` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;"); 

//html header
$smarty->display("css/css.tpl");

//menu
$smarty->display("menu.tpl");

/*********  show all Migrations  ***********/
$db = DB::GetConn();
$getQuery = "SELECT * FROM `migrations`;";
$res=$db->query($getQuery);//execute query

$migrations = array();
while($obj = $res->fetchObject())
{
  array_push($migrations, $obj);
}

$smarty->assign("migrations",$migrations);
$smarty->display("admin/migrations.tpl");
/*********  end show all Party  ***********/

chdir("admin/");

?>
