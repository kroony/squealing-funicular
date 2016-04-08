<?php

chdir("../");

include_once("bootstrap.php");

$db = DB::GetConn();

/*print_r($db->query("CREATE TABLE IF NOT EXISTS `Message` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ToID` int(11) NOT NULL,
  `FromID` int(11) NOT NULL,
  `Subject` text NOT NULL,
  `Body` text NOT NULL,
  `Sent` datetime NOT NULL,
  `IsRead` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;"));
*/


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
